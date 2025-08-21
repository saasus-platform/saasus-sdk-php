<?php

namespace AntiPatternInc\Saasus\Api;

class GuzzleMiddleware
{
    private $next;

    private array $fixRules;

    protected string $secret;
    protected string $saasid;
    protected string $apikey;
    protected string $referer;
    protected string $xSaasusReferer;

    function __construct($secret = "", $saasid = "", $apikey = "", $referer = "", $xSaasusReferer = "")
    {
        // エンドポイントのルールをハードコーディング
        $this->fixRules = [
            [
                'method' => 'POST',
                'path_re' => '#^/v1/auth/tenants/[^/]+/users$#',
                'fields' => ['attributes'],
            ],
            [
                'method' => 'PATCH',
                'path_re' => '#^/v1/auth/tenants/[^/]+/users/[^/]+$#',
                'fields' => ['attributes'],
            ],
            [
                'method' => 'POST',
                'path_re' => '#^/v1/auth/tenants$#',
                'fields' => ['attributes'],
            ],
            [
                'method' => 'PATCH',
                'path_re' => '#^/v1/auth/tenants/[^/]+$#',
                'fields' => ['attributes'],
            ],
        ];
        $this->secret = $secret;
        $this->saasid = $saasid;
        $this->apikey = $apikey;
        $this->referer = $referer;
        $this->xSaasusReferer = $xSaasusReferer;
    }

    public function __invoke(callable $next)
    {
        $this->next = $next;
        return [$this, 'execute'];
    }

    public function execute(\Psr\Http\Message\RequestInterface $req, array $options)
    {
        $bodyString = (string)$req->getBody();

        // 1) 特定のエンドポイントだけ補正
        if ($rule = $this->findMatchingRule($req)) {
            $ct = $req->getHeaderLine('Content-Type');
            if (stripos($ct, 'application/json') !== false && $bodyString !== '') {
                $decoded = json_decode($bodyString, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $needsUpdate = false;
                    
                    foreach ($rule['fields'] as $fieldPath) {
                        if ($this->fixNestedField($decoded, $fieldPath)) {
                            $needsUpdate = true;
                        }
                    }

                    if ($needsUpdate) {
                        $bodyString = json_encode($decoded, JSON_UNESCAPED_UNICODE);
                        $req = $req->withBody(\GuzzleHttp\Psr7\Utils::streamFor($bodyString));
                    }
                }
            }
        }

        // 2) 署名は補正後のボディで計算
        $header = GuzzleMiddleware::getSignAsHeader(
            $this->secret,
            $this->apikey,
            $this->saasid,
            $req->getMethod(),
            $req->getHeaders()["Host"][0],
            $req->getUri()->getPath(),
            $req->getUri()->getQuery(),
            $bodyString
        );
        $req = $req->withHeader('Authorization', $header);
        if (!empty($this->referer)) {
            $req = $req->withHeader('Referer', $this->referer);
        }
        if (!empty($this->xSaasusReferer)) {
            $req = $req->withHeader('x-saasus-referer', $this->xSaasusReferer);
        }

        return call_user_func($this->next, $req, $options);
    }

    private function findMatchingRule(\Psr\Http\Message\RequestInterface $req): ?array
    {
        $method = strtoupper($req->getMethod());
        $path = $req->getUri()->getPath();

        foreach ($this->fixRules as $rule) {
            if ($rule['method'] === $method && preg_match($rule['path_re'], $path)) {
                return $rule;
            }
        }
        return null;
    }

    /**
     * 多次元配列内の値を、ドット記法のパスで指定して書き換える。
     *
     * @param array $data 更新対象のデータ配列（参照渡し）
     * @param string $fieldPath ドット記法のフィールドパス (例: 'wrapper_object.dynamic_data')
     * @return bool 更新が行われた場合は true
     */
    private function fixNestedField(array &$data, string $fieldPath): bool
    {
        // 1. 'wrapper_object.dynamic_data' のようなパスを '.' で分割し、キーの配列にする
        // 例: ['wrapper_object', 'dynamic_data']
        $keys = explode('.', $fieldPath);
        
        // 2. $pointerに元の$data配列への「参照(エイリアス)」をセットする
        // これにより、$pointerへの変更が直接$dataに反映される
        $pointer = &$data;

        // 3. 最後のキーを残して、配列の階層を順番に掘り下げる
        while (count($keys) > 1) {
            // 先頭のキーを取り出す (例: 'wrapper_object')
            $key = array_shift($keys);

            // もし途中の階層が存在しないか、配列でなければ処理を中断
            if (!isset($pointer[$key]) || !is_array($pointer[$key])) {
                return false;
            }

            // $pointerの参照先を、一つ下の階層の配列に移動させる
            $pointer = &$pointer[$key];
        }

        // 4. ループ終了後、配列に残っている最後のキーを取得
        // 例: 'dynamic_data'
        $lastKey = $keys[0];

        // 5. 最終的な場所の値が空の配列[]であるかチェック
        if (isset($pointer[$lastKey]) && $pointer[$lastKey] === []) {
            // 値が[]であれば、空のオブジェクトに書き換える
            // $pointerが参照なので、元の$data配列が直接変更される
            $pointer[$lastKey] = (object)[];
            return true; // 書き換えが成功したことを伝える
        }

        // 値が[]ではなかった、またはキーが存在しなかった場合
        return false;
    }

    public static function getSignAsHeader(
        string $secret,
        string $apikey,
        string $saasid,
        string $method,
        string $host,
        string $path,
        string $query,
        string $body
    ): string {

        if (empty($secret) || empty($apikey) || empty($saasid)) {
            return "";
        }

        $literal = "SAASUSSIGV1";

        $now = gmdate('YmdHi');
        $data = $now . $apikey . strtoupper($method) . $host . $path;
        if (!empty($query)) {
            $data = $data . "?" . $query;
        }
        $data = $data . $body;

        $sign = hash_hmac('sha256', $data, $secret);

        $header = sprintf(
            "%s Sig=%s, SaaSID=%s, APIKey=%s",
            $literal,
            $sign,
            $saasid,
            $apikey
        );
        return $header;
    }
}

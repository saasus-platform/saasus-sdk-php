<?php

namespace AntiPatternInc\Saasus\Laravel;

use AntiPatternInc\Saasus\Api\Client as SaasusClient;
use Illuminate\Support\ServiceProvider;

class SaasusServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * SaasusClient をシングルトン登録することで、同一ワーカープロセス内で
     * GuzzleClient（TCP接続プール）が再利用され、API呼び出しのパフォーマンスが向上する。
     */
    public function register(): void
    {
        $this->app->singleton(SaasusClient::class, function () {
            return new SaasusClient();
        });
    }

    public function boot(): void
    {
        //
    }
}

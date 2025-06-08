# SaaSus SDK PHP 開発ルール

1. OSS品質原則:
   - KISS原則（Keep It Simple, Stupid）に従い、複雑な抽象化を避ける
   - YAGNI原則（You Aren't Gonna Need It）を適用し、未使用のコード、クラス、メソッドを削除する
   - 外部依存関係を最小限に抑え、Laravel標準機能を優先する
   - 後方互換性を維持し、破壊的変更を避ける（例：`$request->merge()`の維持）

2. PHP互換性:
   - PHP 8.1以上をサポートし、PHP 8.4新機能（Property hooks、Asymmetric visibility）に対応する
   - 厳密な型宣言と適切な例外処理を使用する
   - 公開APIにPHPDocコメントを記述する

3. Laravel統合:
   - Laravel 9.x以上をサポートする（composer.json: ">=9 <13"）
   - `Illuminate\Routing\Controller`を基底クラスとして使用し、`App\Http\Controllers\Controller`を避ける
   - リクエストデータの変更には`$request->merge()`を使用し、`$request->attributes->set()`を避ける
   - Laravel標準のミドルウェアパターンに従う

4. コード品質:
   - 未使用のimport文とデッドコードを削除する
   - 意味のある変数名・メソッド名を使用する
   - メソッドは20行以内に抑え、ネストの深さを最小限にする
   - 早期リターンパターンを活用する
   - 技術的詳細を露出せず、ユーザーフレンドリーなエラーメッセージを提供する
# セキュリティルール（PHP / JavaScript）

WordPress テーマ開発において守るべきセキュリティルールをまとめる。

---

## PHP

### 1. 出力エスケープ（XSS 対策）

**ルール**
- HTML テキストノードに出力するときは必ず `esc_html()` を使う。
- HTML 属性値（`class`, `id`, `data-*` 等）には `esc_attr()` を使う。
- URL（`href`, `src`, `action` 等）には `esc_url()` を使う。
- JavaScript に値を埋め込む場合は `esc_js()` を使う。
- HTML タグを含むコンテンツを許可する場合は `wp_kses()` または `wp_kses_post()` を使い、許可タグを明示的に指定する。
- `echo` の直前に必ずエスケープ関数を呼ぶ。変数にエスケープ済み値を代入してから `echo` することは避け、`echo esc_html( $var )` のように一行で書く。

**禁止**
- `echo $var;` のような生の変数出力。
- `echo __( 'text', 'theme' );` のような翻訳文字列の無エスケープ出力 → `echo esc_html__( 'text', 'theme' );` を使う。

**実装例**
```php
// テキスト
echo esc_html( $title );

// 属性
echo '<div class="' . esc_attr( $class ) . '">';

// URL
echo '<a href="' . esc_url( $url ) . '">';

// 翻訳文字列
echo esc_html__( 'Read more', 'hakoniwa' );

// HTML を含む出力（投稿コンテンツ等）
echo wp_kses_post( $content );
```

---

### 2. 入力サニタイズ

**ルール**
- `$_GET`, `$_POST`, `$_REQUEST` などのユーザー入力は保存・処理前に必ずサニタイズする。
- 用途に合わせたサニタイズ関数を使う。

| 用途 | 関数 |
|---|---|
| 一般テキスト | `sanitize_text_field()` |
| 複数行テキスト | `sanitize_textarea_field()` |
| メールアドレス | `sanitize_email()` |
| URL | `esc_url_raw()` |
| 整数値 | `absint()` / `intval()` |
| HTML を含むコンテンツ | `wp_kses_post()` |
| スラッグ | `sanitize_key()` / `sanitize_title()` |
| ファイル名 | `sanitize_file_name()` |
| CSSクラス | `sanitize_html_class()` |

**禁止**
- `$_POST['field']` をサニタイズなしでデータベースや `update_option()` に渡す。

---

### 3. SQL インジェクション対策

**ルール**
- `$wpdb` で変数を使うクエリは必ず `$wpdb->prepare()` を使う。
- `%d`（整数）、`%s`（文字列）、`%f`（浮動小数）のプレースホルダーを使い、値を直接埋め込まない。
- WordPress コア関数（`get_posts()`, `WP_Query` 等）が使えるケースでは `$wpdb` の直接使用を避ける。

**実装例**
```php
// 正しい
$results = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT * FROM {$wpdb->posts} WHERE post_author = %d AND post_status = %s",
        $author_id,
        'publish'
    )
);

// 禁止
$results = $wpdb->get_results(
    "SELECT * FROM {$wpdb->posts} WHERE post_author = $author_id"
);
```

---

### 4. CSRF 対策（Nonce）

**ルール**
- フォームには必ず `wp_nonce_field()` を埋め込む。
- AJAX リクエストを処理するハンドラーでは `check_ajax_referer()` または `wp_verify_nonce()` でノンスを検証する。
- ノンスはアクション名を具体的に指定し、汎用的な名前にしない（例：`'hakoniwa_save_settings'`）。

**実装例**
```php
// フォームの出力
wp_nonce_field( 'hakoniwa_save_settings', '_wpnonce_settings' );

// 処理時の検証
if ( ! isset( $_POST['_wpnonce_settings'] )
    || ! wp_verify_nonce( sanitize_key( $_POST['_wpnonce_settings'] ), 'hakoniwa_save_settings' )
) {
    wp_die( esc_html__( 'Nonce verification failed.', 'hakoniwa' ) );
}
```

---

### 5. 権限チェック（Capability）

**ルール**
- 設定の保存・オプションの変更など管理者向け操作には `current_user_can()` で権限を確認する。
- `admin_post_*` や `wp_ajax_*` フックのハンドラーでは処理の先頭で権限チェックを行う。
- 権限チェックはノンス検証と必ずセットで行う（順序：権限チェック → ノンス検証）。

**実装例**
```php
add_action( 'wp_ajax_hakoniwa_action', 'hakoniwa_handle_ajax' );

function hakoniwa_handle_ajax() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Insufficient permissions', 403 );
    }

    check_ajax_referer( 'hakoniwa_nonce', 'nonce' );

    // 処理
}
```

---

### 6. ファイルへの直接アクセス防止

**ルール**
- PHP ファイルの先頭に `defined( 'ABSPATH' ) || exit;` を記述し、直接アクセスを防ぐ。
- ただし `functions.php` 等 WordPress が直接読み込むファイルには不要。

**実装例**
```php
<?php
defined( 'ABSPATH' ) || exit;
```

---

### 7. `wp_die()` と `exit` の使い方

**ルール**
- 処理を中断する場合は `exit` ではなく `wp_die()` を使う（WordPress の終了処理が正しく動作するため）。
- エラーメッセージを `wp_die()` に渡す場合はエスケープを忘れない。

---

## JavaScript

### 1. DOM 操作での XSS 対策

**ルール**
- ユーザー入力や外部データを DOM に挿入するときは `textContent` を使い、`innerHTML` を使わない。
- `innerHTML` を使わざるを得ない場合は、挿入前に DOMPurify 等でサニタイズする。
- `document.write()` は使用禁止。

**実装例**
```js
// 正しい
element.textContent = userInput;

// 禁止
element.innerHTML = userInput;
```

---

### 2. `eval()` および動的コード実行の禁止

**ルール**
- `eval()`, `new Function()`, `setTimeout('string', ...)`, `setInterval('string', ...)` は使用禁止。
- 動的に処理を切り替える場合はオブジェクトマップやコールバック関数を使う。

---

### 3. WordPress AJAX リクエスト

**ルール**
- `wp_ajax_*` に対してフロントエンドから AJAX リクエストを送る場合は、`wp_localize_script()` で渡した nonce をリクエストに含める。
- フェッチ時は `Content-Type: application/x-www-form-urlencoded` または `multipart/form-data` を使い、nonce パラメーターを含める。

**実装例**
```js
// wp_localize_script で渡されたオブジェクトを使用
const response = await fetch( hakoniwaData.ajaxUrl, {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({
        action: 'hakoniwa_action',
        nonce: hakoniwaData.nonce,
        data: sanitizedValue,
    }),
} );
```

---

### 4. URL の検証

**ルール**
- 外部から取得した URL を `href` や `src` に設定する前に、`URL` コンストラクタ等でプロトコルを検証する。
- `javascript:` スキームの URL は絶対に使用・許可しない。

**実装例**
```js
function isSafeUrl( url ) {
    try {
        const parsed = new URL( url );
        return [ 'https:', 'http:' ].includes( parsed.protocol );
    } catch {
        return false;
    }
}
```

---

### 5. ブロックエディター（Gutenberg）JavaScript

**ルール**
- ブロックの `save()` 関数内でユーザー入力値を HTML として出力する場合は、WordPress コンポーネント（`RichText.Content` 等）を使う。
- `dangerouslySetInnerHTML` は使用禁止。どうしても必要な場合は DOMPurify でサニタイズ済みの値のみを渡す。
- エディターが iframe 化された場合、`document.querySelector()` はエディター外の DOM を参照できないため、`useRef` または Block Editor API を使う（`wp-7-0.md` も参照）。

---

## 共通

- **最小権限の原則**：必要最小限の権限・スコープのみ要求する。
- **信頼境界の明確化**：テーマ内部のコードは信頼できるが、`$_GET/$_POST`、REST API リクエスト、外部 API レスポンスは必ず検証してから使う。
- **セキュリティ修正はその場で**：脆弱なコードを発見したら、後回しにせずその場で修正する。

# WordPressのコーディングのルール

## ルール
コーディング規約に従うこと。

## 参照 URL
https://developer.wordpress.org/coding-standards/wordpress-coding-standards/

# カラーピッカーのルール

## ルール
管理画面にカラー設定を追加する場合、jQueryのwpColorPickerを使用すること。

## 実装例
https://make.wordpress.org/core/2012/11/30/new-color-picker-in-wp-3-5/

# SVGアイコンのルール

## ルール
アイコンとして表示するコンテンツは SVG アイコンを使用すること。

### 例：閉じるボタン
```html
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" focusable="false"><path d="m13.06 12 6.47-6.47-1.06-1.06L12 10.94 5.53 4.47 4.47 5.53 10.94 12l-6.47 6.47 1.06 1.06L12 13.06l6.47 6.47 1.06-1.06L13.06 12Z"></path></svg>
```

---
paths:
  - "src/scss/**/*.scss"
---

# Navigation ブロック オーバーレイ CSS 統合ルール（ドラフト）

> ⚠️ WordPress 7.0 Beta 4 時点（2026年3月）の情報をもとに作成したドラフトです。
> 2026年3月19日公開予定の Field Guide で最終確認してください。

## 一次情報ソース

| ドキュメント | URL |
|---|---|
| Dev Note: Customisable Navigation Overlays in WordPress 7.0 | https://make.wordpress.org/core/2026/03/04/customisable-navigation-overlays-in-wordpress-7-0/ |
| What's new for developers (March 2026) | https://developer.wordpress.org/news/2026/03/whats-new-for-developers-march-2026/ |
| GitHub tracking issue #73084 | https://github.com/WordPress/gutenberg/issues/73084 |
| PR: Remove experiment | https://github.com/WordPress/gutenberg/pull/74968 |
| PR: Add Create Overlay button | https://github.com/WordPress/gutenberg/pull/74971 |
| PR: Update overlay template part naming | https://github.com/WordPress/gutenberg/pull/75564 |
| PR: Filter navigation category patterns | https://github.com/WordPress/gutenberg/pull/75276 |

---

## 概要：何が変わったか

WordPress 7.0 以前は、モバイルでハンバーガーメニューをタップした際に表示されるオーバーレイは固定デザインでカスタマイズ不可だった。7.0 からは「Navigation Overlay」という新しい **template part エリア**として実装され、ブロックとパターンで自由にオーバーレイをデザインできるようになった。

また、この機能は**実験的フラグが外れ正式機能として WordPress 7.0 に同梱**される。

---

## CSS 統合の考え方

### オーバーレイの CSS スコープ

オーバーレイは `navigation-overlay` エリアの template part として独立して描画される。そのため CSS のスコープは以下の 2 層に分かれる。

```
.wp-block-navigation               ← Navigation ブロック本体（既存）
└── [overlay trigger: ハンバーガーボタン等]

.wp-block-template-part            ← Navigation Overlay template part（新規）
└── .wp-block-group（等）          ← オーバーレイ内のブロック群
    └── .wp-block-navigation-overlay-close  ← クローズボタン（新規ブロック）
```

既存の `.wp-block-navigation` に書いていたオーバーレイ用スタイルと、新しい template part のスタイルは**別々のセレクターで管理**する必要がある。

---

## ルール一覧

### 1. 既存のオーバーレイ CSS を移行する

**背景**
以前のオーバーレイは Navigation ブロック内部に描画されていたため、`.wp-block-navigation .wp-block-navigation__responsive-container` などのセレクターでスタイルを当てていたケースがある。7.0 ではオーバーレイが template part として独立するため、これらのセレクターが**効かなくなる可能性がある**。

**ルール**
- 既存テーマ内で `.wp-block-navigation__responsive-container` や `.wp-block-navigation__responsive-container-content` に対してオーバーレイ向けのスタイル（背景色、アニメーション、z-index 等）を当てている箇所を洗い出すこと。
- オーバーレイ template part のスタイルは、`.wp-block-template-part` または独自のラッパークラスをセレクターのルートとして再定義すること。
- `style.css` と `editor-style.css` の両方を確認し、エディターとフロントエンドで見た目を統一すること。

**参照元**
- https://make.wordpress.org/core/2026/03/04/customisable-navigation-overlays-in-wordpress-7-0/

---

### 2. Navigation Overlay Close ブロックのスタイルを必ず定義する

**背景**
オーバーレイ template part に `<!-- wp:navigation-overlay-close /-->` を含めない場合、WordPress がフォールバックとしてクローズボタンを自動挿入するが、そのボタンのデザインはテーマのスタイルが適用されない可能性がある。

**ルール**
- オーバーレイの template part ファイルには必ず `<!-- wp:navigation-overlay-close /-->` を明示的に含めること。
- `.wp-block-navigation-overlay-close` に対してボタンのスタイル（サイズ・色・位置・hover状態）を定義すること。
- フォールバックボタンへの依存を避けるため、クローズボタンの省略は禁止とする。

**実装例**
```html
<!-- parts/navigation-overlay.html -->
<!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group">
    <!-- wp:navigation-overlay-close /-->
    <!-- wp:navigation {"layout":{"type":"flex","orientation":"vertical"}} /-->
</div>
<!-- /wp:group -->
```

```css
/* theme CSS */
.wp-block-navigation-overlay-close {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    background: transparent;
    border: none;
    cursor: pointer;
    color: var(--wp--preset--color--foreground);
}

.wp-block-navigation-overlay-close:hover {
    opacity: 0.7;
}
```

**参照元**
- https://make.wordpress.org/core/2026/03/04/customisable-navigation-overlays-in-wordpress-7-0/

---

### 3. theme.json で `navigation-overlay` エリアを登録する

**背景**
template part を `theme.json` に登録せずに `parts/` ディレクトリに置いても、Navigation ブロックはそれをオーバーレイとして認識しない（`uncategorized` エリアに分類される）。

**ルール**
- `theme.json` の `templateParts` 配列にオーバーレイの定義を追加し、`area` を必ず `"navigation-overlay"` に設定すること。
- `name` はスラッグのみを使用し、テーマプレフィックスを含めないこと（将来のテーマスイッチ対応のため）。

**実装例**
```json
{
    "templateParts": [
        {
            "area": "navigation-overlay",
            "name": "navigation-overlay",
            "title": "Navigation Overlay"
        }
    ]
}
```

**参照元**
- https://make.wordpress.org/core/2026/03/04/customisable-navigation-overlays-in-wordpress-7-0/

---

### 4. オーバーレイパターンの `blockTypes` を正しく指定する

**背景**
`register_block_pattern()` で `blockTypes` に `core/template-part/navigation-overlay` を指定しないと、パターンが一般のブロックインサーターにも表示されてしまい、誤った場所に挿入されるリスクがある。

**ルール**
- オーバーレイ用パターンの登録では `blockTypes` に `array( 'core/template-part/navigation-overlay' )` を必ず指定すること。
- これにより、パターンは「Navigation Overlay の編集時のみ」表示される。

**実装例**
```php
register_block_pattern(
    'my-theme/navigation-overlay-default',
    array(
        'title'      => __( 'Default Overlay', 'my-theme' ),
        'categories' => array( 'navigation' ),
        'blockTypes' => array( 'core/template-part/navigation-overlay' ),
        'content'    => '<!-- wp:group ... -->...',
    )
);
```

**参照元**
- https://make.wordpress.org/core/2026/03/04/customisable-navigation-overlays-in-wordpress-7-0/

---

### 5. Navigation ブロックの `overlay` 属性はスラッグのみ使用する

**背景**
Navigation ブロークの markup でオーバーレイを事前指定する場合、`overlay` 属性にテーマプレフィックス付きのスラッグを使うと、将来的にテーマスイッチ後の互換性が壊れる。

**ルール**
- `overlay` 属性にはスラッグのみを指定する（テーマプレフィックスなし）。
- `header` や `footer` と同じ命名規則に従う。

```html
<!-- 正しい -->
<!-- wp:navigation {"overlay":"navigation-overlay"} /-->

<!-- 誤り（テーマプレフィックスを含む） -->
<!-- wp:navigation {"overlay":"my-theme/navigation-overlay"} /-->
```

**参照元**
- https://make.wordpress.org/core/2026/03/04/customisable-navigation-overlays-in-wordpress-7-0/

---

### 6. 現時点の制約を把握した上で実装する

**ルール**
以下は WordPress 7.0 時点での既知の制約であり、将来のバージョンで改善予定。これらを前提に設計すること。

| 制約 | 詳細 | 追跡 Issue |
|---|---|---|
| テーマスイッチで失われる | オーバーレイ template part は現在のテーマに紐づく。テーマを切り替えるとカスタムオーバーレイは引き継がれない | [gutenberg#72452](https://github.com/WordPress/gutenberg/issues/72452) |
| 全画面のみ | 7.0 ではオーバーレイは常に全画面表示。サイドバードロワー等の非全画面スタイルは未対応（`<dialog>` 要素対応は将来リリース予定） | - |
| 汎用ポップアップではない | Navigation Overlay は Navigation ブロック専用。汎用モーダルは別途開発中の Dialog ブロックを使用予定 | [gutenberg#61297](https://github.com/WordPress/gutenberg/issues/61297) |

**参照元**
- https://make.wordpress.org/core/2026/03/04/customisable-navigation-overlays-in-wordpress-7-0/

---

### 7. 既存テーマの移行チェックリスト

既存テーマを WordPress 7.0 に対応させる際は、以下の順序で作業すること。

- [ ] 既存 CSS で `.wp-block-navigation__responsive-container` 等オーバーレイ関連のセレクターを検索・洗い出す
- [ ] `theme.json` に `navigation-overlay` エリアの templatePart 定義を追加する
- [ ] `parts/navigation-overlay.html` を作成し、`wp:navigation-overlay-close` を必ず含める
- [ ] `style.css` にオーバーレイ template part 向けの CSS を追記する（`.wp-block-navigation-overlay-close` 含む）
- [ ] `editor-style.css` にも同様のスタイルを追記し、エディター上の見た目と統一する
- [ ] オーバーレイパターンを `register_block_pattern()` で登録する（`blockTypes` 指定必須）
- [ ] サイトエディターで Navigation ブロックのオーバーレイ設定が正しく動作するか確認する
- [ ] モバイル実機またはデベロッパーツールでオーバーレイの表示・クローズ動作を確認する

---

## 更新履歴

| 日付 | 内容 |
|---|---|
| 2026-03-13 | WordPress 7.0 Beta 4 + Dev Note 情報をもとにドラフト作成 |
| （予定）2026-03-19以降 | Field Guide 公開後に追記・修正 |

# WordPressのコンポーネントのルール

## 対象コンポーネント
TextControl / RangeControl / SelectControl / ToggleControl / CheckboxControl / BaseControl

## ルール
対象コンポーネントを使う際は、属性に「__nextHasNoMarginBottom」と「__next40pxDefaultSize」をインデントを一つ下げて追加すること。

## 例
```jsx
<SelectControl 
	__nextHasNoMarginBottom
	__next40pxDefaultSize />
```

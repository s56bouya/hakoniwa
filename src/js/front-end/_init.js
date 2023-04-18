import { hakoniwaSmoothScroll } from './_smooth-scroll';
import { hakoniwaScrollTopButton } from './_scroll-top';

/** Init（ドキュメントを全部読み込んだ後の設定） */

function hakoniwaInit() {

	/** スムーススクロール */
	hakoniwaSmoothScroll();

	/** スクロールトップボタン */
	hakoniwaScrollTopButton();

}

export { hakoniwaInit };

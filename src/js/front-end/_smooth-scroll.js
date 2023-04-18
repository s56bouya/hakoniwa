/** Smooth Scroll */

import { hakoniwaGetHeaderHeight } from './_functions';

const getHeaderHeight = hakoniwaGetHeaderHeight();

function hakoniwaSmoothScroll() {
	( function (
		window,
		undefined,
		getHeaderHeight // Code in a function to create an isolate scope
	) {
		'use strict';

		let heightFixedHeader = getHeaderHeight, // For layout with header with position:fixed. Write here the height of your header for your anchor don't be hiden behind
			//links = document.getElementsByTagName('a'), // ページ内のリンクタグを全取得
			href;

		const speed = 300,
			movingFrequency = 10, // 数値が高いほどスムーズになる
			links = document.querySelectorAll( 'a:not(.noscroll)' );

		const getUrl = window.location;
		const baseUrl =
			getUrl.protocol +
			'//' +
			getUrl.host +
			'/' +
			getUrl.pathname.split( '/' )[ 1 ] +
			'/';

		// 見つかったaタグの数だけループ
		for ( let i = 0; i < links.length; i++ ) {
			href =
				links[ i ].attributes.href === undefined
					? null
					: links[ i ].attributes.href.nodeValue.toString();

			// 現在のURL https://aaa.com/
			// #chapter-1
			// https://aaa.com/#chapter-1

			// https://aaa.com/
			// https://bbb.com#chapter-1

			// #を抜いたURLがbaseUrlと同じならスクロール実行
			let scrollFlag = false;
			if ( href !== null ) {
//				const targetUrl = href.substr( 0, href.indexOf( '#' ) );
				const targetUrl = href.substring( 0, href.indexOf( '#' ) );

				if ( baseUrl === targetUrl || ! targetUrl ) {
					//				if( ( baseUrl === targetUrl || ! targetUrl ) && href.indexOf('#') !== -1 ){
					scrollFlag = true;
				}
			}

			if (
				href !== null &&
				href.length > 1 &&
				href.indexOf( '#' ) !== -1 &&
				scrollFlag === true
			) {
				// href.substr(0, 1) == '#'
				links[ i ].onclick = function () {
					let element,
						href = this.attributes.href.nodeValue.toString(),
//						url = href.substr( 0, href.indexOf( '#' ) ), // #を抜いたURL
//						id = href.substr( href.indexOf( '#' ) + 1 ); // #以降の文字列
						url = href.substring( 0, href.indexOf( '#' ) ), // #を抜いたURL
						id = href.substring( href.indexOf( '#' ) + 1 ); // #以降の文字列
					if ( ( element = document.getElementById( id ) ) ) {
						const hopCount =
								( speed - ( speed % movingFrequency ) ) /
								movingFrequency, // Always make an integer
							getScrollTopDocumentAtBegin = getScrollTopDocument(),
							gap =
								( getScrollTopElement( element ) -
									getScrollTopDocumentAtBegin ) /
								hopCount;

						if (
							window.history &&
							typeof window.history.pushState === 'function'
						)
							window.history.pushState(
								{},
								undefined,
								url + '#' + id
							); // Change URL for modern browser

						for ( let j = 1; j <= hopCount; j++ ) {
							( function () {
								const hopTopPosition = gap * j;
								setTimeout( function () {
									window.scrollTo(
										0,
										hopTopPosition +
											getScrollTopDocumentAtBegin
									);
								}, movingFrequency * j );
							} )();
						}

						return false;
					}
				};
			}
		}

		const getScrollTopElement = function ( e ) {
			let top = heightFixedHeader * -1;

			while ( e.offsetParent !== undefined && e.offsetParent !== null ) {
				top += e.offsetTop + ( e.clientTop !== null ? e.clientTop : 0 );
				e = e.offsetParent;
			}

			return top;
		};

		const getScrollTopDocument = function () {
			return window.pageYOffset !== undefined
				? window.pageYOffset
				: document.documentElement.scrollTop !== undefined
				? document.documentElement.scrollTop
				: document.body.scrollTop;
		};
	} )( window, undefined, getHeaderHeight );
}

export { hakoniwaSmoothScroll };

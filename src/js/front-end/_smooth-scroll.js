/** Smooth Scroll */

const getHeaderHeight = 0;

function hakoniwaSmoothScroll() {
	( function (
		window,
		undefined,
		getHeaderHeight // Code in a function to create an isolate scope
	) {
		'use strict';

		let heightFixedHeader = getHeaderHeight, // For layout with header with position:fixed. Write here the height of your header for your anchor don't be hiden behind
			href;

		const speed = 300,
			movingFrequency = 10,
			links = document.querySelectorAll( 'a:not(.noscroll)' );

		const getUrl = window.location;
		const baseUrl =
			getUrl.protocol +
			'//' +
			getUrl.host +
			'/' +
			getUrl.pathname.split( '/' )[ 1 ] +
			'/';

		for ( let i = 0; i < links.length; i++ ) {
			href =
				links[ i ].attributes.href === undefined
					? null
					: links[ i ].attributes.href.nodeValue.toString();

			let scrollFlag = false;
			if ( href !== null ) {
				const targetUrl = href.substring( 0, href.indexOf( '#' ) );

				if ( baseUrl === targetUrl || ! targetUrl ) {
					scrollFlag = true;
				}
			}

			if (
				href !== null &&
				href.length > 1 &&
				href.indexOf( '#' ) !== -1 &&
				scrollFlag === true
			) {
				links[ i ].onclick = function () {
					let element,
						href = this.attributes.href.nodeValue.toString(),
						url = href.substring( 0, href.indexOf( '#' ) ),
						id = href.substring( href.indexOf( '#' ) + 1 );
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

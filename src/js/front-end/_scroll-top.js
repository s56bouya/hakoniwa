/**
 * Scroll Top Button
 *
 */
function hakoniwaScrollTopButton() {
	const button = document.getElementById( 'scroll-page-top' );
	if( !! button ){
		let hakoniwaScrollTopButtonInterval = null;

		window.addEventListener('scroll', function () {
			const e = window.pageYOffset || document.documentElement.scrollTop;
			hakoniwaScrollTopButtonInterval = setTimeout(function () {
				if ( e > 100 ) {
					button.classList.add( 'show' );
				} else {
					button.classList.remove( 'show' );
				}
			}, 100);
		}, false);		
	}
}

export { hakoniwaScrollTopButton };

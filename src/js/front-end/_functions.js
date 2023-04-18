/** Event Listener */
function hakoniwaRegisterListener( event, func ) {
	if ( window.addEventListener ) {
		window.addEventListener( event, func );
	} else {
		window.attachEvent( 'on' + event, func );
	}
}

/** Get Header Height */
function hakoniwaGetHeaderHeight() {
	const tocFixedHeader = document.getElementById( 'hakoniwa-toc-fixed' );
	const html = document.documentElement;
	const masthead = document.getElementById( 'masthead' );
	const mobileSize = 768;
	let headerHeight = 0;

	//tocがある時はtocで70
	if ( !! tocFixedHeader ) {
		headerHeight = tocFixedHeader.clientHeight;
	} else {
		//tocがない時は、ヘッダーの高さだけど、固定ヘッダーかどうかで取得する
		if ( !! masthead && masthead.classList.contains( 'sticky' ) ) {
			headerHeight = masthead.clientHeight;
		}

		//画面サイズが768pxより小さい場合&モバイル表示のヘッダーが固定されている時
		if (
			!! masthead &&
			html.clientWidth < mobileSize &&
			masthead.classList.contains( 'fixed-mobile' )
		) {
			headerHeight = masthead.clientHeight;
		}
	}
	return headerHeight;
}

export { hakoniwaRegisterListener, hakoniwaGetHeaderHeight };

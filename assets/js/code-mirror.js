document.addEventListener('DOMContentLoaded', function(){
	let cssFrontEnd = document.getElementById('css_front_end');
	let cssBackEnd = document.getElementById('css_back_end');
	let css = document.getElementById('css');

	// Codemirror を初期設定
	codemirror_init(cssFrontEnd);
	codemirror_init(cssBackEnd);
	codemirror_init(css);

	function codemirror_init(e){

		if( !! e ){
			// エディターを Codemirror に置き換え
			return wp.codeEditor.initialize( e, cm_settings );
		}
	}
});

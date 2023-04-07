<?php
/**
 * Add Drawer Menu CSS
 *
 * @return $output
 */
function nishiki_pro_drawer_menu_css() {
	$output            = '';
	$drawer_menu_width = 768;

	// Drawer Menu の CSS 読み込み
	$data = file_get_contents( get_template_directory() . '/assets/css/drawer-menu.min.css' );

	// Drawer Menu の Width 読み込み
	if ( true === get_theme_mod( 'setting_header_menu_collapse', true ) ) {
		$drawer_menu_width = absint( apply_filters( 'nishiki_pro_header_drawer_menu_width', get_theme_mod( 'setting_header_drawer_menu_width', 768 ) ) );
	}

	// CSS 変数読み込み
	$output .= '@media only screen and ( max-width: ' . $drawer_menu_width . 'px ){' . $data . '}';

	// Output
	if ( '' === $output ) {
		return false;
	}
	$str    = array( "\t", "\r\n", "\r", "\n" );
	$output = str_replace( $str, '', $output );

	return $output;
}

<?php
/**
 * Add Costomizer CSS
 *
 * @return $output
 */
function nishiki_pro_customizer_css_block_editor() {
	require_once get_template_directory() . '/library/css-variables.php';
	$css_variables = new NISHIKI_PRO_CSS_VARIABLES();

	$output = '';
	$root   = '';
	$root  .= $css_variables->output();

	/*****************
	 * Font Family
	 */

	// Get Option
	$nishiki_pro_font_option = get_option( 'nishiki_pro_general_font' );
	$nishiki_pro_font_family = NISHIKI_PRO_FONT_FAMILY;

	if ( ! empty( $nishiki_pro_font_option ) && ! empty( $nishiki_pro_font_option['font_family'] ) ) {
		$nishiki_pro_font_family = wp_kses_post( $nishiki_pro_font_option['font_family'] );
	}

	$output .= "
			body.block-editor-page .editor-styles-wrapper,body.block-editor-page .editor-styles-wrapper .editor-post-title__block .editor-post-title__input{font-family:{$nishiki_pro_font_family};}
		";

	/*****************
	* Title Tagline
	*/

	// Site Contents Width
	$site_content_width_variable = 'var(--nishiki-pro-site-content-width)';
	$sidebar_width               = 0;
	$get_template                = get_page_template_slug( get_the_ID() );
	$sidebar_flag                = false;

	if ( get_post_type() === 'post' ) {
		$post_column = esc_html( get_theme_mod( 'setting_post_column', 'none' ) );

		if ( ( 'left' === $post_column || 'right' === $post_column ) && '' === $get_template ) {
			$sidebar_flag = true;
		}

		if ( 'templates/sidebar-left.php' === $get_template || 'templates/sidebar-right.php' === $get_template ) {
			$sidebar_flag = true;
		}

		if ( $sidebar_flag ) {
			$sidebar_width = absint( get_theme_mod( 'setting_post_sidebar_width', '300' ) ) + absint( get_theme_mod( 'setting_post_sidebar_margin', '50' ) );
		}
	}

	if ( get_post_type() === 'page' ) {
		$page_column = esc_html( get_theme_mod( 'setting_page_column', 'none' ) );

		if ( ( 'left' === $page_column || 'right' === $page_column ) && '' === $get_template ) {
			$sidebar_flag = true;
		}

		if ( 'templates/sidebar-left.php' === $get_template || 'templates/sidebar-right.php' === $get_template ) {
			$sidebar_flag = true;
		}

		if ( $sidebar_flag ) {
			$sidebar_width = absint( get_theme_mod( 'setting_page_sidebar_width', '300' ) ) + absint( get_theme_mod( 'setting_page_sidebar_margin', '50' ) );
		}
	}

	// サイドバー+マージンを引く
	if ( 0 !== $sidebar_width ) {
		$output .= "
		.wp-block{
			max-width:calc( {$site_content_width_variable} - {$sidebar_width}px );
		}
		";
	} else {
		$output .= "
		.wp-block{
			max-width:{$site_content_width_variable};
		}
		";
	}

	// Base Color
	$site_base_color_variable = 'var(--nishiki-pro-base-color)';

	// Accent Color 01
	$site_accent_color_01_variable = 'var(--nishiki-pro-accent-color-01)';

	// Accent Color 02
	$site_accent_color_01_variable = 'var(--nishiki-pro-accent-color-02)';

	// Text Color 01
	$site_text_color_01_variable = 'var(--nishiki-pro-text-color-01)';

	// Text Color 02
	$site_text_color_02_variable = 'var(--nishiki-pro-text-color-02)';

	// Link Color 01
	$site_link_color_01_variable = 'var(--nishiki-pro-link-color-01)';

	// Link Color 02
	$site_link_color_02_variable = 'var(--nishiki-pro-link-color-02)';

	$output .= "
		.editor-styles-wrapper {			
			color:{$site_text_color_01_variable};
		}
		";

	$output .= "
		.editor-styles-wrapper{
			background-color:{$site_base_color_variable};
		}	
		";

	// Link Color 01
	$output .= "
		.editor-styles-wrapper a{
			color:{$site_link_color_01_variable};
		}
		";

	// Link Color 02
	$output .= "
		.editor-styles-wrapper a:hover{
			color:{$site_link_color_02_variable};
		}
		";

	// Post Title Color
	$post_title_text_color = esc_html( get_theme_mod( 'setting_post_title_text_color', '#ffffff' ) );

	$output .= "
	.post-type-post .editor-post-title__block .editor-post-title__input{
		color:{$post_title_text_color};
		padding-left:0.5em;
		padding-right:0.5em;
	}
	.post-type-post .editor-post-title__block .editor-post-title__input::placeholder{
		color:{$post_title_text_color}66;
	}
	";

	// Post Title Background Color
	$post_title_background_color = esc_html( get_theme_mod( 'setting_post_title_background_color', '#222222' ) );
	$output                     .= ".post-type-post .editor-post-title__block .editor-post-title__input{background-color:{$post_title_background_color};}";

	// Page Title Color
	$page_title_text_color = esc_html( get_theme_mod( 'setting_page_title_text_color', '#ffffff' ) );
	$output               .= ".post-type-page .editor-post-title__block .editor-post-title__input{color:{$page_title_text_color};}
	.post-type-page .editor-post-title__block .editor-post-title__input::placeholder{color:{$page_title_text_color}66;}";

	// Page Title Background Color
	$page_title_background_color = esc_html( get_theme_mod( 'setting_page_title_background_color', '#222222' ) );
	$output                     .= ".post-type-page .editor-post-title__block .editor-post-title__input{background-color:{$page_title_background_color};}";

	$output = ':root{' . $root . '}' . $output;

	// Output
	if ( '' === $output ) {
		return false;
	}
	$str    = array( "\t", "\r\n", "\r", "\n" );
	$output = str_replace( $str, '', $output );

	return $output;
}


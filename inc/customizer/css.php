<?php
/**
 * Add Costomizer CSS
 *
 * @return $output
 */
function nishiki_pro_customizer_css() {
	// CSS 変数読み込み
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
			body, button, input, select, textarea{font-family:{$nishiki_pro_font_family};}
		";

	/*****************
	* Title Tagline
	*/

	// Site Contents Width
	$site_content_width_variable = 'var(--nishiki-pro-site-content-width)';

	$output .= "
		.container{
			max-width:min( calc( 100vw - 12% ), {$site_content_width_variable} );
		}

		.alignfull [class*='inner-container'],
		.alignwide [class*='inner-container']{
			margin-right: auto;
		    margin-left: auto;
		}

		.alignwide{
			width:min( 100%, calc( {$site_content_width_variable} * 1.2 ) );
		}

		.alignfull [class*=inner-container] > .alignwide,
		.alignwide [class*=inner-container] > .alignwide{
			width:revert;
		}

		.single .sidebar-none #main > .container > * > * > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide):not(.author-info),
		*[class*=inner-container] > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide),
		.single .sidebar-bottom #main > .container > * > * > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide):not(.author-info),
		.page .show-on-front-page #main > .container > * > * > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide):not(.author-info),
		.page .sidebar-none #main > .container > * > * > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide):not(.author-info),
		.page .sidebar-bottom #main > .container > * > * > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide):not(.author-info){
			max-width:min( calc( 100vw - 12% ), {$site_content_width_variable} );margin-left:auto;margin-right:auto;
		}
		";

	// 個別設定されている場合
	if ( is_singular() ) {
		$site_custom_content_width = get_post_meta( get_the_ID(), '_nishiki_pro_meta_box_content_width_' . get_post_type(), true );

		// 0 または空じゃなければ変数定義 & 出力
		if ( '0' !== $site_custom_content_width && ! empty( $site_custom_content_width ) ) {
			$root .= "--nishiki-pro-site-custom-content-width:{$site_custom_content_width}px;";

			$site_custom_content_width_variable = 'var(--nishiki-pro-site-custom-content-width)';

			$output .= "
			.container{
				max-width:min( calc( 100vw - 12% ), {$site_custom_content_width_variable} );
			}

			.alignwide{
				width:min( 100%, calc( {$site_custom_content_width_variable} * 1.2 ) );
			}

			.single .sidebar-none #main > .container > * > * > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide):not(.author-info),
			*[class*=inner-container] > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide),
			.single .sidebar-bottom #main > .container > * > * > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide):not(.author-info),
			.page .show-on-front-page #main > .container > * > * > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide):not(.author-info),
			.page .sidebar-none #main > .container > * > * > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide):not(.author-info),
			.page .sidebar-bottom #main > .container > * > * > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide):not(.author-info){
				max-width:min( calc( 100vw - 12% ), {$site_custom_content_width_variable} );
			}
			";
		}
	}

	/*****************
	* Color
	*/

	// Base Color
	$site_base_color_variable = 'var(--nishiki-pro-base-color)';

	$output .= "
		body{
			background-color:{$site_base_color_variable};
		}
		";

	// Text Color 01
	$site_text_color_01_variable = 'var(--nishiki-pro-text-color-01)';

	$output .= "
		body,
		.articles a,
		.articles a:hover{
			color:{$site_text_color_01_variable};
		}
		input::placeholder{
			color:{$site_text_color_01_variable}66;
		}
		input:hover[type='submit'],
		button:hover[type='submit']{
			background:{$site_text_color_01_variable};
			border-color:{$site_text_color_01_variable};
			color:{$site_base_color_variable};
		}
		input,
		button[type='submit'],
		textarea{
			color:{$site_text_color_01_variable};
			border-color:{$site_text_color_01_variable};
		}
		select{
			border-color:{$site_text_color_01_variable};
		}
		input[type='checkbox']:checked{
			border-color:{$site_text_color_01_variable};
			background-color:{$site_text_color_01_variable};
		}
		input[type='checkbox']:checked:before{
			color:{$site_base_color_variable};
		}
		input[type='radio']:checked{
			border-color:{$site_text_color_01_variable};
			background-color:{$site_text_color_01_variable};
		}
		input[type='radio']:checked:before{
			color:{$site_base_color_variable};
		}
		";

	// Text Color 02
	$site_text_color_02_variable = 'var(--nishiki-pro-text-color-02)';

	$output .= "
		aside section a,
		aside section ul li,
		.comments-area .comment-list li .comment-body,
		.comments-area .comment-form-comment{
			border-color:{$site_text_color_02_variable};
		}
		.comments-area .comment-list li .comment-date,
		.comments-area cite,
		.comments-area cite a{
			color:{$site_text_color_02_variable};
		}
		.comments-area .comment-form-comment{
			border-color:{$site_text_color_02_variable};
		}
		table,table td,table th{
			border-color:{$site_text_color_02_variable};
		}
		table::-webkit-scrollbar-thumb:horizontal{
			background-color:{$site_text_color_02_variable};
		}
		.wp-block-table thead,
		.wp-block-table tfoot{
			border-color: {$site_text_color_02_variable};
		}
		input[type='submit'][disabled]{
			border-color:{$site_text_color_02_variable};
			color:{$site_text_color_02_variable};
			pointer-events: none;
		}
		input:hover[type='submit'][disabled]{
			background:none;
			color:{$site_text_color_02_variable};
		}
		";

	// Link Color 01
	$site_link_color_01_variable = 'var(--nishiki-pro-link-color-01)';

	$output .= "
		a{
			color:{$site_link_color_01_variable};
		}
		.tagcloud a{
			border-color:{$site_link_color_01_variable};
		}
		";

	// Main Link Color 02
	$site_link_color_02_variable = 'var(--nishiki-pro-link-color-02)';

	$output .= "
		a:hover{
			color:{$site_link_color_02_variable};
		}
		";

	// Accent Color 01

	// Accent Color 02

	// Exclude Color
	$output .= '
		.wp-block-social-links a,
		.wp-block-social-links a:hover{
			color:inherit;
		}
		';

	// Site Font Size
	$site_font_size = absint( get_theme_mod( 'setting_site_font_size', '16' ) );
	$output        .= "
		html,button,input[type=submit]{
			font-size:{$site_font_size}px;
		}
		";

	/*****************
	 * Top
	 */

	// Recently Post background color
	$top_recently_article_sticky_background_color = esc_html( get_theme_mod( 'setting_top_recently_article_sticky_background_color', '#557c4c' ) );
	$output                                      .= ".articles article.sticky::before{border-color:{$top_recently_article_sticky_background_color} transparent transparent transparent;}";

	/*****************
	 * Front
	 */

	for ( $i = 1; $i <= NISHIKI_PRO_SECTION_NUM; ++$i ) {
		// Text Color
		$front_page_text_color = esc_html( get_theme_mod( 'setting_front_page_text_color' . $i, '#222222' ) );
		$output               .= "#front-page-section{$i}{color:{$front_page_text_color};}";

		// Text Align
		$front_page_text_align = esc_html( get_theme_mod( 'setting_front_page_text_align' . $i, 'left' ) );
		$output               .= "#front-page-section{$i}{text-align:{$front_page_text_align};}";
		if ( 'center' !== $front_page_text_align ) {
			$output .= "#front-page-section{$i} .sub-text{padding-{$front_page_text_align}:0;}";
		}

		// Image Placeholder Grayscale
		$front_page_image_placeholder_grayscale = absint( get_theme_mod( 'setting_front_page_image_placeholder_grayscale' . $i, '100' ) );
		$output                                .= "#front-page-section{$i} img.img-placeholder{filter:blur(15px) grayscale({$front_page_image_placeholder_grayscale}%);}";

		// Background Color
		$front_page_background_color = esc_html( get_theme_mod( 'setting_front_page_background_color' . $i, '#222222' ) );
		$output                     .= "#front-page-section{$i}::after{background-color:{$front_page_background_color};}";

		// Background Opacity
		$front_page_background_opacity = absint( get_theme_mod( 'setting_front_page_background_opacity' . $i, '30' ) );
		$front_page_opacity            = $front_page_background_opacity / 100;
		$output                       .= "#front-page-section{$i}::after{opacity:{$front_page_opacity};}";

		// Button Text Color
		$front_page_button_text_color = esc_html( get_theme_mod( 'setting_front_page_button_text_color' . $i, '#ffffff' ) );
		$output                      .= "#front-page-section{$i} .main-button a{color:{$front_page_button_text_color};}";

		// Button Link Color
		$front_page_button_link_color = esc_html( get_theme_mod( 'setting_front_page_button_link_color' . $i, '#222222' ) );
		$output                      .= "#front-page-section{$i} .main-button a{background-color:{$front_page_button_link_color};}";

		// Button Hover Color
		$output .= "#front-page-section{$i} .main-button a:hover{background-color:{$front_page_button_text_color};color:{$front_page_button_link_color};}";

		/*****************
		 * Featured Item
		 */
		$j = 1;
		while ( $j <= NISHIKI_PRO_FEATURED_ITEM_NUM ) {
			// Item Icon Color
			$front_page_featured_item_icon_color = esc_html( get_theme_mod( 'setting_front_page_featured_item_icon_color' . $i . '_' . $j, '#222222' ) );
			$output                             .= "#front-page-section{$i} .featured-items .featured-item{$j} i{color:{$front_page_featured_item_icon_color};}";

			// Item Title Color
			$front_page_featured_item_title_color = esc_html( get_theme_mod( 'setting_front_page_featured_item_title_color' . $i . '_' . $j, '#222222' ) );
			$output                              .= "#front-page-section{$i} .featured-items .featured-item{$j} .featured-title{color:{$front_page_featured_item_title_color};}";

			// Item Text Color
			$front_page_featured_item_text_color = esc_html( get_theme_mod( 'setting_front_page_featured_item_text_color' . $i . '_' . $j, '#222222' ) );
			$output                             .= "#front-page-section{$i} .featured-items .featured-item{$j} .featured-text{color:{$front_page_featured_item_text_color};}";

			// Item Button Text Color
			$front_page_featured_item_button_text_color = esc_html( get_theme_mod( 'setting_front_page_featured_item_button_text_color' . $i . '_' . $j, '#ffffff' ) );
			$output                                    .= "#front-page-section{$i} .featured-items .featured-item{$j} .featured-button a{color:{$front_page_featured_item_button_text_color};}";

			// Item Button Link Color
			$front_page_featured_item_button_link_color = esc_html( get_theme_mod( 'setting_front_page_featured_item_button_link_color' . $i . '_' . $j, '#222222' ) );
			$output                                    .= "#front-page-section{$i} .featured-items .featured-item{$j} .featured-button a{background-color:{$front_page_featured_item_button_link_color};}";

			// Item Button Hover Color
			$output .= "#front-page-section{$i} .featured-items .featured-item{$j} .featured-button a:hover{background-color:{$front_page_featured_item_button_text_color};color:{$front_page_featured_item_button_link_color};}";

			$j++;
		}
	}

	/*****************
	 * Header
	 */

	// Header Contents Width
	$header_contents_width = absint( get_theme_mod( 'setting_header_contents_width', '1000' ) );
	$output               .= "
		#masthead .container{
			max-width:min( calc( 100vw - 12% ),{$header_contents_width}px );
		}
		";

	// Header Overlay
	$header_overlay = apply_filters( 'nishiki_pro_header_overlay', get_theme_mod( 'setting_header_overlay', false ) );

	if ( nishiki_pro_is_static_front_page() || is_singular() ) {
		$header_overlay_post = get_post_meta( get_the_ID(), '_nishiki_pro_meta_box_header_overlay_' . get_post_type(), true );

		if ( '' !== $header_overlay_post ) {
			$header_overlay = $header_overlay_post;
		}
	}

	if ( $header_overlay ) {
		// background color
		$header_background_color = esc_html( apply_filters( 'nishiki_pro_header_overlay_background_color', get_theme_mod( 'setting_header_overlay_background_color', '#ffffff' ) ) );
	} else {
		// background color
		$header_background_color = esc_html( apply_filters( 'nishiki_pro_header_background_color', get_theme_mod( 'setting_header_background_color', '#ffffff' ) ) );
	}

	// HEX to RGB
	if ( $header_background_color ) {
		$output .= '
            #masthead{background-color:var(--nishiki-pro-header-background-color-rgba);}
        ';
	}

	/*****************
	 * Main Visual
	 */

	// Text Color
	$top_main_visual_text_color = esc_html( get_theme_mod( 'setting_top_main_visual_text_color', '#ffffff' ) );
	$output                    .= ".main-visual{color:{$top_main_visual_text_color};}";
	$output                    .= ".main-visual-content .sub-text:before{background:{$top_main_visual_text_color};}";

	// Image Placeholder Grayscale
	$main_visual_image_placeholder_grayscale = absint( get_theme_mod( 'setting_top_main_visual_image_placeholder_grayscale', '100' ) );
	$output                                 .= ".main-visual img.img-placeholder{filter:blur(15px) grayscale({$main_visual_image_placeholder_grayscale}%);}";

	// Background Color
	$main_visual_background_color = esc_html( get_theme_mod( 'setting_top_main_visual_background_color', '#222222' ) );
	$output                      .= ".main-visual::after{background-color:{$main_visual_background_color};}";

	// Background Opacity
	$main_visual_background_opacity = absint( get_theme_mod( 'setting_top_main_visual_background_opacity', '30' ) );
	$main_visual_opacity            = $main_visual_background_opacity / 100;
	$output                        .= ".main-visual::after{opacity:{$main_visual_opacity};}";

	// button text color
	$header_main_visual_main_button_text_color = esc_html( get_theme_mod( 'setting_top_main_visual_main_button_text_color', '#ffffff' ) );
	$output                                   .= ".main-visual .main-visual-content a{color:{$header_main_visual_main_button_text_color};}";

	// button color
	$header_main_visual_main_button_color = esc_html( get_theme_mod( 'setting_top_main_visual_main_button_color', '#895892' ) );
	$output                              .= "
		.main-visual .main-visual-content a{background-color:{$header_main_visual_main_button_color};}
		.main-visual .main-visual-content a:hover{color:{$header_main_visual_main_button_color};background-color:{$header_main_visual_main_button_text_color};}";

	/*****************
	 * Post
	 */

	// Title Background Color
	$post_title_background_color = esc_html( get_theme_mod( 'setting_post_title_background_color', '#222222' ) );
	$output                     .= ".single .page-header::after{background-color:{$post_title_background_color};}";

	// Title Background Opacity
	$post_title_background_opacity = absint( get_theme_mod( 'setting_post_title_background_opacity', '90' ) );
	$post_header_opacity           = $post_title_background_opacity / 100;
	$output                       .= ".single .page-header.eye-catch-background::after{opacity:{$post_header_opacity};}";

	// Title Text Color
	$post_title_text_color = esc_html( get_theme_mod( 'setting_post_title_text_color', '#ffffff' ) );
	$output               .= ".single .page-header,.single .page-header a{color:{$post_title_text_color};}";

	// Sidebar Width
	$post_sidebar_width  = absint( apply_filters( 'nishiki_pro_post_sidebar_width', get_theme_mod( 'setting_post_sidebar_width', '300' ) ) );
	$post_column         = esc_html( apply_filters( 'nishiki_pro_post_sidebar_column', get_theme_mod( 'setting_post_column', 'none' ) ) );
	$post_sidebar_margin = $post_sidebar_width + absint( get_theme_mod( 'setting_post_sidebar_margin', '50' ) );

	if ( ! is_page_template( 'templates/sidebar-none.php' ) ) {
		if ( is_page_template( 'templates/sidebar-right.php' ) ) {
			$output .= '@media only screen and (min-width:769px) {';
			$output .= ".post-template-sidebar-right #main .column { padding-right: {$post_sidebar_margin}px;}";
			$output .= ".post-template-sidebar-right aside.sidebar { width:{$post_sidebar_width}px; margin-right:-{$post_sidebar_margin}px;}";
			$output .= '}';
		} elseif ( is_page_template( 'templates/sidebar-left.php' ) ) {
			$output .= '@media only screen and (min-width:769px) {';
			$output .= ".post-template-sidebar-left #main .column { padding-left: {$post_sidebar_margin}px;}";
			$output .= ".post-template-sidebar-left aside.sidebar { width:{$post_sidebar_width}px; margin-left:-{$post_sidebar_margin}px;}";
			$output .= '}';
		} elseif ( is_page_template( 'templates/sidebar-bottom.php' ) || 'bottom' === $post_column ) {
			$output .= '.post-template-sidebar-bottom aside.sidebar {width:100%;}';
			$output .= '.single aside.sidebar { margin:auto }';
		} elseif ( 'none' !== $post_column ) {
			$output .= ".single #main .column { padding-{$post_column}: {$post_sidebar_margin}px;}";
			$output .= '@media only screen and (max-width:768px) {.single #main .column { padding:0;}}';
			$output .= ".single aside.sidebar { width:{$post_sidebar_width}px; margin-{$post_column}:-{$post_sidebar_margin}px;}";
		}
	}

	/*****************
	 * Page
	 */

	// Title Background Color
	$page_title_background_color = esc_html( get_theme_mod( 'setting_page_title_background_color', '#222222' ) );
	$output                     .= ".page .page-header::after{background-color:{$page_title_background_color};}";

	// Title Background Opacity
	$page_title_background_opacity = absint( get_theme_mod( 'setting_page_title_background_opacity', '90' ) );
	$page_header_opacity           = $page_title_background_opacity / 100;
	$output                       .= ".page .page-header.eye-catch-background::after{opacity:{$page_header_opacity};}";

	// Title Text Color
	$page_title_text_color = esc_html( get_theme_mod( 'setting_page_title_text_color', '#ffffff' ) );
	$output               .= ".page .page-header{color:{$page_title_text_color};}";

	// Sidebar Width
	$page_sidebar_width  = absint( get_theme_mod( 'setting_page_sidebar_width', '300' ) );
	$page_column         = esc_html( get_theme_mod( 'setting_page_column', 'none' ) );
	$page_sidebar_margin = $page_sidebar_width + absint( get_theme_mod( 'setting_page_sidebar_margin', '50' ) );

	if ( ! is_page_template( 'templates/sidebar-none.php' ) ) {
		if ( is_page_template( 'templates/sidebar-right.php' ) ) {
			$output .= '@media only screen and (min-width:769px) {';
			$output .= ".page-template-sidebar-right #main .column { padding-right: {$page_sidebar_margin}px;}";
			$output .= ".page-template-sidebar-right aside { width:{$page_sidebar_width}px; margin-right:-{$page_sidebar_margin}px;}";
			$output .= '}';
		} elseif ( is_page_template( 'templates/sidebar-left.php' ) ) {
			$output .= '@media only screen and (min-width:769px) {';
			$output .= ".page-template-sidebar-left #main .column { padding-left: {$page_sidebar_margin}px;}";
			$output .= ".page-template-sidebar-left aside { width:{$page_sidebar_width}px; margin-left:-{$page_sidebar_margin}px;}";
			$output .= '}';
		} elseif ( is_page_template( 'templates/sidebar-bottom.php' ) || 'bottom' === $page_column ) {
			$output .= '.page-template-sidebar-bottom aside {width:100%;}';
			$output .= '.page #main .column { padding:auto; }';
			$output .= '.page aside.sidebar { margin:auto }';
		} elseif ( 'none' !== $page_column ) {
			$output .= '@media only screen and (min-width:769px) {';
			$output .= ".page #main .column { padding-{$page_column}: {$page_sidebar_margin}px;}";
			$output .= ".page aside { width:{$page_sidebar_width}px;margin-{$page_column}:-{$page_sidebar_margin}px;}";
			$output .= '}';
		}
	}

	/*****************
	 * Archive
	 */

	// Archive Contents Width
	$archive_contents_width = absint( get_theme_mod( 'setting_archive_contents_width', '1000' ) );
	$output                .= "
		.archive #main .container.column, .search #main .container.column, .paged #main .container.column, .blog #main .container.column, .error404 #main .container.column{
			max-width:min( calc( 100vw - 12% ),{$archive_contents_width}px );
		}
		";

	// Title Background Color
	$archive_title_background_color = esc_html( get_theme_mod( 'setting_archive_title_background_color', '#222222' ) );
	$output                        .= ".archive header::after,.error404 header::after,.search header::after,.paged header::after,.blog header::after{background-color:{$archive_title_background_color};}";

	// Title Background Opacity
	$archive_title_background_opacity = absint( get_theme_mod( 'setting_archive_title_background_opacity', '90' ) );
	$archive_header_opacity           = $archive_title_background_opacity / 100;
	$output                          .= ".archive .page-header.eye-catch-background::after,.error404 .page-header.eye-catch-background::after,.search .page-header.eye-catch-background::after,.paged .page-header.eye-catch-background::after,.blog .page-header.eye-catch-background::after{opacity:{$archive_header_opacity};}";

	// Title Text Color
	$archive_title_text_color = esc_html( get_theme_mod( 'setting_archive_title_text_color', '#ffffff' ) );
	$output                  .= ".archive .page-header,.error404 .page-header,.search .page-header,.paged .page-header,.blog .page-header{color:{$archive_title_text_color};}";

	// Sidebar Width
	$archive_sidebar_width  = absint( get_theme_mod( 'setting_archive_sidebar_width', '300' ) );
	$archive_column         = esc_html( get_theme_mod( 'setting_archive_column', 'none' ) );
	$archive_sidebar_margin = $archive_sidebar_width + absint( get_theme_mod( 'setting_archive_sidebar_margin', '50' ) );
	if ( 'none' !== $archive_column ) {
		$output .= '@media only screen and (min-width:769px) {';
		$output .= ".archive #main .column, .blog #main .column{ padding-{$archive_column}: {$archive_sidebar_margin}px;}";
		$output .= ".archive aside, .blog aside { width:{$archive_sidebar_width}px;margin-{$archive_column}:-{$archive_sidebar_margin}px;}";
		$output .= '}';
		// $output .= "@media only screen and (max-width:768px) {.archive #main .container.column, .blog #main .container.column {padding:0;}}";
	}

	/*****************
	 * Footer
	 */

	// Footer Contents Width
	$footer_contents_width = absint( get_theme_mod( 'setting_footer_contents_width', '1000' ) );
	$output               .= "
		#footer .container{max-width:min(90%,{$footer_contents_width}px);}
		";

	// Widget Text Color
	$footer_widget_text_color = esc_html( get_theme_mod( 'setting_footer_widget_text_color', '#222222' ) );
	$output                  .= ".footer-widget{
					color:{$footer_widget_text_color};
				}";

	$output .= ".footer-widget thead,
				.footer-widget tr{
					color:{$footer_widget_text_color};
					border-color:{$footer_widget_text_color};
				}";

	// Widget Link Color
	$footer_widget_link_color = esc_html( get_theme_mod( 'setting_footer_widget_link_color', '#0a88cc' ) );
	$output                  .= ".footer-widget a{color:{$footer_widget_link_color};}";

	// Text Color
	$footer_text_color = esc_html( get_theme_mod( 'setting_footer_text_color', '#222222' ) );
	$output           .= "#footer{color:{$footer_text_color};}";

	// Background Color
	$footer_background_color = esc_html( get_theme_mod( 'setting_footer_background_color', '#ffffff' ) );
	$output                 .= "#footer{background:{$footer_background_color};}";

	// Main Button Color
	$footer_main_button_color      = esc_html( get_theme_mod( 'setting_footer_main_button_color', '#222222' ) );
	$footer_main_button_text_color = esc_html( get_theme_mod( 'setting_footer_main_button_text_color', '#ffffff' ) );
	$output                       .= "
		#footer .btn{background-color:{$footer_main_button_color};color:{$footer_main_button_text_color}}
		#footer .btn:hover{background-color:{$footer_main_button_text_color};color:{$footer_main_button_color};}
		";

	// Link Color
	$footer_link_color = esc_html( get_theme_mod( 'setting_footer_link_color', '#0a88cc' ) );
	$output           .= "#footer .copyright a{color:{$footer_link_color};}";

	/*****************
	 * Widget Search Box(legacy)
	 */
	$output .= ".footer-widget .wp-block-search .wp-block-search__button{
					color:{$footer_widget_text_color};
					border-color:{$footer_widget_text_color};
					background: transparent;
					fill:{$footer_widget_text_color};
				}";

	$output .= ".footer-widget .wp-block-search .wp-block-search__button:hover{
					background-color:{$footer_widget_text_color};
				}";
	$output .= ".footer-widget .wp-block-search .wp-block-search__input,
				.footer-widget .wp-block-search div,
				.footer-widget thead,
				.footer-widget tr{
					color:{$footer_widget_text_color};
					border-color:{$footer_widget_text_color};
				}";

	$output .= ".footer-widget .wp-block-search .wp-block-search__input::placeholder{
					color:{$footer_widget_text_color}66;
				}";

	$output .= ".footer-widget .wp-block-search .wp-block-search__button:hover{
					color:{$footer_background_color};
					fill:{$footer_background_color};
				}";

	/*****************
	 * Dark Mode
	 */

	if ( get_theme_mod( 'setting_' . NISHIKI_PRO_PREFIX_DARK_MODE . '_enable' ) ) {
		$dark_mode_background_color    = esc_html( get_theme_mod( 'setting_' . NISHIKI_PRO_PREFIX_DARK_MODE . '_background_color', '#1e1e2b' ) );
		$dark_mode_text_color          = esc_html( get_theme_mod( 'setting_' . NISHIKI_PRO_PREFIX_DARK_MODE . '_text_color', '#999999' ) );
		$dark_mode_accent_color        = esc_html( get_theme_mod( 'setting_' . NISHIKI_PRO_PREFIX_DARK_MODE . '_accent_color', '#96994f' ) );
		$dark_mode_header_footer_color = esc_html( get_theme_mod( 'setting_' . NISHIKI_PRO_PREFIX_DARK_MODE . '_header_footer_color', '#1e1e2b' ) );
		$dark_mode_breadcrumbs_color   = esc_html( get_theme_mod( 'setting_' . NISHIKI_PRO_PREFIX_DARK_MODE . '_breadcrumbs_color', '#292335' ) );
		$dark_mode_social_color        = esc_html( get_theme_mod( 'setting_' . NISHIKI_PRO_PREFIX_DARK_MODE . '_social_color', '#242230' ) );
		$dark_mode_footer_nav_color    = esc_html( get_theme_mod( 'setting_' . NISHIKI_PRO_PREFIX_DARK_MODE . '_footer_nav_color', '#1f1b28' ) );

		$output .= "
		body[data-theme='dark']{
			color: {$dark_mode_text_color};
			background-color: {$dark_mode_background_color};
		}
		body[data-theme='dark'] #masthead .site-info a,
		body[data-theme='dark'] #masthead.sticky .site-info a,
		body[data-theme='dark'] #masthead.sticky-mobile .site-info a,
		body[data-theme='dark'] .articles a,
		body[data-theme='dark'] input,
		body[data-theme='dark'] button[type='submit'],
		body[data-theme='dark'] textarea,
		body[data-theme='dark'] input,
		body[data-theme='dark'] .front-page-section,
		body[data-theme='dark'] #footer,
		body[data-theme='dark'] .footer-widget,
		body[data-theme='dark'] .footer-widget .wp-block-search .wp-block-search__input,
		body[data-theme='dark'] .footer-widget .wp-block-search .wp-block-search__button,
		body[data-theme='dark'] .footer-widget thead,
		body[data-theme='dark'] .footer-widget tr,
		body[data-theme='dark'] #footer-nav a,
		body[data-theme='dark'] #footer-nav span,
		body[data-theme='dark'] #toc-fixed-nav,
		body[data-theme='dark'] #toc-fixed-nav .icon,
		body[data-theme='dark'] #masthead #menu-collapse .close,
		body[data-theme='dark'] #nishiki-toc-fixed #toc-fixed-overlay .nishiki-pro-toc,
		body[data-theme='dark'] #nishiki-toc-fixed #toc-fixed-overlay .nishiki-pro-toc a,
		body[data-theme='dark'] #nishiki-toc-fixed #toc-fixed-overlay button.close,
		body[data-theme='dark'] #nishiki-pro-social-wrapper,
		body[data-theme='dark'] .nishiki-pro-breadcrumbs{
			color: {$dark_mode_text_color};
		}
		
		body[data-theme='dark'] .footer-widget .wp-block-search .wp-block-search__input::placeholder{
			color: {$dark_mode_text_color}66;
		}
		
		body[data-theme='dark'] input,
		body[data-theme='dark'] textarea,
		body[data-theme='dark'] button[type='submit'],
		body[data-theme='dark'] .footer-widget .wp-block-search .wp-block-search__input,
		body[data-theme='dark'] .footer-widget .wp-block-search .wp-block-search__button{
			border-color: {$dark_mode_text_color};
		}
		
		body[data-theme='dark'] input[type=submit]:hover,
		body[data-theme='dark'] button[type='submit']:hover,
		body[data-theme='dark'] .footer-widget .wp-block-search .wp-block-search__button:hover,
		body[data-theme='dark'] .comments-area #respond input[type=submit]:hover{
			color:{$dark_mode_background_color};
			background-color: {$dark_mode_text_color};
		}
		
		body[data-theme='dark'] aside section ul li,
		body[data-theme='dark'] .footer-widget thead,
		body[data-theme='dark'] .footer-widget tr{
			border-color: {$dark_mode_text_color};
		}
		
		body[data-theme='dark'] #nishiki-pro-social-wrapper{
			background-color: {$dark_mode_social_color};
		}
		body[data-theme='dark'] .nishiki-pro-breadcrumbs{
			background-color: {$dark_mode_breadcrumbs_color};
		}
		body[data-theme='dark'] #footer-nav{
			background-color: {$dark_mode_footer_nav_color};
		}
		
		body[data-theme='dark'] a,
		body[data-theme='dark'] #footer .copyright a{
			color: {$dark_mode_accent_color};
		}
		body[data-theme='dark'] a:hover,
		body[data-theme='dark'] .articles a:hover,
		body[data-theme='dark'] #footer .copyright a:hover{
			color:#888;
		}
		
		body[data-theme='dark'] .nishiki-share-button-wrapper a,
		body[data-theme='dark'] #nishiki-pro-toc-content{
			filter: brightness(75%);
		}
		body[data-theme='dark'] .btn,
		body[data-theme='dark'] .tagcloud a{
			filter: brightness(85%);
		}
		body[data-theme='dark'] .wp-block-nishiki-blocks-pro-section{
			color:inherit;
			filter: brightness(95%);
		}

		body[data-theme='dark'] #nishiki-pro-social-wrapper > div a{
			color: {$dark_mode_text_color};
			border-color:{$dark_mode_text_color};
		}
		body[data-theme='dark'] #nishiki-pro-social-wrapper > div a:hover{
			color: {$dark_mode_background_color};
			background-color:{$dark_mode_text_color};
		}
		body[data-theme='dark'] .nishiki-share-button-wrapper a:hover{
			color: #fff;
		}
		body[data-theme='dark'] #search-overlay .wp-block-search .wp-block-search__input{
			border-width:1px;
			border-style:solid;
			border-color:{$dark_mode_text_color};
		}
		body[data-theme='dark'] #search-overlay .wp-block-search .wp-block-search__button{
			border-color:{$dark_mode_text_color};
		}
		body[data-theme='dark'] #search-overlay .wp-block-search .wp-block-search__button:hover{
			color: {$dark_mode_background_color};
			background-color:{$dark_mode_text_color};
		}
		body[data-theme='dark'] .overlay ul li a,
		body[data-theme='dark'] .overlay ul li span,
		body[data-theme='dark'] .overlay .close{
			color: {$dark_mode_text_color};
		}
		
		body[data-theme='dark'] #nishiki-pro-multiple-search .taxonomy label input[type='checkbox'],
		body[data-theme='dark'] #nishiki-pro-multiple-search .relation label input[type='radio']{
			background-color:transparent;
		}
		body[data-theme='dark'] #nishiki-pro-multiple-search .relation label input[type='radio']:checked{
			background-color: #1e8cbe;
		}
		body[data-theme='dark'] textarea,
		body[data-theme='dark'] input{
			background-color:transparent;
		}
		body[data-theme='dark'] #masthead,
		body[data-theme='dark'].scrolled #masthead,
		body[data-theme='dark'] #footer{
			background-color:{$dark_mode_header_footer_color};
		}
		
		body[data-theme='dark'].single header::after{
			background-color: {$dark_mode_background_color};
		}
		body[data-theme='dark'].single .page-header,
		body[data-theme='dark'].single .page-header a {
			color: {$dark_mode_text_color};
		}
		
		body[data-theme='dark'].archive .page-header,
		body[data-theme='dark'].error404 .page-header,
		body[data-theme='dark'].search .page-header,
		body[data-theme='dark'].paged .page-header,
		body[data-theme='dark'].blog .page-header{
			color: {$dark_mode_text_color};
		}
		
		body[data-theme='dark'].archive header::after,
		body[data-theme='dark'].error404 header::after,
		body[data-theme='dark'].search header::after,
		body[data-theme='dark'].paged header::after,
		body[data-theme='dark'].blog header::after{
			background-color: {$dark_mode_background_color};
		}
		
		body[data-theme='dark'] #masthead button.icon,
		body[data-theme='dark'].scrolled #masthead button.icon{
			color: {$dark_mode_text_color};
			border-color: {$dark_mode_text_color};
		}
		
		body[data-theme='dark'] #masthead button.icon:hover,
		body[data-theme='dark'].scrolled #masthead button.icon:hover,
		body[data-theme='dark'] #footer-nav a:hover,
		body[data-theme='dark'] #footer-nav span:hover{
			color: {$dark_mode_background_color};
			background-color:{$dark_mode_text_color};
		}
		
		@media only screen and (min-width: 769px){
			body[data-theme='dark'] #masthead #menu-collapse a,
			body[data-theme='dark'].scrolled #masthead #menu-collapse a{
				color: {$dark_mode_text_color};
			}
			body[data-theme='dark'] #masthead #menu-collapse a:hover,
			body[data-theme='dark'].scrolled #masthead #menu-collapse a:hover{
				color: #888;
				background-color:#222;
			}
			body[data-theme='dark'] #masthead #menu-collapse .sub-menu,
			body[data-theme='dark'].scrolled #masthead #menu-collapse .sub-menu{
				background-color:#222;
			}
		}
		
		@media only screen and (max-width: 768px){
			body[data-theme='dark'] #masthead .global-nav #menu-collapse.panel ul li a,
			body[data-theme='dark'] #masthead .global-nav #menu-collapse.panel ul li span{
				color: {$dark_mode_text_color};
			}
		}
		";
	}

	$output = ':root{' . $root . '}' . $output;

	// Output
	if ( '' === $output ) {
		return false;
	}
	$str    = array( "\t", "\r\n", "\r", "\n" );
	$output = str_replace( $str, '', $output );

	return $output;
}


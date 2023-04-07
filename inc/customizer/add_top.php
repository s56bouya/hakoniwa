<?php
add_action( 'customize_register', 'nishiki_pro_init_customizer_top' );
/**
 * トップページ（カスタマイザー）
 *
 * @param instance $wp_customize インスタンス
 * @return void
 */
function nishiki_pro_init_customizer_top( $wp_customize ) {
	// Panel
	$wp_customize->add_panel(
		'panel_top',
		array(
			'title'    => __( 'Top Page', 'nishiki-pro' ),
			'priority' => 30,
		)
	);

	// Section
	$wp_customize->add_section(
		'section_top_main_visual',
		array(
			'title'    => __( 'Main visual', 'nishiki-pro' ),
			'priority' => 5000,
			'panel'    => 'panel_top',
		)
	);

	// Static Front Page
	$ctrl_static_front_page = $wp_customize->get_section( 'static_front_page' );
	if ( $ctrl_static_front_page ) {
		$ctrl_static_front_page->panel    = 'panel_top';
		$ctrl_static_front_page->priority = 1003;
	}

	// Heading
	$wp_customize->add_setting(
		'setting_top_main_visual_contents_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_top_main_visual_contents_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">全体</p>',
				'section'  => 'section_top_main_visual',
				'settings' => 'setting_top_main_visual_contents_header',
				'priority' => 1000,
			)
		)
	);

	// Main Visual Display
	$wp_customize->add_setting(
		'setting_top_main_visual_display',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_top_main_visual_display',
		array(
			'label'    => __( 'Display Main Visual', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_top_main_visual',
			'settings' => 'setting_top_main_visual_display',
			'priority' => 1000,
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_top_main_visual_image_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_top_main_visual_image_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">画像</p>',
				'section'  => 'section_top_main_visual',
				'settings' => 'setting_top_main_visual_image_header',
				'priority' => 1004,
			)
		)
	);

	// Header Image
	$ctrl_header_image = $wp_customize->get_control( 'header_image' );
	if ( $ctrl_header_image ) {
		$ctrl_header_image->label    = __( 'Upload an Image', 'nishiki-pro' );
		$ctrl_header_image->section  = 'section_top_main_visual';
		$ctrl_header_image->priority = 1005;
	}

	// Heading
	$wp_customize->add_setting(
		'setting_top_main_visual_image_placeholder_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_top_main_visual_image_placeholder_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">プレースホルダー画像</p><p>プレースホルダー画像は、メインビジュアルの画像の読み込みが完了する前に表示する容量の小さい画像のことです。</p>',
				'section'  => 'section_top_main_visual',
				'settings' => 'setting_top_main_visual_image_placeholder_header',
				'priority' => 1006,
			)
		)
	);

	// Main Visual Image Placeholder Display
	$wp_customize->add_setting(
		'setting_top_main_visual_image_placeholder_display',
		array(
			'default'           => false,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_top_main_visual_image_placeholder_display',
		array(
			'label'    => __( 'Display', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_top_main_visual',
			'settings' => 'setting_top_main_visual_image_placeholder_display',
			'priority' => 1010,
		)
	);

	// Main Visual Image Placeholder Grayscale
	$wp_customize->add_setting(
		'setting_top_main_visual_image_placeholder_grayscale',
		array(
			'default'           => 100,
			'transport'         => 'postMessage',
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_top_main_visual_image_placeholder_grayscale',
			array(
				'label'    => __( 'Grayscale(%)', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 100,
				'step'     => 1,
				'section'  => 'section_top_main_visual',
				'settings' => 'setting_top_main_visual_image_placeholder_grayscale',
				'priority' => 1020,
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_top_main_visual_background_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_top_main_visual_background_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">オーバーレイ</p><p>オーバーレイは、メインビジュアルの画像の上に重ねるカラーのことです。</p>',
				'section'  => 'section_top_main_visual',
				'settings' => 'setting_top_main_visual_background_header',
				'priority' => 1030,
			)
		)
	);

	// Main Visual Background Color
	$wp_customize->add_setting(
		'setting_top_main_visual_background_color',
		array(
			'default'           => '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_top_main_visual_background_color',
			array(
				'label'    => __( 'Color', 'nishiki-pro' ),
				'section'  => 'section_top_main_visual',
				'settings' => 'setting_top_main_visual_background_color',
				'priority' => 1030,
			)
		)
	);

	// Main Visual Background Opacity
	$wp_customize->add_setting(
		'setting_top_main_visual_background_opacity',
		array(
			'default'           => 30,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_top_main_visual_background_opacity',
			array(
				'label'    => __( 'Opacity(%)', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 100,
				'step'     => 1,
				'section'  => 'section_top_main_visual',
				'settings' => 'setting_top_main_visual_background_opacity',
				'priority' => 1040,
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_top_main_visual_video_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_top_main_visual_video_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">動画</p><p>トップページを表示している時のみ設定を変更できます。</p>',
				'section'  => 'section_top_main_visual',
				'settings' => 'setting_top_main_visual_video_header',
				'priority' => 1040,
			)
		)
	);

	// Header Video
	$ctrl_header_video = $wp_customize->get_control( 'header_video' );

	if ( $ctrl_header_video ) {
		$ctrl_header_video->label    = __( 'Upload a Video', 'nishiki-pro' );
		$ctrl_header_video->section  = 'section_top_main_visual';
		$ctrl_header_video->priority = 1050;
	}

	// External Header Video
	$ctrl_external_header_video = $wp_customize->get_control( 'external_header_video' );
	if ( $ctrl_external_header_video ) {
		$ctrl_external_header_video->section  = 'section_top_main_visual';
		$ctrl_external_header_video->priority = 1060;
	}

	// Heading
	$wp_customize->add_setting(
		'setting_top_main_visual_blogdescription_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_top_main_visual_blogdescription_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">メインテキスト</p>',
				'section'  => 'section_top_main_visual',
				'settings' => 'setting_top_main_visual_blogdescription_header',
				'priority' => 1060,
			)
		)
	);

	// main text(description)
	$ctrl_blogdescription = $wp_customize->get_control( 'blogdescription' );
	if ( $ctrl_blogdescription ) {
		$ctrl_blogdescription->section     = 'section_top_main_visual';
		$ctrl_blogdescription->description = __( 'Please check Appearance -> Customize -> Site Identity [Display Site Title and Tagline]', 'nishiki-pro' );
		$ctrl_blogdescription->priority    = 1070;
	}

	// Heading
	$wp_customize->add_setting(
		'setting_top_main_visual_sub_text_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_top_main_visual_sub_text_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">サブテキスト</p>',
				'section'  => 'section_top_main_visual',
				'settings' => 'setting_top_main_visual_sub_text_header',
				'priority' => 1080,
			)
		)
	);

	// Sub text
	$wp_customize->add_setting(
		'setting_top_main_visual_sub_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'nishiki_pro_sanitize_textarea',
		)
	);

	$wp_customize->add_control(
		'contrl_top_main_visual_sub_text',
		array(
			'label'    => '',
			'type'     => 'textarea',
			'section'  => 'section_top_main_visual',
			'settings' => 'setting_top_main_visual_sub_text',
			'priority' => 1080,
		)
	);

	// Sub Text align
	$wp_customize->add_setting(
		'setting_top_main_visual_sub_text_align',
		array(
			'default'           => 'center',
			'sanitize_callback' => 'nishiki_pro_sanitize_choices_align',
		)
	);

	$wp_customize->add_control(
		'ctrl_top_main_visual_sub_text_align',
		array(
			'label'    => __( 'Placement', 'nishiki-pro' ),
			'section'  => 'section_top_main_visual',
			'settings' => 'setting_top_main_visual_sub_text_align',
			'type'     => 'select',
			'choices'  => array(
				'left'   => __( 'Left', 'nishiki-pro' ),
				'center' => __( 'Center', 'nishiki-pro' ),
				'right'  => __( 'Right', 'nishiki-pro' ),
			),
			'priority' => 1090,
		)
	);

	// Sub Text Color
	$wp_customize->add_setting(
		'setting_top_main_visual_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_top_main_visual_text_color',
			array(
				'label'     => __( 'Text Color', 'nishiki-pro' ),
				'section'   => 'section_top_main_visual',
				'transport' => 'postMessage',
				'settings'  => 'setting_top_main_visual_text_color',
				'priority'  => 1100,
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_top_main_visual_main_button_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_top_main_visual_main_button_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">ボタン</p>',
				'section'  => 'section_top_main_visual',
				'settings' => 'setting_top_main_visual_main_button_header',
				'priority' => 2001,
			)
		)
	);

	// main button text
	$wp_customize->add_setting(
		'setting_top_main_visual_main_button_text',
		array(
			'default'           => __( 'Get started!', 'nishiki-pro' ),
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'ctrl_top_main_visual_main_button_text',
		array(
			'label'    => __( 'Button Text', 'nishiki-pro' ),
			'type'     => 'text',
			'section'  => 'section_top_main_visual',
			'settings' => 'setting_top_main_visual_main_button_text',
			'priority' => 2001,
		)
	);

	// main button link
	$wp_customize->add_setting(
		'setting_top_main_visual_main_button_link',
		array(
			'default'           => '#',
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'ctrl_top_main_visual_main_button_link',
		array(
			'label'    => __( 'Button link', 'nishiki-pro' ),
			'type'     => 'text',
			'section'  => 'section_top_main_visual',
			'settings' => 'setting_top_main_visual_main_button_link',
			'priority' => 2002,
		)
	);

	// main button link target
	$wp_customize->add_setting(
		'setting_top_main_visual_main_button_link_target',
		array(
			'default'           => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_top_main_visual_main_button_link_target',
		array(
			'label'    => __( 'Open New Tab', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_top_main_visual',
			'settings' => 'setting_top_main_visual_main_button_link_target',
			'priority' => 2003,
		)
	);

	// main button color
	$wp_customize->add_setting(
		'setting_top_main_visual_main_button_color',
		array(
			'default'           => '#895892',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_top_main_visual_main_button_color',
			array(
				'label'    => __( 'Button Color', 'nishiki-pro' ),
				'section'  => 'section_top_main_visual',
				'settings' => 'setting_top_main_visual_main_button_color',
				'priority' => 2004,
			)
		)
	);

	// main button color
	$wp_customize->add_setting(
		'setting_top_main_visual_main_button_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_top_main_visual_main_button_text_color',
			array(
				'label'     => __( 'Button Text Color', 'nishiki-pro' ),
				'section'   => 'section_top_main_visual',
				'transport' => 'postMessage',
				'settings'  => 'setting_top_main_visual_main_button_text_color',
				'priority'  => 2004,
			)
		)
	);

	// recent articles
	$wp_customize->add_section(
		'section_top_recently_article',
		array(
			'title'           => __( 'Recent Articles', 'nishiki-pro' ),
			'description'     => '最新の投稿は、カスタマイザーのホームページ設定を「最新の投稿」に表示している時のみ有効です。',
			'priority'        => 6000,
			'panel'           => 'panel_top',
			'active_callback' => 'is_home',
		)
	);

	$wp_customize->add_setting(
		'setting_top_recently_article_display',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_recently_article_display',
			array(
				'label'    => __( 'Recent Articles', 'nishiki-pro' ),
				'type'     => 'checkbox',
				'section'  => 'section_top_recently_article',
				'settings' => 'setting_top_recently_article_display',
				'priority' => 10,
			)
		)
	);

	// main text
	$wp_customize->add_setting(
		'setting_top_recently_article_main_text',
		array(
			'default'           => __( 'Recent Articles', 'nishiki-pro' ),
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'contrl_top_recently_article_main_text',
		array(
			'label'    => __( 'Main Text', 'nishiki-pro' ),
			'type'     => 'text',
			'section'  => 'section_top_recently_article',
			'settings' => 'setting_top_recently_article_main_text',
		)
	);

	// sub text
	$wp_customize->add_setting(
		'setting_top_recently_article_sub_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'contrl_top_recently_article_sub_text',
		array(
			'label'    => __( 'Sub Text', 'nishiki-pro' ),
			'type'     => 'text',
			'section'  => 'section_top_recently_article',
			'settings' => 'setting_top_recently_article_sub_text',
		)
	);

	// Sticky Post Background Color
	$wp_customize->add_setting(
		'setting_top_recently_article_sticky_background_color',
		array(
			'default'           => '#557c4c',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_top_recently_article_sticky_background_color',
			array(
				'label'    => __( 'Sticky Badge Background Color', 'nishiki-pro' ),
				'section'  => 'section_top_recently_article',
				'settings' => 'setting_top_recently_article_sticky_background_color',
				'priority' => 1030,
			)
		)
	);
}

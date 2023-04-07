<?php
add_action( 'customize_register', 'nishiki_pro_init_customizer_title_tagline' );
/**
 * 全体設定（カスタマイザー）
 *
 * @param instance $wp_customize インスタンス
 * @return void
 */
function nishiki_pro_init_customizer_title_tagline( $wp_customize ) {

	// Heading
	$wp_customize->add_setting(
		'setting_site_size_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_site_size_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">全体</p>',
				'section'  => 'title_tagline',
				'settings' => 'setting_site_size_header',
				'priority' => 1,
			)
		)
	);

	// Contents Width
	$wp_customize->add_setting(
		'setting_site_contents_width',
		array(
			'default'           => 1000,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_site_contents_width',
			array(
				'label'    => __( 'Contents Width(px)', 'nishiki-pro' ),
				'min'      => 500,
				'max'      => 3000,
				'step'     => 1,
				'section'  => 'title_tagline',
				'settings' => 'setting_site_contents_width',
				'priority' => 1,
			)
		)
	);

	// Font Size
	$wp_customize->add_setting(
		'setting_site_font_size',
		array(
			'default'           => 16,
			'transport'         => '',
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_site_font_size',
			array(
				'label'    => __( 'Font Size(px)', 'nishiki-pro' ),
				'min'      => 12,
				'max'      => 30,
				'step'     => 1,
				'section'  => 'title_tagline',
				'settings' => 'setting_site_font_size',
				'priority' => 1,
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_site_logo_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_site_logo_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">ロゴ</p>',
				'section'  => 'title_tagline',
				'settings' => 'setting_site_logo_header',
				'priority' => 2,
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_site_header_text_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_site_header_text_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">タイトル</p>',
				'section'  => 'title_tagline',
				'settings' => 'setting_site_header_text_header',
				'priority' => 9,
			)
		)
	);

	// Display Site Title and Tagline
	$ctrl_display_header_text = $wp_customize->get_control( 'display_header_text' );
	if ( $ctrl_display_header_text ) {
		$ctrl_display_header_text->description = __( 'When setting a logo, the logo takes precedence over the site title text.', 'nishiki-pro' );
	}

	// Heading
	$wp_customize->add_setting(
		'setting_site_icon_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_site_icon_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">アイコン</p>',
				'section'  => 'title_tagline',
				'settings' => 'setting_site_icon_header',
				'priority' => 50,
			)
		)
	);

	// Base Color Heading
	$wp_customize->add_setting(
		'setting_site_base_color_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_site_base_color_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">ベースカラー</p>',
				'section'  => 'title_tagline',
				'settings' => 'setting_site_base_color_header',
				'priority' => 1500,
			)
		)
	);

	// Base Color
	$wp_customize->add_setting(
		'setting_site_background_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_site_background_color',
			array(
				'label'    => __( 'Background Color', 'nishiki-pro' ),
				'section'  => 'title_tagline',
				'settings' => 'setting_site_background_color',
				'priority' => 1510,
			)
		)
	);

	// Background image
	$section_background_image = $wp_customize->get_section( 'background_image' );
	if ( $section_background_image ) {
		$section_background_image->priority = 1520;
	}

	// Main Color Heading
	$wp_customize->add_setting(
		'setting_site_main_color_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_site_main_color_header',
			array(
				'label'       => '<p class="nishiki-pro-customizer-heading">メインカラー</p>',
				'description' => 'サイト全体を印象付けるカラーを設定してください。このカラーに対応した Gutenberg のブロックスタイルもあります。',
				'section'     => 'title_tagline',
				'settings'    => 'setting_site_main_color_header',
				'priority'    => 1600,
			)
		)
	);

	// Main Color 01
	$wp_customize->add_setting(
		'setting_site_main_color_01',
		array(
			'default'           => '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_site_main_color_01',
			array(
				'label'    => __( 'Color 01', 'nishiki-pro' ),
				'section'  => 'title_tagline',
				'settings' => 'setting_site_main_color_01',
				'priority' => 1610,
			)
		)
	);

	// Main Color 02
	$wp_customize->add_setting(
		'setting_site_main_color_02',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_site_main_color_02',
			array(
				'label'     => __( 'Color 02', 'nishiki-pro' ),
				'section'   => 'title_tagline',
				'transport' => 'postMessage',
				'settings'  => 'setting_site_main_color_02',
				'priority'  => 1620,
			)
		)
	);

	// Accent Color Heading
	$wp_customize->add_setting(
		'setting_site_accent_color_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_site_accent_color_header',
			array(
				'label'       => '<p class="nishiki-pro-customizer-heading">アクセントカラー</p>',
				'description' => 'サイト全体を引き締めるカラーを設定してください。このカラーに対応した Gutenberg のブロックスタイルもあります。',
				'section'     => 'title_tagline',
				'settings'    => 'setting_site_accent_color_header',
				'priority'    => 1700,
			)
		)
	);

	// Accent Color 01
	$wp_customize->add_setting(
		'setting_site_accent_color_01',
		array(
			'default'           => '#8d728f',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_site_accent_color_01',
			array(
				'label'    => __( 'Color 01', 'nishiki-pro' ),
				'section'  => 'title_tagline',
				'settings' => 'setting_site_accent_color_01',
				'priority' => 1710,
			)
		)
	);

	// Accent Color 02
	$wp_customize->add_setting(
		'setting_site_accent_color_02',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_site_accent_color_02',
			array(
				'label'     => __( 'Color 02', 'nishiki-pro' ),
				'section'   => 'title_tagline',
				'transport' => 'postMessage',
				'settings'  => 'setting_site_accent_color_02',
				'priority'  => 1720,
			)
		)
	);

	// Text Color Heading
	$wp_customize->add_setting(
		'setting_site_text_color_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_site_text_color_header',
			array(
				'label'       => '<p class="nishiki-pro-customizer-heading">テキストカラー</p>',
				'description' => '本文/サイドバーのテキストカラーを設定してください。',
				'section'     => 'title_tagline',
				'settings'    => 'setting_site_text_color_header',
				'priority'    => 1800,
			)
		)
	);

	// Text Color 01
	$wp_customize->add_setting(
		'setting_site_main_text_color',
		array(
			'default'           => '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_site_main_text_color',
			array(
				'label'    => __( 'Color 01', 'nishiki-pro' ),
				'section'  => 'title_tagline',
				'settings' => 'setting_site_main_text_color',
				'priority' => 1810,
			)
		)
	);

	// Text Color 02
	$wp_customize->add_setting(
		'setting_site_sub_text_color',
		array(
			'default'           => '#aaaaaa',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_site_sub_text_color',
			array(
				'label'     => __( 'Color 02', 'nishiki-pro' ),
				'section'   => 'title_tagline',
				'transport' => 'postMessage',
				'settings'  => 'setting_site_sub_text_color',
				'priority'  => 1820,
			)
		)
	);

	// Link Color Heading
	$wp_customize->add_setting(
		'setting_site_link_color_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_site_link_color_header',
			array(
				'label'       => '<p class="nishiki-pro-customizer-heading">リンクカラー</p>',
				'description' => '本文/サイドバーのリンクカラーを設定してください。',
				'section'     => 'title_tagline',
				'settings'    => 'setting_site_link_color_header',
				'priority'    => 1900,
			)
		)
	);

	// Link Color 01
	$wp_customize->add_setting(
		'setting_site_main_color',
		array(
			'default'           => '#0a88cc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_site_main_color',
			array(
				'label'    => __( 'Color 01', 'nishiki-pro' ),
				'section'  => 'title_tagline',
				'settings' => 'setting_site_main_color',
				'priority' => 1910,
			)
		)
	);

	// Link Color 02
	$wp_customize->add_setting(
		'setting_site_sub_color',
		array(
			'default'           => '#0044a3',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_site_sub_color',
			array(
				'label'     => __( 'Color 02', 'nishiki-pro' ),
				'section'   => 'title_tagline',
				'transport' => 'postMessage',
				'settings'  => 'setting_site_sub_color',
				'priority'  => 1920,
			)
		)
	);
}

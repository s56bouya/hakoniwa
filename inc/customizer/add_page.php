<?php
add_action( 'customize_register', 'nishiki_pro_init_customizer_page' );
/**
 * 固定ページ（カスタマイザー）
 *
 * @param instance $wp_customize インスタンス
 * @return void
 */
function nishiki_pro_init_customizer_page( $wp_customize ) {
	// Section
	$wp_customize->add_section(
		'section_page',
		array(
			'title'    => __( 'Pages', 'nishiki-pro' ),
			'priority' => 50,
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_page_sidebar_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_page_sidebar_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">サイドバー</p>',
				'section'  => 'section_page',
				'settings' => 'setting_page_sidebar_header',
			)
		)
	);

	// Column
	$wp_customize->add_setting(
		'setting_page_column',
		array(
			'default'           => 'none',
			'sanitize_callback' => 'nishiki_pro_sanitize_choices',
		)
	);

	$wp_customize->add_control(
		'ctrl_page_column',
		array(
			'label'    => __( 'Placement', 'nishiki-pro' ),
			'section'  => 'section_page',
			'settings' => 'setting_page_column',
			'type'     => 'select',
			'choices'  => array(
				'left'   => __( 'Left', 'nishiki-pro' ),
				'right'  => __( 'Right', 'nishiki-pro' ),
				'bottom' => __( 'Bottom', 'nishiki-pro' ),
				'none'   => __( 'None', 'nishiki-pro' ),
			),
		)
	);

	// Sidebar Width
	$wp_customize->add_setting(
		'setting_page_sidebar_width',
		array(
			'default'           => 300,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_page_sidebar_width',
			array(
				'label'    => __( 'Width(px)', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 1000,
				'step'     => 10,
				'section'  => 'section_page',
				'settings' => 'setting_page_sidebar_width',
			)
		)
	);

	// Sidebar Margin
	$wp_customize->add_setting(
		'setting_page_sidebar_margin',
		array(
			'default'           => 50,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_page_sidebar_margin',
			array(
				'label'    => __( 'Margin(px)', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 50,
				'step'     => 1,
				'section'  => 'section_page',
				'settings' => 'setting_page_sidebar_margin',
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_page_title_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_page_title_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">ページタイトル</p>',
				'section'  => 'section_page',
				'settings' => 'setting_page_title_header',
			)
		)
	);

	// Title Text Color
	$wp_customize->add_setting(
		'setting_page_title_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_page_text_color',
			array(
				'label'     => __( 'Text Color', 'nishiki-pro' ),
				'section'   => 'section_page',
				'transport' => 'postMessage',
				'settings'  => 'setting_page_title_text_color',
			)
		)
	);

	// Title Background Color
	$wp_customize->add_setting(
		'setting_page_title_background_color',
		array(
			'default'           => '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_setting_page_title_background_color',
			array(
				'label'    => __( 'Background Color', 'nishiki-pro' ),
				'section'  => 'section_page',
				'settings' => 'setting_page_title_background_color',
			)
		)
	);

	// Title Background Opacity
	$wp_customize->add_setting(
		'setting_page_title_background_opacity',
		array(
			'default'           => 100,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_page_title_background_opacity',
			array(
				'label'    => __( 'Background Opacity(%)', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 100,
				'step'     => 1,
				'section'  => 'section_page',
				'settings' => 'setting_page_title_background_opacity',
			)
		)
	);

	// Display Eye Catch
	$wp_customize->add_setting(
		'setting_page_eye_catch',
		array(
			'default'           => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_page_eye_catch',
		array(
			'label'    => __( 'Display Eye Catch', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_page',
			'settings' => 'setting_page_eye_catch',
		)
	);

	// Eye Catch Layout
	$wp_customize->add_setting(
		'setting_page_eye_catch_layout',
		array(
			'default'           => 'background',
			'sanitize_callback' => 'nishiki_pro_sanitize_radio',
		)
	);

	$wp_customize->add_control(
		'ctrl_page_eye_catch_layout',
		array(
			'label'    => __( 'Eye Catch Layout', 'nishiki-pro' ),
			'type'     => 'radio',
			'section'  => 'section_page',
			'settings' => 'setting_page_eye_catch_layout',
			'choices'  => array(
				'background'   => __( 'Title Background', 'nishiki-pro' ),
				'top'          => __( 'Title Top', 'nishiki-pro' ),
				'bottom'       => __( 'Title Bottom', 'nishiki-pro' ),
				'content'      => __( 'Content Top', 'nishiki-pro' ),
				'content-wide' => __( 'Content Top(wide)', 'nishiki-pro' ),
			),
		)
	);

}

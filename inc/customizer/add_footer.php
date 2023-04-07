<?php
add_action( 'customize_register', 'nishiki_pro_init_customizer_footer' );
/**
 * フッター（カスタマイザー）
 *
 * @param instance $wp_customize インスタンス
 * @return void
 */
function nishiki_pro_init_customizer_footer( $wp_customize ) {
	// Section
	$wp_customize->add_section(
		'section_footer',
		array(
			'title'    => __( 'Footer', 'nishiki-pro' ),
			'priority' => 80,
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_footer_contents_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_footer_contents_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">全体</p>',
				'section'  => 'section_footer',
				'settings' => 'setting_footer_contents_header',
			)
		)
	);

	// Footer Contents Width
	$wp_customize->add_setting(
		'setting_footer_contents_width',
		array(
			'default'           => 1000,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_footer_contents_width',
			array(
				'label'    => __( 'Contents Width(px)', 'nishiki-pro' ),
				'min'      => 500,
				'max'      => 9000,
				'step'     => 1,
				'section'  => 'section_footer',
				'settings' => 'setting_footer_contents_width',
			)
		)
	);

	// background color
	$wp_customize->add_setting(
		'setting_footer_background_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_footer_background_color',
			array(
				'label'     => __( 'Background Color', 'nishiki-pro' ),
				'section'   => 'section_footer',
				'transport' => 'postMessage',
				'settings'  => 'setting_footer_background_color',
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_footer_widget_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_footer_widget_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">ウィジェット</p>',
				'section'  => 'section_footer',
				'settings' => 'setting_footer_widget_header',
			)
		)
	);

	// Widget Columns
	$wp_customize->add_setting(
		'setting_footer_widget_columns',
		array(
			'default'           => 3,
			'sanitize_callback' => 'nishiki_pro_sanitize_choices_columns',
		)
	);

	$wp_customize->add_control(
		'ctrl_footer_widget_columns',
		array(
			'label'    => __( 'Columns', 'nishiki-pro' ),
			'section'  => 'section_footer',
			'settings' => 'setting_footer_widget_columns',
			'type'     => 'select',
			'choices'  => array(
				'1' => __( '1 Column', 'nishiki-pro' ),
				'2' => __( '2 Columns', 'nishiki-pro' ),
				'3' => __( '3 Columns', 'nishiki-pro' ),
			),
		)
	);

	// Widget Text color
	$wp_customize->add_setting(
		'setting_footer_widget_text_color',
		array(
			'default'           => '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_footer_widget_text_color',
			array(
				'label'    => __( 'Text Color', 'nishiki-pro' ),
				'section'  => 'section_footer',
				'settings' => 'setting_footer_widget_text_color',
			)
		)
	);

	// Widget Link color
	$wp_customize->add_setting(
		'setting_footer_widget_link_color',
		array(
			'default'           => '#0a88cc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_footer_widget_link_color',
			array(
				'label'     => __( 'Link Color', 'nishiki-pro' ),
				'section'   => 'section_footer',
				'transport' => 'postMessage',
				'settings'  => 'setting_footer_widget_link_color',
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_footer_contents_header_main_text',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_footer_contents_header_main_text',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">テキスト</p>',
				'section'  => 'section_footer',
				'settings' => 'setting_footer_contents_header_main_text',
			)
		)
	);

	// Main Text
	$wp_customize->add_setting(
		'setting_footer_main_text',
		array(
			'default'           => __( 'Main Text', 'nishiki-pro' ),
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'ctrl_footer_main_text',
		array(
			'label'    => '',
			'type'     => 'text',
			'section'  => 'section_footer',
			'settings' => 'setting_footer_main_text',
		)
	);

	// Text color
	$wp_customize->add_setting(
		'setting_footer_text_color',
		array(
			'default'           => '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_footer_text_color',
			array(
				'label'    => __( 'Text Color', 'nishiki-pro' ),
				'section'  => 'section_footer',
				'settings' => 'setting_footer_text_color',
			)
		)
	);

	// Link color
	$wp_customize->add_setting(
		'setting_footer_link_color',
		array(
			'default'           => '#0a88cc',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_footer_link_color',
			array(
				'label'     => __( 'Link Color', 'nishiki-pro' ),
				'section'   => 'section_footer',
				'transport' => 'postMessage',
				'settings'  => 'setting_footer_link_color',
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_footer_contents_header_main_button_text',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_footer_contents_header_main_button_text',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">ボタン</p>',
				'section'  => 'section_footer',
				'settings' => 'setting_footer_contents_header_main_button_text',
			)
		)
	);

	// Main Button Text
	$wp_customize->add_setting(
		'setting_footer_main_button_text',
		array(
			'default'           => __( 'Button Text', 'nishiki-pro' ),
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'ctrl_footer_main_button_text',
		array(
			'label'    => '',
			'type'     => 'text',
			'section'  => 'section_footer',
			'settings' => 'setting_footer_main_button_text',
		)
	);

	// Main Button Link
	$wp_customize->add_setting(
		'setting_footer_main_button_link',
		array(
			'default'           => '#',
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'ctrl_footer_main_button_link',
		array(
			'label'    => __( 'Button link', 'nishiki-pro' ),
			'type'     => 'text',
			'section'  => 'section_footer',
			'settings' => 'setting_footer_main_button_link',
		)
	);

	// Main Button Link Target
	$wp_customize->add_setting(
		'setting_footer_main_button_link_target',
		array(
			'default'           => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_footer_main_button_link_target',
		array(
			'label'    => __( 'Open New Tab', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_footer',
			'settings' => 'setting_footer_main_button_link_target',
		)
	);

	// Main Button Color
	$wp_customize->add_setting(
		'setting_footer_main_button_color',
		array(
			'default'           => '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_footer_main_button_color',
			array(
				'label'    => __( 'Button Color', 'nishiki-pro' ),
				'section'  => 'section_footer',
				'settings' => 'setting_footer_main_button_color',
			)
		)
	);

	// main button color（Hover）
	$wp_customize->add_setting(
		'setting_footer_main_button_text_color',
		array(
			'default'           => '#f5f5f5',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_footer_main_button_text_color',
			array(
				'label'     => __( 'Button Text Color', 'nishiki-pro' ),
				'transport' => 'postMessage',
				'section'   => 'section_footer',
				'settings'  => 'setting_footer_main_button_text_color',
			)
		)
	);

	// copyright
	$wp_customize->add_setting(
		'setting_footer_copyright',
		array(
			'default'           => NISHIKI_PRO_CREDIT,
			'sanitize_callback' => 'nishiki_pro_sanitize_textarea',
		)
	);

	$wp_customize->add_control(
		'ctrl_footer_copyright',
		array(
			'label'    => __( 'Copyright', 'nishiki-pro' ),
			'type'     => 'textarea',
			'section'  => 'section_footer',
			'settings' => 'setting_footer_copyright',
		)
	);
}

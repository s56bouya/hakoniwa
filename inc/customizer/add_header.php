<?php
add_action( 'customize_register', 'nishiki_pro_init_customizer_header' );
/**
 * ヘッダー（カスタマイザー）
 *
 * @param instance $wp_customize インスタンス
 * @return void
 */
function nishiki_pro_init_customizer_header( $wp_customize ) {
	// Section
	$wp_customize->add_section(
		'section_header',
		array(
			'title'    => __( 'Header', 'nishiki-pro' ),
			'priority' => 70,
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_header_contents_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_header_contents_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">全体</p>',
				'section'  => 'section_header',
				'settings' => 'setting_header_contents_header',
				'priority' => 100,
			)
		)
	);

	// Header Contents Width
	$wp_customize->add_setting(
		'setting_header_contents_width',
		array(
			'default'           => 1000,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_header_contents_width',
			array(
				'label'    => __( 'Contents Width(px)', 'nishiki-pro' ),
				'min'      => 500,
				'max'      => 9000,
				'step'     => 1,
				'section'  => 'section_header',
				'settings' => 'setting_header_contents_width',
				'priority' => 100,
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_header_layout_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_header_layout_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">レイアウト</p>',
				'section'  => 'section_header',
				'settings' => 'setting_header_layout_header',
				'priority' => 100,
			)
		)
	);

	// Header Layout
	$wp_customize->add_setting(
		'setting_header_layout',
		array(
			'default'           => 'default',
			'sanitize_callback' => 'nishiki_pro_sanitize_choices_header_layout',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Image_Radio_Control(
			$wp_customize,
			'ctrl_header_layout',
			array(
				'label'    => '',
				'section'  => 'section_header',
				'settings' => 'setting_header_layout',
				'type'     => 'select',
				'choices'  => array(
					'default' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQgAAADUCAYAAABgfb0fAAAACXBIWXMAAAsSAAALEgHS3X78AAADmUlEQVR4nO3dQWojVxRAUTtqVCCohWSUeWZZZs97C72FnmeUhQgEVSAUMo6vR3rVtDhnASr8MJf6+Ov5/dvX7483gA/8ZihAEQggCQSQBAJIAgEkgQCSQABJIIAkEED6MjGav3/888tO/I8/f/+pz/+VZ8fPNfG76w0CSAIBJIEAkkAASSCAJBBAEgggCQSQBAJIAgEkgQCSQABJIIAkEEASCCAJBJAEAkgCASSBAJJAAEkggCQQQBIIIL1/+/r9YTzAR7xBAEkggCQQQBIIIAkEkAQCSAIBJIEAkkAA6f3xeLhJCXzIGwSQBAJIAgEkgQCSQABJIIAkEEASCCAJBJAEAkgCASSBANKXidFs22bicLBlWZ7+wJFA7Ps+8bHAJyYC4YgBJIEAkkAASSCAJBBAEgggCQSQRu5BnE4nE4cXYO09kBwxgCQQQBIIIAkEkAQCSCN/5rzf7yYOB5u4XjASiNvtNvGxwCfWdX36eBwxgCQQQBIIIAkEkAQCSAIBJIEAkkAAyT4IIHmDAJJAAEkggCQQQBIIIAkEkOyDgBdxuVye/oPYKAUkRwwgCQSQBAJIAgEkgQCSQABJIIA0cg/ifD6bOLwAC2OA5IgBJIEAkkAASSCAJBBAGvkz57ZtJg4HW5bl6Q8cCcS+7xMfC3xiIhCOGEASCCAJBJAEAkgCASSBAJJAAGnkHsTpdDJxeAH2QQDJEQNIAgEkgQCSQABJIIAkEEAauQdxvV5NHA62ruvTH+gNAkgCASSBAJJAAEkggCQQQBIIIAkEkEb2QdzvdxOHg00sarIwBkiOGEASCCAJBJAEAkgCAaSRfRC3283E4WCXy+XpDxwJhHsQ8BocMYAkEEASCCAJBJAEAkgCASSBANLIPYjz+Wzi8ALsgwCSIwaQBAJIAgEkgQCSQADJ173hRUysvbcwBl7Euq5P/0EcMYAkEEASCCAJBJAEAkgCASSBAJJAAMk+CCB5gwCSQABJIIAkEEASCCAJBJBG9kFcr1cTh4PZBwEcSiCAJBBAEgggCQSQBAJIAgEkgQDSyD4I/1kLjjfxn7UsjAGSIwaQBAJIAgEkgQCSQABpZB/Etm0mDgdbluXpDxwJxL7vEx8LfGIiEI4YQBIIIAkEkAQCSAIBJIEAkkAAaeQexMT30oHj2QcBJEcMIAkEkAQCSAIBJIEAkkAASSCAJBBAEgggCQSQBAJIAgGk/77N+ZfxAP/z9vb2L52ydARIjUNAAAAAAElFTkSuQmCC
',
					'center'  => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQgAAADUCAYAAABgfb0fAAAACXBIWXMAAAsSAAALEgHS3X78AAADlklEQVR4nO3dwWpaQRiAUVOLguAuJd3kYfqY3fcV+kRuEpKdICiIJevmC6U4l6jnPIDXzOLjDhn/ufv18/dpBvCOLxYFKAIBJIEAkkAASSCAJBBAEgggCQSQvlqay/K0eZk9b14v8rs/PN7Pvj9++wTfhH/lDQJIAgEkgQCSQABJIIAkEEASCCAJBJAEAkgCASSBAJJAAEkggCQQQBIIIAkEkAQCSAIBJIEAkkAASSCAJBBAEggguRfjwrzdK+FuCabiDQJIAgEkgQCSQABJIIAkEEASCCAJBJAEAkg3d5LyafMye968foJvwqV5eLy/uVOs3iCAJBBAEgggCQSQBAJIAgEkgQCSQABJIIAkEEASCCAJBJAEAkgCASSBAJJAAEkggCQQQBIIIAkEkAQCSAIBJIEA0s3di/F2r8Gt3W0A/8sbBJAEAkgCASSBAJJAAEkggCQQQBIIIAkEkO5Op9PJ8gDv8QYBJIEAkkAASSCAJBBAEgggCQSQBAJIAgEkgQCSQABJIIA0ZOz9brez4jCx1Wp19gcOCcTxeBzxscDEbDGAJBBAEgggCQSQBAJIAgEkgQDSkHMQi8XCisMVMPYeSLYYQBIIIAkEkAQCSAIBpCH/5tzv91YcJrZcLs/+wCGBOBwOIz4W+MCIQNhiAEkggCQQQBIIIAkEkAQCSAIBpCHnIObzuRWHK2AeBJBsMYAkEEASCCAJBJAEAkgCAaQh5yC2260Vh4mt1+uzP9AbBJAEAkgCASSBAJJAAEkggCQQQBIIIA2ZB3E8Hq04TGzEoCYDY4BkiwEkgQCSQABJIIAkEEAaMg9it9tZcZjYarU6+wOHBMI5CLgOthhAEgggCQSQBAJIAgEkgQCSQABpyDmIxWJhxeEKmAcBJFsMIAkEkAQCSAIBJIEAkp97w5UYMfbewBi4Euv1+ux/iC0GkAQCSAIBJIEAkkAASSCAJBBAEgggmQcBJG8QQBIIIAkEkAQCSAIBJIEA0pB5ENvt1orDxMyDACYlEEASCCAJBJAEAkgCASSBAJJAAGnIPAg3a8H0RtysZWAMkGwxgCQQQBIIIAkEkAQCSEPmQez3eysOE1sul2d/4JBAHA6HER8LfGBEIGwxgCQQQBIIIAkEkAQCSAIBJIEA0pBzECN+lw5MzzwIINliAEkggCQQQBIIIAkEkAQCSAIBJIEAkkAASSCAJBBAEgggvf2a84flAf4ym83+AIhpZC2xSqgSAAAAAElFTkSuQmCC
',
				),
				'priority' => 100,
			)
		)
	);

	// Header Fixed
	$wp_customize->add_setting(
		'setting_header_fixed',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_header_fixed',
		array(
			'label'    => __( 'Fixed Header', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_header',
			'settings' => 'setting_header_fixed',
			'priority' => 100,
		)
	);

	// Header Fixed（mobile only）
	$wp_customize->add_setting(
		'setting_header_fixed_mobile',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_header_fixed_mobile',
		array(
			'label'    => __( 'Fixed Header Mobile', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_header',
			'settings' => 'setting_header_fixed_mobile',
			'priority' => 100,
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_header_color_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_header_color_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">カラー</p>',
				'section'  => 'section_header',
				'settings' => 'setting_header_color_header',
				'priority' => 100,
			)
		)
	);

	// Text Color
	$ctrl_header_textcolor = $wp_customize->get_control( 'header_textcolor' );
	if ( $ctrl_header_textcolor ) {
		$ctrl_header_textcolor->section  = 'section_header';
		$ctrl_header_textcolor->label    = __( 'Text Color', 'nishiki-pro' );
		$ctrl_header_textcolor->priority = '200';
	}

	// Background Color
	$wp_customize->add_setting(
		'setting_header_background_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_header_background_color',
			array(
				'label'    => __( 'Background Color', 'nishiki-pro' ),
				'section'  => 'section_header',
				'settings' => 'setting_header_background_color',
				'priority' => 200,
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_header_display_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_header_display_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">表示</p>',
				'section'  => 'section_header',
				'settings' => 'setting_header_display_header',
				'priority' => 200,
			)
		)
	);

	// Display Search Button
	$wp_customize->add_setting(
		'setting_header_search_button',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_header_search_button',
		array(
			'label'    => __( 'Display Search Button', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_header',
			'settings' => 'setting_header_search_button',
			'priority' => 200,
		)
	);

	// Header Menu Collapse
	$wp_customize->add_setting(
		'setting_header_menu_collapse',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_header_menu_collapse',
		array(
			'label'    => __( 'Header Menu Panel + Text', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_header',
			'settings' => 'setting_header_menu_collapse',
			'priority' => 200,
		)
	);

	// Header Drawer Menu Width
	$wp_customize->add_setting(
		'setting_header_drawer_menu_width',
		array(
			'default'           => 768,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_header_drawer_menu_width',
			array(
				'label'       => __( 'Drawer Menu Width(px)', 'nishiki-pro' ),
				'description' => '320 - 1280 の範囲で設定してください。',
				'min'         => 320,
				'max'         => 1280,
				'step'        => 1,
				'section'     => 'section_header',
				'settings'    => 'setting_header_drawer_menu_width',
				'priority'    => 200,
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_header_overlay_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_header_overlay_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">オーバーレイ</p>',
				'section'  => 'section_header',
				'settings' => 'setting_header_overlay_header',
				'priority' => 200,
			)
		)
	);

	// Header Overlay
	$wp_customize->add_setting(
		'setting_header_overlay',
		array(
			'default'           => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_header_overlay',
		array(
			'label'       => __( 'Header Overlay', 'nishiki-pro' ),
			'description' => '有効にした場合、オーバーレイのテキストカラー/背景カラーが優先されます。',
			'type'        => 'checkbox',
			'section'     => 'section_header',
			'settings'    => 'setting_header_overlay',
			'priority'    => 200,
		)
	);

	// Header Overlay Text Color
	$wp_customize->add_setting(
		'setting_header_overlay_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_header_overlay_text_color',
			array(
				'label'    => __( 'Text Color', 'nishiki-pro' ),
				'section'  => 'section_header',
				'settings' => 'setting_header_overlay_text_color',
				'priority' => 200,
			)
		)
	);

	// Header Overlay Background Color
	$wp_customize->add_setting(
		'setting_header_overlay_background_color',
		array(
			'default'           => '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_header_overlay_background_color',
			array(
				'label'    => __( 'Background Color', 'nishiki-pro' ),
				'section'  => 'section_header',
				'settings' => 'setting_header_overlay_background_color',
				'priority' => 200,
			)
		)
	);

	// Header Overlay Background Opacity
	$wp_customize->add_setting(
		'setting_header_overlay_background_color_opacity',
		array(
			'default'           => 30,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_header_overlay_background_color_opacity',
			array(
				'label'    => __( 'Background Opacity(%)', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 100,
				'step'     => 1,
				'section'  => 'section_header',
				'settings' => 'setting_header_overlay_background_color_opacity',
				'priority' => 200,
			)
		)
	);
}

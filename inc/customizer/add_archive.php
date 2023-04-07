<?php
add_action( 'customize_register', 'nishiki_pro_init_customizer_archive' );
/**
 * アーカイブページ（カスタマイザー）
 *
 * @param instance $wp_customize インスタンス
 * @return void
 */
function nishiki_pro_init_customizer_archive( $wp_customize ) {
	// Section
	$wp_customize->add_section(
		'section_archive',
		array(
			'title'    => __( 'Archive Pages', 'nishiki-pro' ),
			'priority' => 60,
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_archive_contents_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_archive_contents_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">全体</p>',
				'section'  => 'section_archive',
				'settings' => 'setting_archive_contents_header',
			)
		)
	);

	// Archive Contents Width
	$wp_customize->add_setting(
		'setting_archive_contents_width',
		array(
			'default'           => 1000,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_archive_contents_width',
			array(
				'label'    => __( 'Contents Width(px)', 'nishiki-pro' ),
				'min'      => 500,
				'max'      => 9000,
				'step'     => 1,
				'section'  => 'section_archive',
				'settings' => 'setting_archive_contents_width',
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_archive_layout_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_archive_layout_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">レイアウト</p>',
				'section'  => 'section_archive',
				'settings' => 'setting_archive_layout_header',
			)
		)
	);

	// Layout
	$wp_customize->add_setting(
		'setting_archive_article_layout',
		array(
			'default'           => '',
			'sanitize_callback' => 'nishiki_pro_sanitize_radio',
		)
	);

	$wp_customize->add_control(
		'ctrl_archive_article_layout',
		array(
			'label'    => __( 'Layout', 'nishiki-pro' ),
			'type'     => 'radio',
			'section'  => 'section_archive',
			'settings' => 'setting_archive_article_layout',
			'choices'  => array(
				''     => __( 'Card(Default)', 'nishiki-pro' ),
				'list' => __( 'List', 'nishiki-pro' ),
			),
		)
	);

	// Article Columns
	$wp_customize->add_setting(
		'setting_archive_article_columns',
		array(
			'default'           => 3,
			'sanitize_callback' => 'nishiki_pro_sanitize_choices_columns',
		)
	);

	$wp_customize->add_control(
		'ctrl_archive_article_columns',
		array(
			'label'    => __( 'Columns', 'nishiki-pro' ),
			'section'  => 'section_archive',
			'settings' => 'setting_archive_article_columns',
			'type'     => 'select',
			'choices'  => array(
				'1' => __( '1 Column', 'nishiki-pro' ),
				'2' => __( '2 Columns', 'nishiki-pro' ),
				'3' => __( '3 Columns', 'nishiki-pro' ),
			),
		)
	);

	// Excerpt Text
	$wp_customize->add_setting(
		'setting_archive_excerpt_text',
		array(
			'default'           => '...',
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'ctrl_archive_excerpt_text',
		array(
			'label'    => __( 'Excerpt Text', 'nishiki-pro' ),
			'type'     => 'text',
			'section'  => 'section_archive',
			'settings' => 'setting_archive_excerpt_text',
		)
	);

	// Excerpt Text Num
	$wp_customize->add_setting(
		'setting_archive_excerpt_text_num',
		array(
			'default'           => 50,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_archive_excerpt_text_num',
			array(
				'label'    => __( 'Excerpt Text Num', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 500,
				'step'     => 1,
				'section'  => 'section_archive',
				'settings' => 'setting_archive_excerpt_text_num',
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_archive_display_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_archive_display_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">表示</p>',
				'section'  => 'section_archive',
				'settings' => 'setting_archive_display_header',
			)
		)
	);

	// Display Excerpt
	$wp_customize->add_setting(
		'setting_archive_display_excerpt',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_archive_display_excerpt',
			array(
				'label'    => __( 'Display Excerpt', 'nishiki-pro' ),
				'section'  => 'section_archive',
				'type'     => 'checkbox',
				'settings' => 'setting_archive_display_excerpt',
			)
		)
	);

	// Display Author
	$wp_customize->add_setting(
		'setting_archive_display_author',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_archive_display_author',
			array(
				'label'    => __( 'Display Author', 'nishiki-pro' ),
				'section'  => 'section_archive',
				'type'     => 'checkbox',
				'settings' => 'setting_archive_display_author',
			)
		)
	);

	// Display Date
	$wp_customize->add_setting(
		'setting_archive_display_date',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_archive_display_date',
			array(
				'label'    => __( 'Display Post Date', 'nishiki-pro' ),
				'section'  => 'section_archive',
				'type'     => 'checkbox',
				'settings' => 'setting_archive_display_date',
			)
		)
	);

	// Display Category
	$wp_customize->add_setting(
		'setting_archive_display_archive',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_archive_display_archive',
			array(
				'label'    => __( 'Display Archive', 'nishiki-pro' ),
				'section'  => 'section_archive',
				'type'     => 'checkbox',
				'settings' => 'setting_archive_display_archive',
			)
		)
	);

	// Display Comment
	$wp_customize->add_setting(
		'setting_archive_display_comment',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_archive_display_comment',
			array(
				'label'    => __( 'Display Comment', 'nishiki-pro' ),
				'section'  => 'section_archive',
				'type'     => 'checkbox',
				'settings' => 'setting_archive_display_comment',
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_archive_image_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_archive_image_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">アイキャッチ画像</p>',
				'section'  => 'section_archive',
				'settings' => 'setting_archive_image_header',
			)
		)
	);

	// Display Post Eye Catch
	$wp_customize->add_setting(
		'setting_archive_display_eye_catch',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_archive_display_eye_catch',
			array(
				'label'    => __( 'Display Eye Catch', 'nishiki-pro' ),
				'section'  => 'section_archive',
				'type'     => 'checkbox',
				'settings' => 'setting_archive_display_eye_catch',
			)
		)
	);

	// Default Post Eye Catch
	$wp_customize->add_setting(
		'setting_archive_default_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'nishiki_pro_sanitize_image',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'ctrl_archive_default_image',
			array(
				'label'       => __( 'Default Image', 'nishiki-pro' ),
				'description' => __( 'Display when eye-catching image is not set. Recommended image size 16:9', 'nishiki-pro' ),
				'section'     => 'section_archive',
				'settings'    => 'setting_archive_default_image',
			)
		)
	);

	// Default Post Eye Catch Aspect Ratio
	$wp_customize->add_setting(
		'setting_archive_post_eye_catch_aspect_ratio',
		array(
			'default'           => '16-9',
			'sanitize_callback' => 'nishiki_pro_sanitize_radio',
		)
	);

	$wp_customize->add_control(
		'ctrl_archive_post_eye_catch_aspect_ratio',
		array(
			'label'    => __( 'Post Eye Catch Aspect Ratio', 'nishiki-pro' ),
			'type'     => 'radio',
			'section'  => 'section_archive',
			'settings' => 'setting_archive_post_eye_catch_aspect_ratio',
			'choices'  => array(
				'16-9' => __( '16:9', 'nishiki-pro' ),
				'4-3'  => __( '4:3', 'nishiki-pro' ),
				'3-2'  => __( '3:2', 'nishiki-pro' ),
				'1-1'  => __( '1:1', 'nishiki-pro' ),
			),
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_archive_sidebar_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_archive_sidebar_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">サイドバー</p>',
				'section'  => 'section_archive',
				'settings' => 'setting_archive_sidebar_header',
			)
		)
	);

	// Column
	$wp_customize->add_setting(
		'setting_archive_column',
		array(
			'default'           => 'none',
			'sanitize_callback' => 'nishiki_pro_sanitize_choices',
		)
	);

	$wp_customize->add_control(
		'ctrl_archive_column',
		array(
			'label'    => __( 'Placement', 'nishiki-pro' ),
			'section'  => 'section_archive',
			'settings' => 'setting_archive_column',
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
		'setting_archive_sidebar_width',
		array(
			'default'           => 300,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_archive_sidebar_width',
			array(
				'label'    => __( 'Width(px)', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 1000,
				'step'     => 10,
				'section'  => 'section_archive',
				'settings' => 'setting_archive_sidebar_width',
			)
		)
	);

	// Sidebar Margin
	$wp_customize->add_setting(
		'setting_archive_sidebar_margin',
		array(
			'default'           => 50,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_archive_sidebar_margin',
			array(
				'label'    => __( 'Margin(px)', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 50,
				'step'     => 1,
				'section'  => 'section_archive',
				'settings' => 'setting_archive_sidebar_margin',
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_archive_title_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_archive_title_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">ページタイトル</p>',
				'section'  => 'section_archive',
				'settings' => 'setting_archive_title_header',
			)
		)
	);

	// Title Text Color
	$wp_customize->add_setting(
		'setting_archive_title_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_archive_title_text_color',
			array(
				'label'     => __( 'Text Color', 'nishiki-pro' ),
				'section'   => 'section_archive',
				'transport' => 'postMessage',
				'settings'  => 'setting_archive_title_text_color',
			)
		)
	);

	// Title Background Color
	$wp_customize->add_setting(
		'setting_archive_title_background_color',
		array(
			'default'           => '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_archive_title_background_color',
			array(
				'label'    => __( 'Background Color', 'nishiki-pro' ),
				'section'  => 'section_archive',
				'settings' => 'setting_archive_title_background_color',
			)
		)
	);

	// Title Background Opacity
	$wp_customize->add_setting(
		'setting_archive_title_background_opacity',
		array(
			'default'           => 100,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_archive_title_background_opacity',
			array(
				'label'    => __( 'Background Opacity(%)', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 100,
				'step'     => 1,
				'section'  => 'section_archive',
				'settings' => 'setting_archive_title_background_opacity',
			)
		)
	);

	// Display Eye Catch
	$wp_customize->add_setting(
		'setting_archive_eye_catch',
		array(
			'default'           => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_archive_eye_catch',
		array(
			'label'    => __( 'Display Eye Catch', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_archive',
			'settings' => 'setting_archive_eye_catch',
		)
	);

	// Eye Catch Layout
	$wp_customize->add_setting(
		'setting_archive_eye_catch_layout',
		array(
			'default'           => 'background',
			'sanitize_callback' => 'nishiki_pro_sanitize_radio',
		)
	);

	$wp_customize->add_control(
		'ctrl_archive_eye_catch_layout',
		array(
			'label'    => __( 'Eye Catch Layout', 'nishiki-pro' ),
			'type'     => 'radio',
			'section'  => 'section_archive',
			'settings' => 'setting_archive_eye_catch_layout',
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


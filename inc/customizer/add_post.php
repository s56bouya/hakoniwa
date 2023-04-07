<?php
add_action( 'customize_register', 'nishiki_pro_init_customizer_post' );
/**
 * 投稿ページ（カスタマイザー）
 *
 * @param instance $wp_customize インスタンス
 * @return void
 */
function nishiki_pro_init_customizer_post( $wp_customize ) {
	// Section
	$wp_customize->add_section(
		'section_post',
		array(
			'title'    => __( 'Posts', 'nishiki-pro' ),
			'priority' => 40,
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_post_sidebar_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_post_sidebar_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">サイドバー</p>',
				'section'  => 'section_post',
				'settings' => 'setting_post_sidebar_header',
			)
		)
	);

	// Column
	$wp_customize->add_setting(
		'setting_post_column',
		array(
			'default'           => 'none',
			'sanitize_callback' => 'nishiki_pro_sanitize_choices',
		)
	);

	$wp_customize->add_control(
		'ctrl_post_column',
		array(
			'label'    => __( 'Placement', 'nishiki-pro' ),
			'section'  => 'section_post',
			'settings' => 'setting_post_column',
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
		'setting_post_sidebar_width',
		array(
			'default'           => 300,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_post_sidebar_width',
			array(
				'label'    => __( 'Width(px)', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 1000,
				'step'     => 10,
				'section'  => 'section_post',
				'settings' => 'setting_post_sidebar_width',
			)
		)
	);

	// Sidebar Margin
	$wp_customize->add_setting(
		'setting_post_sidebar_margin',
		array(
			'default'           => 50,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_post_sidebar_margin',
			array(
				'label'    => __( 'Margin(px)', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 50,
				'step'     => 1,
				'section'  => 'section_post',
				'settings' => 'setting_post_sidebar_margin',
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_post_title_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_post_title_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">ページタイトル</p>',
				'section'  => 'section_post',
				'settings' => 'setting_post_title_header',
			)
		)
	);

	// Title Text Color
	$wp_customize->add_setting(
		'setting_post_title_text_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_post_title_text_color',
			array(
				'label'     => __( 'Text Color', 'nishiki-pro' ),
				'section'   => 'section_post',
				'transport' => 'postMessage',
				'settings'  => 'setting_post_title_text_color',
			)
		)
	);

	// Title Background Color
	$wp_customize->add_setting(
		'setting_post_title_background_color',
		array(
			'default'           => '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ctrl_post_title_background_color',
			array(
				'label'    => __( 'Background Color', 'nishiki-pro' ),
				'section'  => 'section_post',
				'settings' => 'setting_post_title_background_color',
			)
		)
	);

	// Title Background Opacity
	$wp_customize->add_setting(
		'setting_post_title_background_opacity',
		array(
			'default'           => 100,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Range(
			$wp_customize,
			'ctrl_post_title_background_opacity',
			array(
				'label'    => __( 'Background Opacity(%)', 'nishiki-pro' ),
				'min'      => 0,
				'max'      => 100,
				'step'     => 1,
				'section'  => 'section_post',
				'settings' => 'setting_post_title_background_opacity',
			)
		)
	);

	// Title Display Category
	$wp_customize->add_setting(
		'setting_post_display_category',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_display_category',
			array(
				'label'    => __( 'Display Category', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_display_category',
			)
		)
	);

	// Title Display Tag
	$wp_customize->add_setting(
		'setting_post_display_tag',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_display_tag',
			array(
				'label'    => __( 'Display Tag', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_display_tag',
			)
		)
	);

	// Title Display Comment
	$wp_customize->add_setting(
		'setting_post_display_comment',
		array(
			'default'           => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_display_comment',
			array(
				'label'    => __( 'Display Comment', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_display_comment',
			)
		)
	);

	// Title Display Publish Date
	$wp_customize->add_setting(
		'setting_post_display_published_date',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_display_published_date',
			array(
				'label'    => __( 'Display Published Date', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_display_published_date',
			)
		)
	);

	// Title Display Modified Date
	$wp_customize->add_setting(
		'setting_post_display_modified_date',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_display_modified_date',
			array(
				'label'    => __( 'Display Modified Date', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_display_modified_date',
			)
		)
	);

	// Display Eye Catch
	$wp_customize->add_setting(
		'setting_post_eye_catch',
		array(
			'default'           => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_post_eye_catch',
		array(
			'label'    => __( 'Display Eye Catch', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_post',
			'settings' => 'setting_post_eye_catch',
		)
	);

	// Eye Catch Layout
	$wp_customize->add_setting(
		'setting_post_eye_catch_layout',
		array(
			'default'           => 'background',
			'sanitize_callback' => 'nishiki_pro_sanitize_radio',
		)
	);

	$wp_customize->add_control(
		'ctrl_post_eye_catch_layout',
		array(
			'label'    => __( 'Eye Catch Layout', 'nishiki-pro' ),
			'type'     => 'radio',
			'section'  => 'section_post',
			'settings' => 'setting_post_eye_catch_layout',
			'choices'  => array(
				'background'   => __( 'Title Background', 'nishiki-pro' ),
				'top'          => __( 'Title Top', 'nishiki-pro' ),
				'bottom'       => __( 'Title Bottom', 'nishiki-pro' ),
				'content'      => __( 'Content Top', 'nishiki-pro' ),
				'content-wide' => __( 'Content Top(wide)', 'nishiki-pro' ),
			),
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_post_author_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_post_author_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">著者</p>',
				'section'  => 'section_post',
				'settings' => 'setting_post_author_header',
			)
		)
	);

	// Display Author
	$wp_customize->add_setting(
		'setting_post_author_display',
		array(
			'default'           => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'ctrl_post_author_display',
		array(
			'label'    => __( 'Display', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_post',
			'settings' => 'setting_post_author_display',
		)
	);

	// Author Text
	$wp_customize->add_setting(
		'setting_post_author_text',
		array(
			'default'           => __( 'Author', 'nishiki-pro' ),
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'ctrl_post_author_text',
		array(
			'label'    => __( 'Text Label', 'nishiki-pro' ),
			'type'     => 'text',
			'section'  => 'section_post',
			'settings' => 'setting_post_author_text',
		)
	);

	// Author Name Link
	$wp_customize->add_setting(
		'setting_post_author_name_archive_link',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'ctrl_post_author_name_archive_link',
		array(
			'label'    => __( 'Author Name Archive Link', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_post',
			'settings' => 'setting_post_author_name_archive_link',
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_post_related_posts_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_post_related_posts_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">関連記事</p>',
				'section'  => 'section_post',
				'settings' => 'setting_post_related_posts_header',
			)
		)
	);

	// Related Posts Display
	$wp_customize->add_setting(
		'setting_post_related_posts_display',
		array(
			'default'           => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'ctrl_post_related_posts_display',
		array(
			'label'    => __( 'Display', 'nishiki-pro' ),
			'type'     => 'checkbox',
			'section'  => 'section_post',
			'settings' => 'setting_post_related_posts_display',
		)
	);

	// Related Posts Text
	$wp_customize->add_setting(
		'setting_post_related_posts_text',
		array(
			'default'           => __( 'Related Posts', 'nishiki-pro' ),
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		'ctrl_post_related_posts_text',
		array(
			'label'    => __( 'Text Label', 'nishiki-pro' ),
			'type'     => 'text',
			'section'  => 'section_post',
			'settings' => 'setting_post_related_posts_text',
		)
	);

	// Related Posts Columns
	$wp_customize->add_setting(
		'setting_post_related_posts_columns',
		array(
			'default'           => 3,
			'sanitize_callback' => 'nishiki_pro_sanitize_choices_columns',
		)
	);

	$wp_customize->add_control(
		'ctrl_post_related_posts_columns',
		array(
			'label'    => __( 'Columns', 'nishiki-pro' ),
			'section'  => 'section_post',
			'settings' => 'setting_post_related_posts_columns',
			'type'     => 'select',
			'choices'  => array(
				'1' => __( '1 Column', 'nishiki-pro' ),
				'2' => __( '2 Columns', 'nishiki-pro' ),
				'3' => __( '3 Columns', 'nishiki-pro' ),
			),
		)
	);

	// Related Posts Number
	$wp_customize->add_setting(
		'setting_post_related_posts_number',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_number',
			'default'           => 3,
		)
	);

	$wp_customize->add_control(
		'ctrl_post_related_posts_number',
		array(
			'label'    => __( 'Number', 'nishiki-pro' ),
			'section'  => 'section_post',
			'settings' => 'setting_post_related_posts_number',
			'type'     => 'number',
		)
	);

	// Related Posts Display Excerpt
	$wp_customize->add_setting(
		'setting_post_related_posts_display_excerpt',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_related_posts_display_excerpt',
			array(
				'label'    => __( 'Display Excerpt', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_related_posts_display_excerpt',
			)
		)
	);

	// Related Posts Display Author
	$wp_customize->add_setting(
		'setting_post_related_posts_display_author',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_related_posts_display_author',
			array(
				'label'    => __( 'Display Author', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_related_posts_display_author',
			)
		)
	);

	// Related Posts Display Date
	$wp_customize->add_setting(
		'setting_post_related_posts_display_date',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_related_posts_display_date',
			array(
				'label'    => __( 'Display Post Date', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_related_posts_display_date',
			)
		)
	);

	// Display Category
	$wp_customize->add_setting(
		'setting_post_related_posts_display_archive',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_related_posts_display_archive',
			array(
				'label'    => __( 'Display Archive', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_related_posts_display_archive',
			)
		)
	);

	// Display Comment
	$wp_customize->add_setting(
		'setting_post_related_posts_display_comment',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_related_posts_display_comment',
			array(
				'label'    => __( 'Display Comment', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_related_posts_display_comment',
			)
		)
	);

	// Heading
	$wp_customize->add_setting(
		'setting_post_prev_next_link_header',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_post_prev_next_link_header',
			array(
				'label'    => '<p class="nishiki-pro-customizer-heading">前のページ＆次のページのリンク</p>',
				'section'  => 'section_post',
				'settings' => 'setting_post_prev_next_link_header',
			)
		)
	);

	// Display Prev Next Link
	$wp_customize->add_setting(
		'setting_post_display_prev_next_link',
		array(
			'default'           => true,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_display_prev_next_link',
			array(
				'label'    => __( 'Display', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_display_prev_next_link',
			)
		)
	);

	// Display Prev Next Link Eye Catch
	$wp_customize->add_setting(
		'setting_post_display_prev_next_link_eye_catch',
		array(
			'default'           => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_display_prev_next_link_eye_catch',
			array(
				'label'    => __( 'Display Eye Catch', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_display_prev_next_link_eye_catch',
			)
		)
	);

	// Display Prev Next Link Eye Catch Aspect Ratio
	$wp_customize->add_setting(
		'setting_post_display_prev_next_link_eye_catch_aspect_ratio',
		array(
			'default'           => '16-9',
			'sanitize_callback' => 'nishiki_pro_sanitize_radio',
		)
	);

	$wp_customize->add_control(
		'ctrl_post_display_prev_next_link_eye_catch_aspect_ratio',
		array(
			'label'    => __( 'Post Eye Catch Aspect Ratio', 'nishiki-pro' ),
			'type'     => 'radio',
			'section'  => 'section_post',
			'settings' => 'setting_post_display_prev_next_link_eye_catch_aspect_ratio',
			'choices'  => array(
				'16-9' => __( '16:9', 'nishiki-pro' ),
				'4-3'  => __( '4:3', 'nishiki-pro' ),
				'3-2'  => __( '3:2', 'nishiki-pro' ),
				'1-1'  => __( '1:1', 'nishiki-pro' ),
			),
		)
	);

	// Display Prev Next Link Same Term
	$wp_customize->add_setting(
		'setting_post_display_prev_next_link_same_term',
		array(
			'default'           => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'ctrl_post_display_prev_next_link_same_term',
			array(
				'label'    => __( 'Display same category only', 'nishiki-pro' ),
				'section'  => 'section_post',
				'type'     => 'checkbox',
				'settings' => 'setting_post_display_prev_next_link_same_term',
			)
		)
	);

}

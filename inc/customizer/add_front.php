<?php
add_action( 'customize_register', 'nishiki_pro_init_customizer_front' );
/**
 * フロントページ（カスタマイザー）
 *
 * @param instance $wp_customize インスタンス
 * @return void
 */
function nishiki_pro_init_customizer_front( $wp_customize ) {
	// Panel
	$wp_customize->add_section(
		'section_front_page',
		array(
			'title'           => __( 'Setting Front Page', 'nishiki-pro' ),
			'priority'        => 10000,
			'panel'           => 'panel_top',
			'active_callback' => 'nishiki_pro_is_static_front_page',
		)
	);

	// Wrapper
	$wp_customize->add_setting(
		'setting_front_page_notice',
		array(
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Nishiki_WP_Customize_Content(
			$wp_customize,
			'ctrl_front_page_notice',
			array(
				'label'    => '<p>【重要】フロントページのセクション機能はバージョン 1.0.185 で廃止しました。代わりにブロックエディターを使用ください。</p><a href="https://support.animagate.com/wp-nishiki-main-visual-section-migrate-block-editor/#chapter-4" target="_blank" rel="noreferrer noopener">→ブロックエディターでセクションを作る方法</a>',
				'section'  => 'section_front_page',
				'settings' => 'setting_front_page_notice',
			)
		)
	);

	// Disable Section
	$wp_customize->add_setting(
		'setting_front_page_section_display',
		array(
			'default'           => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'ctrl_front_page_section_display',
		array(
			'label'       => __( '過去に作ったセクションを表示する', 'nishiki-pro' ),
			'description' => '※ この設定は、ブロックエディターへの移行がまだ済んでいない方のために用意された応急的な設定項目です。この設定項目は将来的に削除し、カスタマイザーで作成したセクションは完全に表示されなくなります。また、恐れ入りますが、セクションの編集はできません。早急にブロックエディターへの移行をお願いいたします。',
			'type'        => 'checkbox',
			'section'     => 'section_front_page',
			'settings'    => 'setting_front_page_section_display',
		)
	);

	/*
	// Section
	for ( $i = 1; $i < ( 1 + NISHIKI_PRO_SECTION_NUM ); ++$i ) {

		// Add Section
		$wp_customize->add_setting( 'setting_front_page_section' . $i, array(
			'default'           =>  'disabled',
			//		'transport'         => 'postMessage',
			'sanitize_callback' =>  'nishiki_pro_sanitize_choices_front_page_section',
		));

		$wp_customize->add_control( 'ctrl_front_page_section' . $i, array(
			'label'             =>  __( 'Section', 'nishiki-pro' ) . $i,
			'section'           =>  'section_front_page',
			'settings'          =>  'setting_front_page_section' . $i,
			'type'              =>  'select',
			'choices'           =>  array(
				'disabled'         =>  __( 'Disabled', 'nishiki-pro' ),
				//			'recently'        =>  __( 'Recently Posts', 'nishiki-pro' ),
				'custom'        =>  __( 'Custom', 'nishiki-pro' ),
			),
		));

		// Upload Image
		$wp_customize->add_setting( 'setting_front_page_image' . $i, array(
			'default' => '',
			'sanitize_callback' => 'nishiki_pro_sanitize_image',
		));

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'setting_front_page_image' . $i,
				array(
					'label'       =>  __( 'Image', 'nishiki-pro' ) . $i,
					'section'     =>  'section_front_page',
					'settings'    =>  'setting_front_page_image' . $i,
				)
			)
		);

		// Image Placeholder Display
		$wp_customize->add_setting('setting_front_page_image_placeholder_display' . $i, array(
			'default' => false,
			'transport'     => 'postMessage',
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		));

		$wp_customize->add_control('ctrl_front_page_image_placeholder_display' . $i, array(
			'label'       =>  __( 'Display image placeholder', 'nishiki-pro' ),
			'type'        =>  'checkbox',
			'section'     =>  'section_front_page',
			'settings'    =>  'setting_front_page_image_placeholder_display' . $i,
		));

		// Image Placeholder Grayscale
		$wp_customize->add_setting( 'setting_front_page_image_placeholder_grayscale' . $i, array(
			'default'     => 100,
			'transport'     => 'postMessage',
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		) );

		$wp_customize->add_control(
			new Nishiki_WP_Customize_Range(
				$wp_customize,
				'ctrl_front_page_image_placeholder_grayscale' . $i,
				array(
					'label'	=>  __( 'Adjust image placeholder grayscale(%)', 'nishiki-pro' ),
					'min' => 0,
					'max' => 100,
					'step' => 1,
					'section' => 'section_front_page',
					'settings'   => 'setting_front_page_image_placeholder_grayscale' . $i,
				)
			)
		);

		// Background Color
		$wp_customize->add_setting( 'setting_front_page_background_color' . $i, array(
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		));

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ctrl_front_page_background_color' . $i,
				array(
					'label'       => __( 'Color above the image', 'nishiki-pro' ),
					'section'     => 'section_front_page',
					'settings'    => 'setting_front_page_background_color' . $i,
				)
			)
		);

		// Background Opacity
		$wp_customize->add_setting( 'setting_front_page_background_opacity' . $i, array(
			'default'     => 10,
			'sanitize_callback' => 'nishiki_pro_sanitize_number_range',
		) );

		$wp_customize->add_control(
			new Nishiki_WP_Customize_Range(
				$wp_customize,
				'ctrl_front_page_background_opacity' . $i,
				array(
					'label'	=>  __( 'Color above the image Opacity(%)', 'nishiki-pro' ),
					'min' => 0,
					'max' => 100,
					'step' => 1,
					'section' => 'section_front_page',
					'settings'   => 'setting_front_page_background_opacity' . $i,
				)
			)
		);

		// Main Text
		$wp_customize->add_setting( 'setting_front_page_main_text' . $i, array(
			'default'           => __( 'Main Text', 'nishiki-pro' ),
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		) );

		$wp_customize->add_control( 'ctrl_front_page_main_text' . $i, array(
			'label'    => __( 'Main Text', 'nishiki-pro' ) . $i,
			'type'     => 'text',
			'section'  => 'section_front_page',
			'settings' => 'setting_front_page_main_text' . $i,
		) );

		// Sub Text
		$wp_customize->add_setting( 'setting_front_page_sub_text' . $i, array(
			'default'           => '',
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		) );

		$wp_customize->add_control( 'ctrl_front_page_sub_text' . $i, array(
			'label'    => __( 'Sub Text', 'nishiki-pro' ) . $i,
			'type'     => 'text',
			'section'  => 'section_front_page',
			'settings' => 'setting_front_page_sub_text' . $i,
		) );

		// Text align
		$wp_customize->add_setting( 'setting_front_page_text_align' . $i, array(
			'default'           =>  'left',
			'sanitize_callback' =>  'nishiki_pro_sanitize_choices_align',
		));

		$wp_customize->add_control( 'ctrl_front_page_text_align' . $i, array(
			'label'             =>  __( 'Text Align', 'nishiki-pro' ) . $i,
			'section'           =>  'section_front_page',
			'settings'          =>  'setting_front_page_text_align' . $i,
			'type'              =>  'select',
			'choices'           =>  array(
				'left'         =>  __( 'Left', 'nishiki-pro' ),
				'center'        =>  __( 'Center', 'nishiki-pro' ),
				'right'        =>  __( 'Right', 'nishiki-pro' ),
			),
		));

		// Text Color
		$wp_customize->add_setting( 'setting_front_page_text_color' . $i, array(
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		));

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ctrl_front_page_text_color' . $i,
				array(
					'label'         => __( 'Text Color', 'nishiki-pro' ),
					'section'       => 'section_front_page',
					'transport'     => 'postMessage',
					'settings'      => 'setting_front_page_text_color' . $i,
				)
			)
		);

		// Button Text
		$wp_customize->add_setting( 'setting_front_page_button_text' . $i, array(
			'default'           => __( 'Button Text', 'nishiki-pro' ),
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		) );

		$wp_customize->add_control( 'ctrl_front_page_button_text' . $i, array(
			'label'    => __( 'Button Text', 'nishiki-pro' ) . $i,
			'type'     => 'text',
			'section'  => 'section_front_page',
			'settings' => 'setting_front_page_button_text' . $i,
		) );

		// Button Link
		$wp_customize->add_setting('setting_front_page_button_link' . $i,array(
			'default' => '#',
			'sanitize_callback' => 'nishiki_pro_sanitize_text',
		));

		$wp_customize->add_control('ctrl_front_page_button_link' . $i,array(
			'label'     =>  __( 'Button Link', 'nishiki-pro' ),
			'type'      =>  'text',
			'section'   =>  'section_front_page',
			'settings'  =>  'setting_front_page_button_link' . $i,
		));

		// Button Text Color
		$wp_customize->add_setting( 'setting_front_page_button_text_color' . $i, array(
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		));

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ctrl_front_page_button_text_color' . $i,
				array(
					'label'      => __( 'Button Text Color', 'nishiki-pro' ),
					'section'    => 'section_front_page',
					'settings'   => 'setting_front_page_button_text_color' . $i,
				)
			)
		);

		// Button Link Color
		$wp_customize->add_setting( 'setting_front_page_button_link_color' . $i, array(
			'default' => '#333333',
			'sanitize_callback' => 'sanitize_hex_color',
		));

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'ctrl_front_page_button_link_color' . $i,
				array(
					'label'      => __( 'Button Link Color', 'nishiki-pro' ),
					'section'    => 'section_front_page',
					'transport'   => 'postMessage',
					'settings'   => 'setting_front_page_button_link_color' . $i,
				)
			)
		);

		// Button Link Target
		$wp_customize->add_setting('setting_front_page_button_link_target' . $i, array(
			'default' => false,
			'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
		));

		$wp_customize->add_control('ctrl_front_page_button_link_target' . $i, array(
			'label'       =>  __( 'Open New Tab', 'nishiki-pro' ),
			'type'        =>  'checkbox',
			'section'     =>  'section_front_page',
			'settings'    =>  'setting_front_page_button_link_target' . $i,
		));


		// Featured Items

		// Add Featured Item
		$wp_customize->add_setting( 'setting_front_page_featured_items' . $i, array(
			'default'           =>  'disabled',
			'sanitize_callback' =>  'nishiki_pro_sanitize_choices_front_page_featured_items',
		));

		$wp_customize->add_control( 'ctrl_front_page_featured_items' . $i, array(
			'label'             =>  __( 'Add Item', 'nishiki-pro' ),
			'section'           =>  'section_front_page',
			'settings'          =>  'setting_front_page_featured_items' . $i,
			'type'              =>  'select',
			'choices'           =>  array(
				'disabled'         =>  __( 'Disabled', 'nishiki-pro' ),
				'enabled'        =>  __( 'Enabled', 'nishiki-pro' ),
			),
		));


		// Item Columns
		$wp_customize->add_setting('setting_front_page_featured_item_column' . $i, array(
			'default'           =>  3,
			'sanitize_callback' =>  'nishiki_pro_sanitize_choices_columns',
		));

		$wp_customize->add_control('ctrl_front_page_featured_item_column' . $i, array(
			'label'             =>  __( 'Item Columns', 'nishiki-pro' ),
			'section'           =>  'section_front_page',
			'settings'          =>  'setting_front_page_featured_item_column' . $i,
			'type'              =>  'select',
			'choices'           =>  array(
				'1' =>  __( '1 Column', 'nishiki-pro' ),
				'2' =>  __( '2 Columns', 'nishiki-pro' ),
				'3' =>  __( '3 Columns', 'nishiki-pro' ),
			),
		));


		$j = 1;
		while ( $j <= NISHIKI_PRO_FEATURED_ITEM_NUM ) {

			// Wrapper
			$wp_customize->add_setting( 'setting_front_page_featured_item_header' . $i . '_' . $j, array(
				'sanitize_callback' => 'nishiki_pro_sanitize_text',
			));

			$wp_customize->add_control(
				new Nishiki_WP_Customize_Content(
					$wp_customize, 'ctrl_front_page_featured_item_header' . $i . '_' . $j,
					array(
						'label'         =>  '<span class="item-num item-num' . $j . '">' . __( 'Item', 'nishiki-pro' ) . ' ' . $j . '</span>',
						'section'       =>  'section_front_page',
						'settings'      =>  'setting_front_page_featured_item_header' . $i . '_' . $j,
					)
				)
			);


			// Display Featured Item
			$wp_customize->add_setting('setting_front_page_featured_item' . $i . '_' . $j, array(
				'default'           =>  'disabled',
				'sanitize_callback' =>  'nishiki_pro_sanitize_choices_front_page_featured_items',
			));

			$wp_customize->add_control('ctrl_front_page_featured_item' . $i . '_' . $j, array(
				'label'             =>  __( 'Display Item', 'nishiki-pro' ),
				'section'           =>  'section_front_page',
				'settings'          =>  'setting_front_page_featured_item' . $i . '_' . $j,
				'type'              =>  'select',
				'choices'           =>  array(
					'disabled' =>  __( 'Disabled', 'nishiki-pro' ),
					'enabled' =>  __( 'Enabled', 'nishiki-pro' ),
				),
			));


			// Select Icon or Image
			$wp_customize->add_setting('setting_front_page_featured_item_type' . $i . '_' . $j, array(
				'default'           =>  'icon',
				'sanitize_callback' =>  'nishiki_pro_sanitize_choices_item',
			));

			$wp_customize->add_control('ctrl_front_page_featured_item_type' . $i . '_' . $j, array(
				'label'             =>  __( 'Select Item Type', 'nishiki-pro' ),
				'section'           =>  'section_front_page',
				'settings'          =>  'setting_front_page_featured_item_type' . $i . '_' . $j,
				'type'              =>  'select',
				'choices'           =>  array(
					'icon' =>  __( 'Icon', 'nishiki-pro' ),
					'image' =>  __( 'Image', 'nishiki-pro' ),
				),
			));


			// Item Icon
			$wp_customize->add_setting('setting_front_page_featured_item_icon' . $i . '_' . $j, array(
				'default'           =>  '',
				'sanitize_callback' =>  'nishiki_pro_sanitize_text',
			));

			$wp_customize->add_control('ctrl_front_page_featured_item_icon' . $i . '_' . $j, array(
				'label'             =>  __( 'Item Icon', 'nishiki-pro' ),
				'description'       =>  __( 'Example:menu', 'nishiki-pro' ) . '(<a href="' . esc_url( admin_url( 'themes.php?page=nishiki-about&tab=iconfont' ) ) . '">' . __( 'Use Icon', 'nishiki-pro' ) . '</a>)',
				'section'           =>  'section_front_page',
				'settings'          =>  'setting_front_page_featured_item_icon' . $i . '_' . $j,
				'type'      =>  'text',
			));

			// Item Upload Image
			$wp_customize->add_setting( 'setting_front_page_featured_item_image' . $i . '_' . $j, array(
				'default' => '',
				'sanitize_callback' => 'nishiki_pro_sanitize_image',
			));

			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					'ctrl_front_page_featured_item_image' . $i . '_' . $j,
					array(
						'label'       =>  __( 'Item Image', 'nishiki-pro' ),
						'section'     =>  'section_front_page',
						'settings'    =>  'setting_front_page_featured_item_image' . $i . '_' . $j,
					)
				)
			);

			// Item Icon Color
			$wp_customize->add_setting('setting_front_page_featured_item_icon_color' . $i . '_' . $j, array(
				'default' => '#333333',
				'sanitize_callback' => 'sanitize_hex_color',
			));

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'ctrl_front_page_featured_item_icon_color' . $i . '_' . $j,
					array(
						'label'      => __( 'Item Icon Color', 'nishiki-pro' ),
						'section'    => 'section_front_page',
						'settings'   => 'setting_front_page_featured_item_icon_color' . $i . '_' . $j,
					)
				)
			);


			// Item Title
			$wp_customize->add_setting('setting_front_page_featured_item_title' . $i . '_' . $j, array(
				'default' => '',
				'sanitize_callback' => 'nishiki_pro_sanitize_text',
			));

			$wp_customize->add_control('ctrl_front_page_featured_item_title' . $i . '_' . $j, array(
				'label'     =>  __( 'Item Title', 'nishiki-pro' ),
				'type'      =>  'text',
				'section'   =>  'section_front_page',
				'settings'  =>  'setting_front_page_featured_item_title' . $i . '_' . $j,
			));


			// Item Title Color
			$wp_customize->add_setting('setting_front_page_featured_item_title_color' . $i . '_' . $j, array(
				'default' => '#333333',
				'sanitize_callback' => 'sanitize_hex_color',
			));

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'ctrl_front_page_featured_item_title_color' . $i . '_' . $j,
					array(
						'label'      => __( 'Item Title Color', 'nishiki-pro' ),
						'section'    => 'section_front_page',
						'settings'   => 'setting_front_page_featured_item_title_color' . $i . '_' . $j,
					)
				)
			);


			// Item Text
			$wp_customize->add_setting('setting_front_page_featured_item_text' . $i . '_' . $j, array(
				'default' => '',
				'sanitize_callback' => 'nishiki_pro_sanitize_text',
			));

			$wp_customize->add_control('ctrl_front_page_featured_item_text' . $i . '_' . $j, array(
				'label'     =>  __( 'Item Text', 'nishiki-pro' ),
				'type'      =>  'text',
				'section'   =>  'section_front_page',
				'settings'  =>  'setting_front_page_featured_item_text' . $i . '_' . $j,
			));


			// Item Text Color
			$wp_customize->add_setting('setting_front_page_featured_item_text_color' . $i . '_' . $j, array(
				'default' => '#333333',
				'sanitize_callback' => 'sanitize_hex_color',
			));

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'ctrl_front_page_featured_item_text_color' . $i . '_' . $j,
					array(
						'label'      => __( 'Item Text Color', 'nishiki-pro' ),
						'section'    => 'section_front_page',
						'settings'   => 'setting_front_page_featured_item_text_color' . $i . '_' . $j,
					)
				)
			);


			// Item Button Text
			$wp_customize->add_setting('setting_front_page_featured_item_button_text' . $i . '_' . $j, array(
				'default' => '',
				'sanitize_callback' => 'nishiki_pro_sanitize_text',
			));

			$wp_customize->add_control('ctrl_front_page_featured_item_button_text' . $i . '_' . $j, array(
				'label'     =>  __( 'Item Button Text', 'nishiki-pro' ),
				'type'      =>  'text',
				'section'   =>  'section_front_page',
				'settings'  =>  'setting_front_page_featured_item_button_text' . $i . '_' . $j,
			));


			// Item Button Link
			$wp_customize->add_setting('setting_front_page_featured_item_button_link' . $i . '_' . $j, array(
				'default' => '',
				'sanitize_callback' => 'nishiki_pro_sanitize_text',
			));

			$wp_customize->add_control('ctrl_front_page_featured_item_button_link' . $i . '_' . $j, array(
				'label'     =>  __( 'Item Button Link', 'nishiki-pro' ),
				'type'      =>  'text',
				'section'   =>  'section_front_page',
				'settings'  =>  'setting_front_page_featured_item_button_link' . $i . '_' . $j,
			));


			// Item Button Text Color
			$wp_customize->add_setting('setting_front_page_featured_item_button_text_color' . $i . '_' . $j, array(
				'default' => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
			));

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'ctrl_front_page_featured_item_button_text_color' . $i . '_' . $j,
					array(
						'label'      => __( 'Item Button Text Color', 'nishiki-pro' ),
						'section'    => 'section_front_page',
						'settings'   => 'setting_front_page_featured_item_button_text_color' . $i . '_' . $j,
					)
				)
			);


			// Item Button Link Color
			$wp_customize->add_setting('setting_front_page_featured_item_button_link_color' . $i . '_' . $j, array(
				'default' => '#333333',
				'sanitize_callback' => 'sanitize_hex_color',
			));

			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'ctrl_front_page_featured_item_button_link_color' . $i . '_' . $j,
					array(
						'label'      => __( 'Item Button Link Color', 'nishiki-pro' ),
						'section'    => 'section_front_page',
						'settings'   => 'setting_front_page_featured_item_button_link_color' . $i . '_' . $j,
					)
				)
			);

			// Item Button Link Target
			$wp_customize->add_setting('setting_front_page_featured_item_button_link_target' . $i . '_' . $j, array(
				'default' => false,
				'sanitize_callback' => 'nishiki_pro_sanitize_checkbox',
			));

			$wp_customize->add_control('ctrl_front_page_featured_item_button_link_target' . $i . '_' . $j, array(
				'label'       =>  __( 'Open New Tab', 'nishiki-pro' ),
				'type'        =>  'checkbox',
				'section'     =>  'section_front_page',
				'settings'    =>  'setting_front_page_featured_item_button_link_target' . $i . '_' . $j,
			));



			$j++;

		}


	}
	*/

}

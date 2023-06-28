<?php
namespace hakoniwa\theme\blocks\styles;

use hakoniwa\theme\init\Define;

class Register {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'register' ], 10 );
	}

	/**
	 * スタイル追加
	 */
	public function register() {

		require_once 'heading.php';

		require_once 'paragraph.php';

		require_once 'group.php';

		require_once 'image.php';

		require_once 'list.php';

		require_once 'button.php';

		// heading
		$this->register_blocks_styles( 'core/heading', $heading_array );

		// paragraph
		$this->register_blocks_styles( 'core/paragraph', $paragraph_array );

		// group
		$this->register_blocks_styles( 'core/group', $group_array );

		// image
		$this->register_blocks_styles( 'core/image', $image_array );

		// list
		$this->register_blocks_styles( 'core/list', $list_array );

		// Button
		$this->register_blocks_styles( 'core/button', $button_array );
		
	}

	/**
	 * スタイル登録
	 *
	 * @param string $block_name ブロック名
	 * @param array  $style_props プロパティ
	 * @return void
	 */
	public function register_blocks_styles( $block_name, $style_props, $prefix = '' ) {
		if ( ! empty( $block_name ) && ! empty( $style_props ) && is_array( $style_props ) ) {
			$prefix = Define::value( 'theme_name' ) . '-';

			foreach ( $style_props as $prop ) {
				$porp_array = array(
					'name'  => $prefix . $prop['name'],
					'label' => $prop['label']
				);

				if( ! empty( $prop['inline_style'] ) ) {
					$porp_array['inline_style'] = $prop['inline_style'];
				}

				if( ! empty( $prop['style_handle'] ) ) {
					$porp_array['style_handle'] = $prop['style_handle'];
				}

				register_block_style(
					$block_name,
					$porp_array
				);
			}
		}
	}
}

use hakoniwa\theme\blocks\styles;
new Register();

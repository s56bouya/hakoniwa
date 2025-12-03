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

		require_once 'background.php';

		require_once 'heading.php';

		require_once 'symbol.php';

		require_once 'image.php';

		require_once 'list.php';

		require_once 'cover.php';

		require_once 'button.php';

		require_once 'box-shadow.php';

		require_once 'accordion.php';

		// heading
		$this->register_blocks_styles( 'core/heading', $heading_array );

		// paragraph
		$this->register_blocks_styles( 'core/paragraph', $symbol_array );
		$this->register_blocks_styles( 'core/paragraph', $box_shadow_array );

		// group
		$this->register_blocks_styles( 'core/group', $symbol_array );
		$this->register_blocks_styles( 'core/group', $background_array );
		$this->register_blocks_styles( 'core/group', $box_shadow_array );

		// image
		$this->register_blocks_styles( 'core/image', $image_array );
		$this->register_blocks_styles( 'core/image', $box_shadow_array );

		// list
		$this->register_blocks_styles( 'core/list', $list_array );

		// Cover
		$this->register_blocks_styles( 'core/cover', $cover_array );

		// Button
		$this->register_blocks_styles( 'core/button', $button_array );
		$this->register_blocks_styles( 'core/button', $box_shadow_array );
		
		// Accordion
		$this->register_blocks_styles( 'core/accordion', $accordion_array );
	}

	/**
	 * Register Block Styles
	 *
	 * @param string $block_name Block name
	 * @param array  $style_props Props
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

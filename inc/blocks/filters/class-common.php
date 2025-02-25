<?php
namespace hakoniwa\theme\blocks\filters\core;

use hakoniwa\theme\init\Define;

/**
 * Block Filters
 */
class Common {

	/**
	 * constructor
	 */
	public function __construct() {

		//add_filter( 'render_block', [ $this, 'render_block' ], 10, 2 );

	}

	public function render_block( $block_content, $block ) {

		if( ! wp_strip_all_tags( $block_content ) ){
			return false;
		}

		return $block_content;

	}
	
}

use hakoniwa\theme\blocks\filters\core;
new Common();

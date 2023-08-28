<?php
namespace hakoniwa\theme\blocks\filters\core;

use hakoniwa\theme\init\Define;

/**
 * Block Filters
 */
class Cover {

	/**
	 * constructor
	 */
	public function __construct() {

		add_filter( 'render_block_core/cover', [ $this, 'render_block' ], 10, 2 );

	}

	public function render_block( $block_content, $block ) {

		return preg_replace( '@<div[^>]*?class="no-image".*?>(.*?)</div>@s', '', $block_content );

		return $block_content;

	}
	
}

use hakoniwa\theme\blocks\filters\core;
new Cover();

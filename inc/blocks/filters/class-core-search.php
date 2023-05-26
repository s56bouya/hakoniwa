<?php
namespace hakoniwa\theme\blocks\filters\core;

use hakoniwa\theme\init\Define;

/**
 * Block Filters
 */
class Search {

	/**
	 * constructor
	 */
	public function __construct() {

		add_filter( 'render_block_core/search', [ $this, 'render_block' ], 10, 2 );

	}

	public function render_block( $block_content, $block ) {

		if( is_search() ){
			if( ! have_posts() ){
				$text = '<p>' . esc_html( __( 'We could not find any results for your search. You can give it another try through the search form below.', 'hakoniwa' ) ) . '</p>';
				$block_content = $text . $block_content;
			}
		}

		return $block_content;

	}
	
}

use hakoniwa\theme\blocks\filters\core;
new Search();

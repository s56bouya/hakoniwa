<?php
namespace hakoniwa\theme\blocks\core\header;

/**
 * ブロックフィルター
 */
class Filter {

    /**
     * constructor.
     */
    public function __construct() {
        add_filter( 'render_block_core/template-part', array( $this, 'render_block' ), 100, 2 );
    }

    public function render_block( $block_content, $block ) {
        //var_dump($block);

        /*
        if( $block['attrs']['slug'] === 'header' ) {
            $block_content = 'abc' . $block_content;
        }
        */

        return $block_content;
    }

}

use hakoniwa\theme\blocks\core\header\Filter;
new Filter();

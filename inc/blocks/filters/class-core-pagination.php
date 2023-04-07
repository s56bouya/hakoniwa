<?php
namespace fse\theme\blocks\core\pagination;

/**
 * ブロックフィルター
 */
class Filter {

    /**
     * constructor.
     */
    public function __construct() {
        add_filter( 'render_block_core/query-pagination-previous', array( $this, 'previous' ), 100, 2 );
        add_filter( 'render_block_core/query-pagination-next', array( $this, 'next' ), 100, 2 );
    }

    public function previous( $block_content, $block ) {
        global $wp_query;

        $max_pages = $wp_query->max_num_pages;
        $current_page = ( get_query_var('paged') ) ? get_query_var('paged'): '';

        if ( '' === $current_page && have_posts() && absint( $max_pages ) > 1 ) {
            $block_content .= '<div class="wp-block-query-pagination-previous disabled opacity-20">前のページ</div>';
        }

        return $block_content;
    }

    public function next( $block_content, $block ) {

        global $wp_query;

        $max_pages = $wp_query->max_num_pages;
        $current_page = ( get_query_var('paged') ) ? get_query_var('paged'): '';

        if ( $current_page === absint( $max_pages ) ) {
            $block_content .= '<div class="wp-block-query-pagination-next disabled opacity-20">次のページ</div>';
        }

        return $block_content;
    }
}

use fse\theme\blocks\core\pagination\Filter;
new Filter();

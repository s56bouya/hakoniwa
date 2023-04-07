<?php
namespace hakoniwa\theme\blocks;

use hakoniwa\theme\init\Define;

/**
 * ブロックカテゴリー登録
 */
class Categories {

    /**
     * Constructor.
     */
    public function __construct() {
        if ( function_exists( 'get_default_block_categories' ) && function_exists( 'get_block_editor_settings' ) ) {
            add_filter( 'block_categories_all', array( $this, 'register' ), 10, 1 );
        } else {
            add_filter( 'block_categories', array( $this, 'register' ), 10, 1 );
        }
    }

    /**
     * ブロックカテゴリー追加
     *
     * @param array $categories Array of categories for block types.
     */
    public function register( $categories ) {
        return array_merge(
            $categories,
            array(
                array(
                    'slug'  => Define::value( 'theme_name' ),
                    'title' => Define::value( 'theme_name' ),
                ),
            )
        );
    }
}

use hakoniwa\theme\blocks;
new Categories();
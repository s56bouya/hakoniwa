<?php
namespace hakoniwa\theme\init;

use hakoniwa\theme\init\Define;

class Settings {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'after_setup_theme', [ $this, 'theme_support' ] );

		add_filter( 'post_thumbnail_html', [ $this, 'default_thumbnail' ], 10, 3 );

		add_action( 'init', [ $this, 'register_pattern_categories' ] );

	}

	/**
	 * Theme Support
	 */
	public function theme_support(){

		load_theme_textdomain( Define::value( 'theme_name' ), get_template_directory() . '/languages' );

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'editor-styles' );
		
		add_theme_support( 'responsive-embeds' );

	}

	/**
	 * Default Thumbnails
	 */
	public function default_thumbnail( $html, $post_id, $post_thumbnail_id ){

		if( ! $html ){

			$html = '<div class="no-image"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="15" y1="8" x2="15.01" y2="8"></line><rect x="4" y="4" width="16" height="16" rx="3"></rect><path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5"></path><path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2"></path></svg></div>';

			$html = apply_filters( Define::value( 'theme_name' ) . '_default_thumbnail', $html );

		}

		return $html;
		
	}

	/**
	 * Block Pattern Categories
	 */
	public function register_pattern_categories() {

		$patterns = array();
	
		$block_pattern_categories = array(
			'Hakoniwa' => array( 
				'label' => __( 'Hakoniwa Theme', 'hakoniwa' )
			),
			'profile' => array( 
				'label' => __( 'Profile', 'hakoniwa' )
			),
			'author' => array( 
				'label' => __( 'Author', 'hakoniwa' )
			),
			'sidebar' => array( 
				'label' => __( 'Sidebar', 'hakoniwa' )
			)
		);
	
		$block_pattern_categories = apply_filters( 'hakoniwa_block_pattern_categories', $block_pattern_categories );
	
		foreach ( $block_pattern_categories as $name => $properties ) {
			if ( ! \WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
				register_block_pattern_category( $name, $properties );
			}
		}
	}

}

use hakoniwa\theme\init;
new Settings();

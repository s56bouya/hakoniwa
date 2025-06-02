<?php
namespace hakoniwa\theme\init;

use hakoniwa\theme\init\Define;

class Scripts {
	
	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', [ $this, 'read_scripts' ] );

		add_action( 'admin_enqueue_scripts', [ $this, 'read_admin_scripts' ] );
		
//		add_action( 'after_setup_theme', [ $this, 'add_editor_styles' ], 100 );
		add_action( 'enqueue_block_editor_assets', [ $this, 'add_editor_styles' ], 10 );

	}

	/**
	 * Get Theme Version
	 *
	 * @return string
	 */
	private function theme_version() {

		$theme_version  = wp_get_theme()->get( 'Version' );
        return is_string( $theme_version ) ? $theme_version : false;

    }

	/**
	 * Enqueue Front End Scripts & Styles
	 */
	public function read_scripts() {

		/**
		* Add Script
		*/ 
		wp_enqueue_script( 'jquery' );

		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$front_end_js = apply_filters( Define::value( 'theme_name' ) . '_enqueue_front_end_js', get_template_directory_uri() . '/assets/js/front-end.js' );

//		wp_register_script( Define::value( 'theme_name' ) . '-front-end', $front_end_js, [], $version_string, true );
//		wp_enqueue_script( Define::value( 'theme_name' ) . '-front-end' );

		/**
		* Add Style
		*/ 

		$front_end_css = apply_filters( Define::value( 'theme_name' ) . '_enqueue_front_end_css', get_template_directory_uri() . '/assets/css/front-end.css' );

		wp_register_style( Define::value( 'theme_name' ) . '-front-end', $front_end_css, [], self::theme_version(), 'all' );
		wp_enqueue_style( Define::value( 'theme_name' ) . '-front-end' );

	}

	/**
	 * Enqueue Admin Scripts & Styles
	 */
	public function read_admin_scripts() {

		wp_enqueue_style(
			Define::value( 'theme_name' ) . '-admin',
			get_template_directory_uri() . '/assets/css/admin.css',
			[],
			self::theme_version(),
		);

	}

	/**
	 * Enqueue Back End Styles
	 */
	function add_editor_styles_bk() {

		$stylesheet_path = './assets/css/back-end.css';

		add_editor_style( $stylesheet_path );

	}

	/**
	 * Enqueue Back End Styles
	 */
	public function add_editor_styles() {
		wp_enqueue_style(
			Define::value( 'theme_name' ) . '-editor',
			get_template_directory_uri() . '/assets/css/back-end.css',
			array(),
			'1.0'
		);
	}

}

use hakoniwa\theme\init;
new Scripts();

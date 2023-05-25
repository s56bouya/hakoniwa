<?php
namespace hakoniwa\theme\init;

use hakoniwa\theme\init\Define;

class Scripts {
	
	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', [ $this, 'read_scripts' ] );
		
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_read_scripts' ] );

		add_action( 'after_setup_theme', [ $this, 'add_editor_styles' ], 10 );

	}

	/**
	 * Enqueue Front End Scripts & Styles
	 */
	public function read_scripts() {
		$theme_version  = wp_get_theme()->get( 'Version' );
		$version_string = is_string( $theme_version ) ? $theme_version : false;

		/**
		* Add Script
		*/ 
		wp_enqueue_script( 'jquery' );

		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$front_end_js = apply_filters( Define::value( 'theme_name' ) . '_enqueue_front_end_js', get_template_directory_uri() . '/assets/js/front-end.js' );

		wp_register_script( Define::value( 'theme_name' ) . '-front-end', $front_end_js, array(), $version_string, true );
		wp_enqueue_script( Define::value( 'theme_name' ) . '-front-end' );

		/**
		* Add Style
		*/ 

		// front
		$front_end_css = apply_filters( Define::value( 'theme_name' ) . '_enqueue_front_end_css', get_template_directory_uri() . '/assets/css/front-end.css' );

		wp_register_style( Define::value( 'theme_name' ) . '-front-end', $front_end_css, array(), $version_string, 'all' );
		wp_enqueue_style( Define::value( 'theme_name' ) . '-front-end' );

	}

	/**
	 * Admin Style & Script
	 */
	public function admin_read_scripts() {

		// Add Localize
		$localize_data = array( 
			'themeName' => Define::value( 'theme_name' )
		);

		wp_localize_script( 'common', 'object', $localize_data );
		
	}

	/**
	 * Enqueue Back End Styles
	 */
	function add_editor_styles() {

		$stylesheet_path = './assets/css/back-end.css';

		add_editor_style( $stylesheet_path );

	}

}

use hakoniwa\theme\init;
new Scripts();

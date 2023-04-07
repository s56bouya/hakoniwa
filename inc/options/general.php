<?php
namespace hakoniwa\theme\options;

use hakoniwa\theme\init\Define;
use hakoniwa\theme\util\CreateForm;

class General {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'register_settings' ], 10 );
	}

	/**
	 * ページ名
	 */
	public function page_name(){
		return Define::value( 'theme_options_name' ) . '_general';
	}

	/**
	 * フォーム追加
	 */
	public function register_settings() {
		$create_form = new CreateForm;

		register_setting(
			$this->page_name(),
			$this->page_name(),
			array( $this, 'sanitize' )
		);

		add_settings_section(
			$this->page_name(),
			'',
			array( $create_form, 'nonce' ),
			$this->page_name()
		);

		add_settings_field(
			'content_size',
			__( 'コンテンツ幅(px)', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'content_size',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'wide_size',
			__( '幅広(px)', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'wide_size',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

	}

	/**
	 * 入力値のサニタイズ
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ) {
		$new_input = array();

//		wp_die(var_dump($input) );

		if ( isset( $input ) ) {
			foreach ( $input as $key => $val ) {
				// 配列の場合
				if ( is_array( $input[ $key ] ) ) {
					$new_input[ $key ] = array_map( 'absint', $input[ $key ] );
				} else {
					// 通常の場合
					$new_input[ $key ] = sanitize_text_field( $input[ $key ] );
				}
			}
		}

		return $new_input;
	}

}

use hakoniwa\theme\options;
new General();

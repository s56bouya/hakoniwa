<?php
namespace hakoniwa\theme\options;

use hakoniwa\theme\init\Define;
use hakoniwa\theme\util\CreateForm;

class LoginPage {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'register_settings' ], 10 );

		add_action( 'login_enqueue_scripts', [ $this, 'login_page' ] );
	}

	/**
	 * ページ名
	 */
	public function page_name(){
		return Define::value( 'theme_options_name' ) . '_login';
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
			'logo_image',
			__( 'ロゴ画像', Define::value( 'theme_name' ) ),
			array( $create_form, 'imageUpload' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'logo_image',
				'page_name'   => $this->page_name(),
				'description' => 'ログイン画面のロゴ画像を変更します。',
			)
		);

		add_settings_field(
			'background_color',
			__( '背景カラー', Define::value( 'theme_name' ) ),
			array( $create_form, 'colorPicker' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'background_color',
				'page_name'   => $this->page_name(),
				'',
			)
		);

		add_settings_field(
			'text_color',
			__( 'テキストカラー', Define::value( 'theme_name' ) ),
			array( $create_form, 'colorPicker' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'text_color',
				'page_name'   => $this->page_name(),
				'',
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

		if ( isset( $input ) ) {
			foreach ( $input as $key => $val ) {
				// 配列の場合
				if ( is_array( $input[ $key ] ) ) {
					$new_input[ $key ] = array_map( 'absint', $input[ $key ] );
				} else {
					// 通常の場合
					$new_input[ $key ] = stripslashes( $input[ $key ] );
				}
			}
		}

		return $new_input;
	}

	/**
	 * ログインページ
	 *
	 * @return void
	 */
	public function login_page() {
		$options = get_option( $this->page_name() );

		if ( empty( $options ) ) {
			return false;
		}
		
		$logo_style             = '';
		$text_color_style       = '';
		$background_color_style = '';

		$logo_css             = '';
		$text_color_css       = '';
		$background_color_css = '';

		// Logo
		$image_attachment_id = $options['logo_image'];

		if ( $image_attachment_id ) {
			$image_data = wp_get_attachment_image_src( $image_attachment_id, 'thumbnail' );
			if ( $image_data[0] ) {
				$image_url    = $image_data[0];
				$image_width  = $image_data[1];
				$image_height = $image_data[2];
			}

			$image_max_width  = '100%';
			$image_max_height = '100%';

			if ( $image_width > 320 ) {
				$image_max_width  = '320px';
				$image_max_height = floor( 320 * $image_height / $image_width ) . 'px;';
			}

			$logo_style .= 'background-image: url(' . esc_url( $image_url ) . ');';
			$logo_style .= 'width:' . absint( $image_width ) . 'px;';
			$logo_style .= 'height:' . absint( $image_height ) . 'px;';
			$logo_style .= 'max-width:' . $image_max_width . ';';
			$logo_style .= 'max-height:' . $image_max_height . ';';
			$logo_style .= 'background-size: 100%;';
			$logo_style .= 'background-repeat: no-repeat;';
		}

		if ( $logo_style ) {
			$logo_css = '#login h1 a, .login h1 a {' . $logo_style . '}';
		}

		// Background Color
		$background_color = $options['background_color'];
		if ( $background_color ) {
			$background_color_style .= 'background-color:' . esc_html( $background_color ) . ';';
		}

		if ( $background_color_style ) {
			$background_color_css = 'body.login {' . $background_color_style . '}';
		}

		// Text Color
		$text_color = $options['text_color'];
		if ( $text_color ) {
			$text_color_style .= 'color:' . esc_html( $text_color ) . ';';
		}

		if ( $text_color_style ) {
			$text_color_css = 'body.login #backtoblog a, body.login #backtoblog a:hover, body.login #nav, body.login #nav a, body.login #nav a:hover, .privacy-policy-link, .privacy-policy-link:hover {' . $text_color_style . '}';
		}

		if ( $logo_css || $background_color_css || $text_color_css ) {
			echo '<style type="text/css">';
			echo wp_kses_post( $logo_css . $text_color_css . $background_color_css );
			echo '</style>';
		}

	}

}

use hakoniwa\theme\options;
new LoginPage();

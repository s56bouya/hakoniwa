<?php
namespace hakoniwa\theme\options;

use hakoniwa\theme\init\Define;
use hakoniwa\theme\util\CreateForm;

class Css {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'register_settings' ], 10 );

		// Codemirror 追加
		$get_page = ! empty( $_GET['page'] ) ? htmlspecialchars( $_GET['page'] ) : '';
		$get_action = ! empty( $_GET['action'] ) ? htmlspecialchars( $_GET['action'] ) : '';

		if ( Define::value( 'theme_name' ) . '-options.php' === $get_page && 'css' === $get_action ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'codemirror_enqueue_scripts' ), 10 );
		}

		// インラインで読み込む（フロント）
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_inline_style' ), 100 );

		// インラインで読み込む（管理画面）
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_inline_style' ), 100 );

		// インラインで読み込む（両方）
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_both_admin_inline_style' ), 100 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_both_admin_inline_style' ), 100 );
	}

	/**
	 * Codemirror 追加
	 *
	 * @return void
	 */
	public function codemirror_enqueue_scripts() {
		$cm_settings['codeEditor'] = wp_enqueue_code_editor( array( 'type' => 'text/css' ) );
		wp_localize_script( 'wp-theme-plugin-editor', 'cm_settings', $cm_settings );

		wp_enqueue_script( 'wp-theme-plugin-editor' );
		wp_enqueue_style( 'wp-codemirror' );

		wp_enqueue_script(
			'wp-theme-plugin-script',
			get_template_directory_uri() . '/assets/js/code-mirror.js',
			array( 'wp-theme-plugin-editor' ),
			'1.0.0',
			false
		);
	}

	/**
	 * ページ名
	 */
	public function page_name(){
		return Define::value( 'theme_options_name' ) . '_css';
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
			'css_front_end',
			__( '追加 CSS（フロント画面）', Define::value( 'theme_name' ) ),
			array( $create_form, 'textarea' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'css_front_end',
				'page_name'   => $this->page_name(),
				'description' => 'ここに書いた CSS はフロント画面のみ反映されます。',
				'priority'    => false,
			)
		);

		add_settings_field(
			'css_back_end',
			__( '追加 CSS（管理画面）', Define::value( 'theme_name' ) ),
			array( $create_form, 'textarea' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'css_back_end',
				'page_name'   => $this->page_name(),
				'description' => 'ここに書いた CSS は管理画面のみ反映されます。',
				'priority'    => false,
			)
		);

		add_settings_field(
			'css',
			__( '追加 CSS（両方）', Define::value( 'theme_name' ) ),
			array( $create_form, 'textarea' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'css',
				'page_name'   => $this->page_name(),
				'description' => 'ここに書いた CSS はフロント画面と管理画面の両方に反映されます。',
				'priority'    => false,
			)
		);
	}

	/**
	 * スクリプト読み込み（フロントエンド）
	 *
	 * @return void
	 */
	public function enqueue_inline_style() {
		$options   = get_option( $this->page_name() );

		if ( ! empty( $options['css_front_end'] ) ) {
			$str    = array( "\t", "\r\n", "\r", "\n" );
			$output = str_replace( $str, '', $options['css_front_end'] );

			// インラインで読み込む
			wp_add_inline_style( Define::value( 'theme_name' ) . '-front-end', $output );
		}

	}

	/**
	 * スクリプト読み込み（管理画面）
	 *
	 * @return void
	 */
	public function enqueue_admin_inline_style() {
		$options   = get_option( $this->page_name() );

		if ( ! empty( $options['css_back_end'] ) ) {
			$str    = array( "\t", "\r\n", "\r", "\n" );
			$output = str_replace( $str, '', $options['css_back_end'] );

			// インラインで読み込む
			wp_add_inline_style( 'wp-admin', $output );
		}
	}

	/**
	 * スクリプト読み込み（両方）
	 */
	public function enqueue_both_admin_inline_style() {
		$options   = get_option( $this->page_name() );

		if ( ! empty( $options['css'] ) ) {
			$str    = array( "\t", "\r\n", "\r", "\n" );
			$output = str_replace( $str, '', $options['css'] );

			// インラインで読み込む
			wp_add_inline_style( Define::value( 'theme_name' ) . '-front-end', $output );
			wp_add_inline_style( 'wp-admin', $output );
		}
	}

	/**
	 * 入力値のサニタイズ
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ) {
		$new_input = array();

		// チェックボックス absint
		// テキスト stripslashes

		if ( isset( $input['css_front_end'] ) ) {
			$new_input['css_front_end'] = stripslashes( $input['css_front_end'] );
		}

		if ( isset( $input['css_back_end'] ) ) {
			$new_input['css_back_end'] = stripslashes( $input['css_back_end'] );
		}

		if ( isset( $input['css'] ) ) {
			$new_input['css'] = stripslashes( $input['css'] );
		}

		// wp_die(var_dump($input));
		return $new_input;
	}
}

use toolpack\options;
new Css();

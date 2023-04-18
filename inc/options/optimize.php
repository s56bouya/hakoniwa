<?php
namespace hakoniwa\theme\options;

use hakoniwa\theme\init\Define;
use hakoniwa\theme\util\CreateForm;

class Optimize {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'register_settings' ], 10 );

		// スクリプトを読み込む
		$this->optimize_script();
	}

	/**
	 * ページ名
	 */
	public function page_name(){
		return Define::value( 'theme_options_name' ) . '_optimize';
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
			'front_end_jquery',
			__( 'jQuery（jquery.min.js）', Define::value( 'theme_name' ) ),
			array( $create_form, 'radio_button' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'front_end_jquery',
				'page_name'   => $this->page_name(),
				'description' => '重要：使用しているプラグインによって設定が反映されない場合があります。',
				'script'      => array(
					'default' => '',
					'data'    => array(
						''        => '読み込まない',
						'footer'  => 'フッター付近（ページの最後あたり）で読み込む',
						'enable' => '読み込む',
					),
				),
				'display_key' => false,
			)
		);

		add_settings_field(
			'front_end_css',
			__( 'CSS（front-end.css）', Define::value( 'theme_name' ) ),
			array( $create_form, 'checkbox_multiple' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => 'minify（最小化）してファイル容量を減らす',
				'label'       => 'front_end_css',
				'page_name'   => $this->page_name(),
				'description' => '',
				'script'      => array(
					'data' => array(
						'minify' => 'minify（最小化）してファイル容量を減らす',
					),
				),
				'display_key' => false,
			)
		);

		add_settings_field(
			'front_end_js',
			__( 'JavaScript（front-end.js）', Define::value( 'theme_name' ) ),
			array( $create_form, 'checkbox_multiple' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => 'minify（最小化）してファイル容量を減らす',
				'label'       => 'front_end_js',
				'page_name'   => $this->page_name(),
				'description' => '',
				'script'      => array(
					'data' => array(
						'minify' => 'minify（最小化）してファイル容量を減らす',
					),
				),
				'display_key' => false,
			)
		);

		add_settings_field(
			'front_end_oembed',
			__( 'oembed（wp-embed.min.js）', Define::value( 'theme_name' ) ),
			array( $create_form, 'checkbox_multiple' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '読み込まない',
				'label'       => 'front_end_oembed',
				'page_name'   => $this->page_name(),
				'description' => '',
				'script'      => array(
					'data' => array(
						'disable' => '読み込まない',
					),
				),
				'display_key' => false,
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

		// wp_die(var_dump($input) );

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
	 *
	 * 表示設定チェック
	 */
	public function optimize_script() {
		$options = get_option( $this->page_name() );

		if ( empty( $options ) ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'disable_jquery_frontend' ), 110 );
			return false;
		}

		// Front end CSS
		if ( ! empty( $options['front_end_css'] ) ) {
			if ( ! empty( $options['front_end_css']['minify'] ) ) {
				add_filter( Define::value( 'theme_name' ) . '_enqueue_front_end_css', array( $this, 'front_end_css' ), 100 );
			}
		}

		// Front end jQuery
		if ( isset( $options['front_end_jquery'] ) ) {
			if ( '' === $options['front_end_jquery'] ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'disable_jquery_frontend' ), 100 );
			}

			if ( 'footer' === $options['front_end_jquery'] || ! empty( $options['enable'] ) ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'optimize_scripts' ), 100 );
			}
		}

		// Front end Oembed
		if ( ! empty( $options['front_end_oembed'] ) ) {
			add_action( 'init', array( $this, 'disable_oembed' ), 100 );
			add_action( 'wp_enqueue_scripts', array( $this, 'deregister_oembed' ), 100 );
		}

	}

	/**
	 * フロントエンドの CSS を最小化する
	 *
	 * @param string $url URL
	 * @return $url
	 */
	public function front_end_css( $url ) {
		$url = get_template_directory_uri() . '/assets/css/front-end.min.css';

		return $url;
	}

	/**
	 * フロントエンドの jQuery をオフにする
	 *
	 * @return void
	 */
	public function disable_jquery_frontend() {
		if ( ! is_admin() ) {
			wp_deregister_script( 'jquery' );
		}
	}

	/**
	 * 最適化実行
	 */
	public function optimize_scripts() {
		if ( ! is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', '/wp-includes/js/jquery/jquery.js', array(), '3.6.1', true );

			wp_enqueue_script( 'jquery' );
		}
	}

	/**
	 * フロントエンドの Oembed をオフにする
	 *
	 * @return void
	 */
	public function disable_oembed() {
		remove_action( 'wp_head', 'rest_output_link_wp_head' );

		// Remove the REST API endpoint.
		remove_action( 'rest_api_init', 'wp_oembed_register_route' );

		// Turn off oEmbed auto discovery.
		add_filter( 'embed_oembed_discover', '__return_false' );

		// Don't filter oEmbed results.
		remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

		// Remove oEmbed discovery links.
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

		// Remove oEmbed-specific JavaScript from the front-end and back-end.
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );

		if ( has_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' ) ) {
			add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
		}

		// Remove all embeds rewrite rules.
		if ( has_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' ) ) {
			add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
		}

		// Remove filter of the oEmbed result before any HTTP requests are made.
		remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );

	}

	/**
	 * フロントエンドの Oembed をオフにする
	 *
	 * @return void
	 */
	public function deregister_oembed() {

		wp_dequeue_script( 'wp-embed' );

	}


}

use hakoniwa\theme\options;
new Optimize();

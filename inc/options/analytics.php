<?php
namespace fse\theme\options;

use fse\theme\init\Define;
use fse\theme\util\CreateForm;

class Analytics {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'register_settings' ], 10 );

		add_action( 'wp_footer', [ $this, 'analytics_universal' ], 10 );
	}

	/**
	 * ページ名
	 */
	public function page_name(){
		return Define::value( 'theme_options_name' ) . '_analytics';
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
			'analytics_universal',
			__( 'ユニバーサルアナリティクス', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'analytics_universal',
				'page_name'   => $this->page_name(),
				'description' => 'UA-XXXXXXXX-X の形式で入れてください。',
			)
		);

		add_settings_field(
			'analytics_gtag',
			__( 'Google Analytics 4', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'analytics_gtag',
				'page_name'   => $this->page_name(),
				'description' => 'G-XXXXXXXXXX の形式で gtag を入れてください。',
			)
		);

	}

	/**
	 * 投稿タイプ
	 */
	public function get_all_post_types() {
		$args     = array(
			'public' => true,
		);
		$output   = 'names';
		$operator = 'and';
		$pts      = get_post_types( $args, $output, $operator );

		return $pts;
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

	/**
	 * Google アナリティクス ID（UA）
	 *
	 * @return void
	 */
	public function analytics_universal() {

		$options = get_option( $this->page_name() );

		if ( empty( $options ) ) {
			return false;
		}

		if ( is_admin() ) {
			return false;
		}

		if( ! empty( $options['analytics_universal'] ) ){
			$code = $options['analytics_universal'];

			$output = <<< EOM
				(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
				
				ga('create', '{$code}', 'auto');
				ga('send', 'pageview');
EOM;
			echo '<script>' . wp_kses_post( $output ) . '</script>';
		}

		if( ! empty( $options['analytics_gtag'] ) ){
			$code = $options['analytics_gtag'];

			$output = <<< EOM
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());
				gtag('config', '{$code}');
EOM;
			echo '<!-- Global site tag (gtag.js) - Google Analytics -->';
			echo '<script async src="https://www.googletagmanager.com/gtag/js?id=' . esc_attr( $code ) . '"></script>' . "\n";
			echo '<script>' . wp_kses_post( $output ) . '</script>' . "\n";
		}

	}
}

use fse\theme\options;
new Analytics();

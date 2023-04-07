<?php
namespace hakoniwa\theme\options;

use hakoniwa\theme\init\Define;
use hakoniwa\theme\util\CreateForm;

class Redirect {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'register_settings' ], 10 );

		// リダイレクト
		add_action( 'template_redirect', [ $this, 'redirect' ] );
	}

	/**
	 * ページ名
	 */
	public function page_name(){
		return Define::value( 'theme_options_name' ) . '_redirect';
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
			'page',
			__( 'リダイレクトする', Define::value( 'theme_name' ) ),
			array( $create_form, 'checkbox_multiple' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'page',
				'page_name'   => $this->page_name(),
				'description' => 'リダイレクトしたいページにチェックを入れてください。',
				'script'      => array(
					'data'    => array(
						'404'        => '404 ページ',
						'author'     => '著者のアーカイブページ',
						'search'     => '検索結果ページ',
						'attachment' => '添付ファイルのページ',	
					),
				),
				'display_key' => false,
			)
		);

		add_settings_field(
			'url',
			__( 'リダイレクト先の URL（上級者向け）', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'url',
				'page_name'   => $this->page_name(),
				'placeholder' => esc_url( get_home_url() ),
				'description' => '空欄の場合はホーム URL（' . home_url() . '） にリダイレクトします。安全な URL にリダイレクトするため、外部ドメインは指定できません。よくわからない場合は、空欄のままにしてください。',
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
					$new_input[ $key ] = esc_url( $input[ $key ] );
				}
			}
		}

		return $new_input;
	}

	/**
	 * リダイレクト設定
	 *
	 * @return boolean
	 */
	function redirect() {
		$options = get_option( $this->page_name() );

		if ( empty( $options ) ) {
			return false;
		}

		// Redirect URL
		if ( ! empty( $options['url'] ) ) {
			$redirect_url = $options['url'];
		} else {
			$redirect_url = home_url();
		}

		if ( ! empty( $options['page'][404] ) ) {
			if ( is_404() ) {
				wp_safe_redirect( apply_filters( Define::value( 'theme_name' ) . '_redirect_404', $redirect_url ) );

				exit();
			}
		}

		if ( ! empty( $options['page']['author'] ) ) {
			if ( is_author() ) {
				wp_safe_redirect( apply_filters( Define::value( 'theme_name' ) . '_redirect_author', $redirect_url ) );

				exit();
			}
		}

		if ( ! empty( $options['page']['search'] ) ) {
			if ( is_search() ) {
				wp_safe_redirect( apply_filters( Define::value( 'theme_name' ) . '_redirect_search', $redirect_url ) );

				exit();
			}
		}

		if ( ! empty( $options['page']['attachment'] ) ) {
			if ( is_attachment() ) {
				wp_safe_redirect( apply_filters( Define::value( 'theme_name' ) . '_redirect_attachment', $redirect_url ) );

				exit();
			}
		}
	}
}

use hakoniwa\theme\options;
new Redirect();

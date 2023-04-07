<?php
namespace fse\theme\options;

use fse\theme\init\Define;
use fse\theme\util\CreateForm;

class TopPage {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'register_settings' ], 10 );

		// タイトル変更
		add_filter( 'document_title_parts', [ $this, 'change_top_title' ] );

		// ディスクリプション追加
		add_action( 'wp_head', [ $this, 'change_description' ], 1 );
	}

	/**
	 * ページ名
	 */
	public function page_name(){
		return Define::value( 'theme_options_name' ) . '_top';
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
			'title',
			__( 'タイトル', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'type'        => 'text',
				'title'       => '',
				'label'       => 'title',
				'page_name'   => $this->page_name(),
				'description' => 'トップページのタイトルを変更します。',
			)
		);

		add_settings_field(
			'description',
			__( 'ディスクリプション', Define::value( 'theme_name' ) ),
			array( $create_form, 'textarea' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'type'        => 'textarea',
				'title'       => '',
				'label'       => 'description',
				'page_name'   => $this->page_name(),
				'description' => 'トップページのディスクリプションを変更します。サイトの特徴をわかりやすく書きましょう。',
			)
		);

		add_settings_field(
			'scroll_to_button',
			__( 'ページ上部へ戻るボタン', Define::value( 'theme_name' ) ),
			array( $create_form, 'checkbox_multiple' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'scroll_to_button',
				'page_name'   => $this->page_name(),
				'description' => '',
				'script'      => array(
					'data'    => array(
						'desktop'		=> 'デスクトップで表示',
						'tablet'		=> 'タブレットで表示',
						'smartphone'	=> 'スマートフォンで表示',
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

		// wp_die(var_dump($new_input));
		return $new_input;
	}

	/**
	 * トップページのタイトル変更
	 */
	function change_top_title( $title ) {
		$options = get_option( $this->page_name() );
		if ( ! empty( $options['title'] ) && ( is_home() || is_front_page() ) ) {
			$title['title']   = $options['title'];
			$title['site']    = '';
			$title['tagline'] = '';
		}

		return $title;
	}

	/**
	 * ディスクリプション変更
	 */
	function change_description() {
		$content = '';

		if ( is_home() || is_front_page() ) {
			$options = get_option( $this->page_name() );
			if ( ! empty( $options['description'] ) ) {
				$content = esc_attr( $options['description'] );
			} else {
				$content = esc_attr( get_bloginfo( 'description' ) );
			}
		}

		if ( is_singular() && ! is_front_page() ) {
			global $post;
			setup_postdata( $post );

			if ( ! empty( get_the_excerpt() ) ) {
				$content = esc_attr( get_the_excerpt() );
			}

			wp_reset_postdata();
		}

		// Archive
		if ( is_category() || is_tag() || is_tax() ) {
			if ( ! empty( term_description() ) ) {
				$content = str_replace( PHP_EOL, '', wp_strip_all_tags( term_description() ) );
			}
		}

		if ( ! empty( $content ) ) {
			echo '<meta name="description" content="' . $content . '">' . "\n"; // phpcs:ignore
		}

	}

}

use fse\theme\options;
new TopPage();

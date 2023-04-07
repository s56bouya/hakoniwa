<?php
namespace hakoniwa\theme\options;

use hakoniwa\theme\init\Define;
use hakoniwa\theme\util\CreateForm;

class Script {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'register_settings' ], 10 );

		$this->script();
	}

	/**
	 * ページ名
	 */
	public function page_name(){
		return Define::value( 'theme_options_name' ) . '_script';
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
			'enable',
			__( '出力を有効にする', Define::value( 'theme_name' ) ),
			array( $create_form, 'checkbox' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '有効化',
				'label'       => 'enable',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'header',
			__( 'ヘッダーにスクリプトを追加', Define::value( 'theme_name' ) ),
			array( $create_form, 'textarea' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'header',
				'page_name'   => $this->page_name(),
				'description' => '出力の優先順位（デフォルト：10）1 〜 999 の範囲で設定。数字が小さいほど実行の優先度が高いです',
				'priority'    => true,
			)
		);

		add_settings_field(
			'body_open',
			__( '&lt;body&gt;タグの直後にスクリプトを追加', Define::value( 'theme_name' ) ),
			array( $create_form, 'textarea' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'body_open',
				'page_name'   => $this->page_name(),
				'description' => '出力の優先順位（デフォルト：10）1 〜 999 の範囲で設定。数字が小さいほど実行の優先度が高いです',
				'priority'    => true,
			)
		);

		add_settings_field(
			'footer',
			__( 'フッターにスクリプトを追加', Define::value( 'theme_name' ) ),
			array( $create_form, 'textarea' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'footer',
				'page_name'   => $this->page_name(),
				'description' => '出力の優先順位（デフォルト：10）1 〜 999 の範囲で設定。数字が小さいほど実行の優先度が高いです',
				'priority'    => true,
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

		// サニタイズの汎用化

		// 配列かどうか
		// 値が整数ならabsint、テキストなら
		// チェックボックス absint
		// テキスト stripslashes

		foreach( $input as $key => $val ){
			//$new_input[$key] = $val;
			//wp_die(var_dump($new_input));

			switch( gettype( $val ) ){
				case 'string':
					$new_input[$key] = stripslashes( $val );
					break;
				case 'integer':
					$new_input[$key] = absint( $val );
					break;
			}
		}

		//wp_die(var_dump($new_input));
		return $new_input;
	}

	/**
	 * スクリプト出力
	 *
	 * @param string $page_name ページ名
	 * @return void
	 */
	public function script() {
		$options = get_option( $this->page_name() );

		if ( ! empty( $options ) && ! empty( $options['enable'] ) ) {
			if ( ! empty( $options['header'] ) ) {
				add_action(
					'wp_head',
					function() use ( $options ) {
						echo $options['header'];
					},
					$options['header_priority']
				);
			}

			if ( ! empty( $options['body_open'] ) ) {
				add_action(
					'wp_body_open',
					function() use ( $options ) {
						echo $options['body_open'];
					},
					$options['body_open_priority']
				);
			}

			if ( ! empty( $options['footer'] ) ) {
				add_action(
					'wp_footer',
					function() use ( $options ) {
						echo $options['footer'];
					},
					$options['footer_priority']
				);
			}
		}
	}

}

use hakoniwa\theme\options;
new Script();

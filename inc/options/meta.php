<?php
namespace hakoniwa\theme\options;

use hakoniwa\theme\util\Functions;

use hakoniwa\theme\init\Define;
use hakoniwa\theme\util\CreateForm;

use hakoniwa\theme\util\OGP;
use hakoniwa\theme\util\TwitterCard;
use hakoniwa\theme\util\Facebook;

class Meta {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'register_settings' ], 10 );

		// ヘッダーに出力		
		add_action( 'wp_head', [ $this, 'create_meta' ], 1 );
	}

	/**
	 * ページ名
	 */
	public function page_name(){
		return Define::value( 'theme_options_name' ) . '_meta';
	}

	/**
	 * フォーム追加
	 */
	public function register_settings() {
		$create_form = new CreateForm;

//		delete_option( $this->page_name() );

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
			'active',
			__( '出力する meta 情報にチェック', Define::value( 'theme_name' ) ),
			array( $create_form, 'checkbox_multiple' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'active',
				'page_name'   => $this->page_name(),
				'description' => '',
				'script'      => array(
					'default' => array( 'ogp' => 1 ),
					'data' => array(
						'ogp'      => 'OGP共通',
						'twitter'  => 'Twitter Cards',
						'facebook' => 'Facebook',	
					),
				),
				'display_key' => false,
			)
		);
		
		add_settings_field(
			'twitter_card_type',
			__( 'Twitter:card（カードタイプ）', Define::value( 'theme_name' ) ),
			array( $create_form, 'radio_button' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'twitter_card_type',
				'page_name'   => $this->page_name(),
				'description' => '',
				'script'      => array(
					'default' => 'summary_large_image',
					'data'    => array(
						'summary_large_image'	=> 'summary_large_image',
						'summary'				=> 'summary',
					),
				),
				'display_key' => false,
			)
		);

		add_settings_field(
			'twitter_card_site',
			__( 'Twitter:site（ウェブサイトのTwitter ID）', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'twitter_card_site',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'facebook_app_id',
			__( 'Facebook:app_id', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'facebook_app_id',
				'page_name'   => $this->page_name(),
				'description' => 'FacebookアプリのID（取得方法：https://developers.facebook.com/docs/apps/register?locale=ja_JP）',
			)
		);

		add_settings_field(
			'facebook_article_publisher',
			__( 'Facebook:article publisher', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'facebook_article_publisher',
				'page_name'   => $this->page_name(),
				'description' => 'FacebookページのURL',
			)
		);

		add_settings_field(
			'og_image',
			__( 'og:image', Define::value( 'theme_name' ) ),
			array( $create_form, 'imageUpload' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'og_image',
				'page_name'   => $this->page_name(),
				'description' => 'アイキャッチ画像が設定されていない場合の画像を指定します。推奨：1200×630px以上　最低：600×315px　※200×200px以上の画像を設定しないとFacebookでエラーになります。　画像の最大サイズ8MBまで',
			)
		);

	}

	/**
	 * 入力値のサニタイズ
	 *
	 * @param array $input 入力値
	 * @return $new_input
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

//		wp_die( var_dump($input) );

		return $new_input;
	}

	/**
	 * Meta 作成
	 *
	 */
	public function create_meta() {

		$options = get_option( $this->page_name() );

		OGP::create( $this->page_name() );
		TwitterCard::create( $this->page_name() );
		Facebook::create( $this->page_name() );

	}

}

use hakoniwa\theme\options;
new Meta();

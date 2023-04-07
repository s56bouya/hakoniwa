<?php
namespace hakoniwa\theme\options;

use hakoniwa\theme\util\Functions;

use hakoniwa\theme\init\Define;
use hakoniwa\theme\util\CreateForm;

use hakoniwa\theme\util\Schema;

class Schemaorg {

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
		return Define::value( 'theme_options_name' ) . '_schema_org';
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
			'post_type',
			__( '表示する投稿タイプ', Define::value( 'theme_name' ) ),
			array( $create_form, 'checkbox_multiple' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'post_type',
				'page_name'   => $this->page_name(),
				'description' => '',
				'script'      => array(
					'data' => Functions::get_all_post_types(),
				),
				'display_key' => false,
			)
		);

		add_settings_field(
			'display_info',
			__( '表示する情報', Define::value( 'theme_name' ) ),
			array( $create_form, 'checkbox_multiple' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '出力する',
				'label'       => 'display_info',
				'page_name'   => $this->page_name(),
				'description' => '',
				'script'      => array(
					'data' => array(
						'website' => 'ウェブサイトの情報',
						'website_type' => 'ウェブサイトのタイプ（組織/個人）',
						'search' => '検索',
						'address' => '所在地',
						'contactpoint' => '連絡先',
					),
				),
				'display_key' => false,
			)
		);

		add_settings_field(
			'twitter',
			__( 'Twitter', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'twitter',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'facebook',
			__( 'Facebook', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'facebook',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'instagram',
			__( 'Instagram', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'instagram',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'youtube',
			__( 'YouTube', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'youtube',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'pinterest',
			__( 'Pinterest', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'pinterest',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'default_image',
			__( 'デフォルト画像', Define::value( 'theme_name' ) ),
			array( $create_form, 'imageUpload' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'default_image',
				'page_name'   => $this->page_name(),
				'description' => 'ページにアイキャッチ画像が設定されていない場合の画像を指定します',
			)
		);

		add_settings_field(
			'article_logo_image',
			__( 'ロゴ画像（記事用）', Define::value( 'theme_name' ) ),
			array( $create_form, 'imageUpload' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'article_logo_image',
				'page_name'   => $this->page_name(),
				'description' => '横幅600×縦幅60px（推奨）',
			)
		);

		add_settings_field(
			'page_type',
			__( '投稿するページのタイプ', Define::value( 'theme_name' ) ),
			array( $create_form, 'selectbox' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'page_type',
				'page_name'   => $this->page_name(),
				'description' => '',
				'script'      => array(
					'default' => 'BlogPosting',
					'data'    => array(
						'BlogPosting' => __( 'ブログなど（BlogPosting）', Define::value( 'theme_name' ) ),
						'NewsArticle' => __( 'ニュース記事など（NewsArticle）', Define::value( 'theme_name' ) ),
					),
				),
				'display_key' => false,
			)
		);

		add_settings_field(
			'website_type',
			__( 'ウェブサイトのタイプ', Define::value( 'theme_name' ) ),
			array( $create_form, 'selectbox' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'website_type',
				'page_name'   => $this->page_name(),
				'description' => '',
				'script'      => array(
					'default' => '',
					'data'    => array(
						''             => __( '未設定', Define::value( 'theme_name' ) ),
						'Organization' => __( '法人など組織のウェブサイト（Organization）', Define::value( 'theme_name' ) ),
						'Person'       => __( '個人のウェブサイト（Person）', Define::value( 'theme_name' ) ),
					),
				),
				'display_key' => false,
			)
		);

		add_settings_field(
			'person_name',
			__( '個人名', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'person_name',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'organization_name',
			__( '組織名', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'organization_name',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'organization_logo_image',
			__( 'ロゴ画像（組織用）', Define::value( 'theme_name' ) ),
			array( $create_form, 'imageUpload' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'organization_logo_image',
				'page_name'   => $this->page_name(),
				'description' => '横幅112×縦幅112px 以上',
			)
		);

		add_settings_field(
			'address_postalcode',
			__( '郵便番号', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'address_postalcode',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'address_addressregion',
			__( '都道府県名', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'address_addressregion',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'address_addresslocality',
			__( '市区町村名', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'address_addresslocality',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'address_streetaddress',
			__( '住所（番地・アパート名なども含める）', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'address_streetaddress',
				'page_name'   => $this->page_name(),
				'description' => '',
			)
		);

		add_settings_field(
			'contactpoint_telephone',
			__( '連絡先（電話番号）', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'contactpoint_telephone',
				'page_name'   => $this->page_name(),
				'description' => '国番号＋電話番号（例：+81(111)222-3333 または +81-111-222-3333 または +81-1112223333）',
			)
		);

		add_settings_field(
			'contactpoint_contacttype',
			__( '連絡先の窓口', Define::value( 'theme_name' ) ),
			array( $create_form, 'selectbox' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'contactpoint_contacttype',
				'page_name'   => $this->page_name(),
				'description' => '',
				'script'      => array(
					'default' => '',
					'data'    => array(
						''                    => __( '未設定', Define::value( 'theme_name' ) ),
						'customer service'    => __( 'カスタマーサービス（customer service）', Define::value( 'theme_name' ) ),
						'technical support'   => __( 'テクニカルサポート（technical support）', Define::value( 'theme_name' ) ),
						'billing support'     => __( '支払いや請求に関するサポート（billing support）', Define::value( 'theme_name' ) ),
						'bill payment'        => __( '支払い先（bill payment）', Define::value( 'theme_name' ) ),
						'sales'               => __( '販売（sales）', Define::value( 'theme_name' ) ),
						'reservations'        => __( '予約（reservations）', Define::value( 'theme_name' ) ),
						'credit card_support' => __( 'クレジットカードサポート（credit card_support）', Define::value( 'theme_name' ) ),
						'emergency'           => __( '緊急連絡先（emergency）', Define::value( 'theme_name' ) ),
						'baggage tracking'    => __( '空港などで預ける複数の荷物などの問い合わせ（baggage tracking）', Define::value( 'theme_name' ) ),
						'roadside assistance' => __( '自動車けん引などのサービス（roadside assistance）', Define::value( 'theme_name' ) ),
						'package tracking'    => __( '宅配便など小包の問い合わせ（package tracking）', Define::value( 'theme_name' ) ),
					),
				),
				'display_key' => false,
			)
		);

		add_settings_field(
			'contactpoint_contactoption',
			__( '連絡先オプション', Define::value( 'theme_name' ) ),
			array( $create_form, 'selectbox' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'contactpoint_contactoption',
				'page_name'   => $this->page_name(),
				'description' => '',
				'script'      => array(
					'default' => '',
					'data'    => array(
						''                         => __( '未設定', Define::value( 'theme_name' ) ),
						'TollFree'                 => __( 'フリーダイアル（TollFree）', Define::value( 'theme_name' ) ),
						'HearingImpairedSupported' => __( '聴覚に障害のある方対応（HearingImpairedSupported）', Define::value( 'theme_name' ) ),
					),
				),
				'display_key' => false,
			)
		);

		add_settings_field(
			'contactpoint_areaserved',
			__( 'サービス対応エリア', Define::value( 'theme_name' ) ),
			array( $create_form, 'text' ),
			$this->page_name(),
			$this->page_name(),
			array(
				'title'       => '',
				'label'       => 'contactpoint_areaserved',
				'page_name'   => $this->page_name(),
				'description' => '国コード（例：JP,US など）',
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

	/**
	 * JSON-LD 作成
	 *
	 */
	public function create_meta() {

		$options = get_option( $this->page_name() );

		Schema::create( $this->page_name() );

	}
}

use hakoniwa\theme\options;
new Schemaorg();

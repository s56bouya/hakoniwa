<?php
namespace hakoniwa\theme\init;

use hakoniwa\theme\init\Define;
use hakoniwa\theme\util\CreateForm;
use hakoniwa\theme\util\Auth;

class ThemeAbout {

	/**
	 * メニュータイトル
	 *
	 * @var string
	 */
	public $menu_title = '';

	/**
	 * Construct
	 */
	public function __construct() {

		add_action( 'admin_menu', array( $this, 'about_page' ) );
		add_action( 'after_switch_theme', array( $this, 'switch_theme' ) );

		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'register_settings' ], 10 );

		if( true === Define::value( 'network_active' ) ){
			
			// Check License
			add_action( 'admin_notices', [ $this, 'check_license' ], 10 );

		}

	}

	/**
	 * ページ名
	 */
	public function page_name(){
		return 'theme_about';
	}

	/**
	 * Active Theme Notice
	 */
	public function about_page_notice() {

		$theme_data = wp_get_theme( Define::value( 'theme_name' ) );

		/* translators: %1$s: theme name %2$s: about page url */
		$message = sprintf( wp_kses( __( 'Welcome and thanks for choosing %1$s theme. Please visit our <a href="%2$s">about page</a>.', Define::value( 'theme_name' ) ), array( 'a' => array( 'href' => array() ) ) ), esc_attr( $theme_data->name ), esc_url( admin_url( 'themes.php?page=about' ) ) );
		printf( '<div class="updated notice notice-success notice-alt is-dismissible"><p>%s</p></div>', wp_kses_post( $message ) );

	}

	/**
	 * Switch Theme
	 */
	public function switch_theme() {

		add_action( 'admin_notices', array( $this, 'about_page_notice' ) );

	}

	/**
	 * Add Theme Page
	 */
	public function about_page() {

		$this->menu_title = __( 'テーマについて', Define::value( 'theme_name' ) );

		add_theme_page(
			$this->menu_title,
			$this->menu_title,
			'edit_theme_options',
			'about',
			array( $this, 'theme_info_page' )
		);

	}

	/**
	 * Tab Array
	 */
	public function tab_array() {
		$tab_array = array(
			'welcome'  => __( 'About Theme', Define::value( 'theme_name' ) ),
			'iconfont' => __( 'Use Icon', Define::value( 'theme_name' ) ),
		);

		return $tab_array;
	}

	/**
	 * Theme Page Info
	 */
	public function theme_info_page() {
		$theme_data = wp_get_theme( Define::value( 'theme_name' ) );
		$theme_name = $theme_data->name;
		?>
			<style>
				.about-wrap .dashicons-admin-network{
					display: flex;
					align-items:center;
				}
				.about-wrap .dashicons-admin-network::before{
					vertical-align:middle;
					margin-right:0.5rem;
				}
				.about-wrap .dashicons-admin-network.active input{
					background:#99e0aa;
				}
				.about-wrap .dashicons-admin-network.active::before{
					color:#61ad73;
				}
				.about-wrap .dashicons-admin-network.deactive input{
					background:#e9c972;
				}
				.about-wrap .dashicons-admin-network.deactive::before{
					color:#dba616;
				}
			</style>
			<div class="wrap about-wrap">
				<h1><?php printf( esc_html__( 'Welcome to %1s - Version %2s', Define::value( 'theme_name' ) ), esc_html( $theme_data->name ), esc_html( $theme_data->version ) ); ?></h1>
				<div class="about-text"><?php echo esc_html( $theme_name ); ?> は、ウェブサイトのあらゆる場所でブロックが使用可能な、運営に必要な機能が豊富に搭載されたブロックテーマです。</div>

				<?php if( true === Define::value( 'network_active' ) ){ ?>
				<hr>
				<h3 id="siteurl">ライセンス</h3>
				<p>公式サイトでライセンスを購入し、サイトアドレス (URL)<input tyle="text" value="<?php echo esc_url( get_option( 'home' ) ); ?>" onclick="copySiteUrl( this )" style="border:none; background:#fff; margin:0 0.2rem; padding:0.2rem 0.5rem; width:100%; max-width:240px;" readonly><span id="copied_message"></span>を入力してライセンスキーを発行してください。ライセンス認証された製品は「新機能の追加」「セキュリティアップデート」のサービスが利用可能です。</p>
				<script>
					function copySiteUrl(e) {
						const checkContent = document.getElementById( 'site-url-copied' );
						if( !! checkContent ){
							checkContent.remove();
						}

						e.select();
						navigator.clipboard.writeText( e.value );

						const newContent = document.createElement( 'span' );

						newContent.classList.add( 'copied' );
						newContent.setAttribute( 'id', 'site-url-copied' );
						newContent.style.display = 'inline';
						newContent.style.backgroundColor = '#fefefe';
						newContent.style.padding = '0.2rem 0.5rem';
						newContent.style.margin = '0 0.5rem';

						const newText = document.createTextNode( 'URL をコピーしました' );

						newContent.appendChild( newText );

						const currentDiv = document.getElementById( 'siteurl' );
						currentDiv.appendChild( newContent );

						setTimeout( function() {
							newContent.remove();
						}, 2000 );							
					}
				</script>
				<div class="flex">
					<div class="flex-1">
						<form method="post" action="options.php">
							<?php 
								settings_fields( $this->page_name() );
								do_settings_sections( $this->page_name() );

								do_action( Define::value( 'theme_name' ) . '_theme_about_after' );

								submit_button();
							?>
						</form>
					</div>
				</div>
				<p>【認証できない場合】<br>
				サブスクリプション版:サブスクリプションを更新し、ライセンスキーの有効期限を延長してください。<br>
				買い切り版:正しい URL でライセンスキーを発行しているかどうか確認してください。
				</p>
				<?php } ?>
			</div>
		<?php
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

		if( true === Define::value( 'network_active' ) ){

			add_settings_field(
				Define::value( 'theme_name' ) . '_license_key',
				__( 'テーマ', Define::value( 'theme_name' ) ),
				array( $create_form, 'license' ),
				$this->page_name(),
				$this->page_name(),
				array(
					'title'       	=> '',
					'label'       	=> Define::value( 'theme_name' ) . '_license_key',
					'option_name'	=> Define::value( 'theme_name' ),
					'page_name'   	=> $this->page_name(),
					'product_id'	=> Define::value( 'product_id' ),
				)
			);
	
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
		// 配列 array_map
		
//		wp_die(var_dump($input));

		// 認証したキーのみ保存
		foreach( $input as $key => $val ){

			if( isset( $val ) ){

				$remote_response = new Auth();

				$args = array(
					'url'	=> get_option( 'home' ),
					'key'	=> $val, // 入力されたキー
				);
	
				$response = $remote_response->remote_check( $args );

				// データが存在
				if ( $response ) {

					//期限切れの場合 expire_date が返される
					if( isset( $response['expire_date'] ) ){
						continue;
					}

					$args = [
						'status' => 1,
						'data' => $response,
					];

					update_option( $key . '_activate', $args );
					$new_input[$key] = sanitize_text_field( $val ); // キーを保存

				}
			}

		}

		// wp_die(var_dump($new_input));
		return $new_input;
	}

	/**
	 * スケジュール追加
	 */
	public function check_license(){

		// 一日1回認証チェックする
		delete_transient( Define::value( 'theme_name' ) . '_check_license' );
        $remote = get_transient( Define::value( 'theme_name' ) . '_check_license' );

		if( false === $remote ) {

			// オプション取得
			$option			= get_option( 'theme_about' );

			$license_key    = isset( $option[Define::value( 'theme_name' ) . '_license_key'] ) ? $option[Define::value( 'theme_name' ) . '_license_key'] : '';

			// 認証
			$remote_response = new Auth();

			$args = array(
				'url'	=> get_option( 'home' ),
				'key'	=> $license_key,
			);

			$response = $remote_response->remote_check( $args );

			//set_transient( Define::value( 'theme_name' ) . '_check_license', $response, DAY_IN_SECONDS );

		}

		// レスポンスの内容で処理を変える
		if( $response == false ){

			// アクティベートをfalseにする
			$args = [
				'status' => false,
				'data' => $response,
			];

			update_option( Define::value( 'theme_name' ) . '_activate', $args );

		} elseif( isset( $response['active'] ) && $response['active'] == true ){

			// アクティベートをtrueにする
			$args = [
				'status' => true,
				'data' => $response,
			];

			// 製品 ID が合っていればデータを更新
			if( Define::value( 'product_id' ) !== $response['product_id'] ){

				// アクティベートをfalseにする
				$args = [
					'status' => false,
					'data' => $response,
				];

			}

			update_option( Define::value( 'theme_name' ) . '_activate', $args );

		}

		$activate_option = get_option( Define::value( 'theme_name' ) . '_activate' );

		// ステータスによって表示内容を変える
		if( empty( $activate_option[ 'status' ] ) | false == $activate_option[ 'status' ] ){
			$message = Define::value( 'theme_name' ) . ':ライセンス認証されていません。ライセンスを認証すると「新機能の追加」「セキュリティアップデート」のサービスが利用可能です。';
		}

		if( ! empty( $message ) ){
			$this->notice_create_license( $message );
		}
		
	}

	/**
	 * メッセージ表示
	 */
	public function notice_create_license( $message ){

		$create_date = date_i18n("Y-n-j H:i:s");
		$message .= '最終チェック：' . $create_date;

		echo '<div class="update-nag notice notice-warning inline">' . $message . '</div>';

	}

}

use hakoniwa\theme\init;
new ThemeAbout();

<?php
namespace fse\theme\options;

use fse\theme\init\Define;

class Menu {

	/**
	 * Constructor.
	 */
	public function __construct() {
		// オプションページ追加フック
		add_action( 'admin_menu', [ $this, 'admin_menu' ], 10 );
	}
	
	/**
	 * メニュー追加
	 */
	public function admin_menu() {
		add_menu_page(
			'Options',
			'Options',
			'manage_options',
			Define::value( 'theme_name' ) . '-options.php',
			[ $this, 'create_page' ],
			'dashicons-admin-generic'
		);
	}

	/**
	 * 表示するタブ
	 *
	 * @var array
	 */
	public $tab_array = array(
		'general'         	=> '基本設定',
		'top'         		=> 'トップページ',
		'analytics'         => 'アクセス解析',
		'script'      		=> 'スクリプト追加',
		'optimize'    		=> 'テーマ最適化',
//		'infeed_ads'  		=> 'インフィード広告',
		'meta'        		=> 'meta 情報',
		'schema_org'        => 'Schema.org',
		'redirect'    		=> 'リダイレクト',
		'login'         	=> 'ログインページ',
		'css'         		=> 'CSS 追加',
	);

	/**
	 * タブ出力
	 */
	public function create_tab() {
		$admin_url  = 'admin.php?page=' . Define::value( 'theme_name' ) . '-options.php';
		$flag       = false;
		$tab_array  = $this->tab_array;
		$get_action = ! empty( $_GET['action'] ) ? htmlspecialchars( $_GET['action'] ) : '';

		echo '<div class="menu-wrapper flex flex-col mr-4 self-baseline sticky top-8">';
		foreach ( $tab_array as $key => $val ) {
			$active = '';
			if ( ! isset( $get_action ) && false === $flag ) {
				$active = ' active';
				$flag   = 1;
			} elseif ( isset( $get_action ) && $key === $get_action && false === $flag ) {
				$active = ' active';
			}
			echo '<a href="' . esc_url(
				add_query_arg(
					array(
						'action' => $key,
					),
					$admin_url
				)
			) . '" class="menu' . esc_attr( $active ) . '">' . esc_html( $val ) . '</a>';
		}

		echo '</div>';
	}

	/**
	 * 設定画面出力
	 */
	public function create_setting() {
		$tab_array  = $this->tab_array;
		$flag       = false;
		$get_action = ! empty( $_GET['action'] ) ? htmlspecialchars( $_GET['action'] ) : '';

		foreach ( $tab_array as $key => $val ) {
			if ( ! isset( $get_action ) && false === $flag ) {
				$flag = true;
			} elseif ( isset( $get_action ) && $key === $get_action && false === $flag ) {
				$flag = true;
			}

			if ( true === $flag ) {
				settings_fields( Define::value( 'theme_options_name' ) . '_' . $key );
				do_settings_sections( Define::value( 'theme_options_name' ) . '_' . $key );

				submit_button();

				break;
			}
		}
	}

	/**
	 * オプションページの内容
	 */
	public function create_page() {
		$this->options = get_option( Define::value( 'theme_options_name' ) );
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'このページを表示する権限がありません。' );
		}
		?>
			<div class="wrap">
				<h1>設定</h1>
					<div class="flex">
						<?php $this->create_tab(); ?>
						<div class="flex-1">
							<form method="post" action="options.php">
								<?php $this->create_setting(); ?>
							</form>
						</div>
					</div>
			</div>
		<?php
	}
}

use fse\theme\options;
new Menu();

<?php
namespace hakoniwa\theme\init;

use hakoniwa\theme\init\Define;

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
				<hr>
				<?php
					do_action( Define::value( 'theme_name' ) . '_theme_about_before' );
					do_action( Define::value( 'theme_name' ) . '_theme_about_content' );
					do_action( Define::value( 'theme_name' ) . '_theme_about_after' );
				?>
			</div>
		<?php
	}

}

use hakoniwa\theme\init;
new ThemeAbout();

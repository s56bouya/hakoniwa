<?php
namespace hakoniwa\theme\init;

use hakoniwa\theme\init\Define;

class ThemeAbout {

	/**
	 * Menu Title
	 *
	 * @var string
	 */
	public $menu_title = '';

	/**
	 * Construct
	 */
	public function __construct() {

		add_action( 'admin_menu', [ $this, 'about_page' ] );
		
		add_action( 'after_switch_theme', [ $this, 'switch_theme' ] );

	}

	/**
	 * Page Name
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
		$message = sprintf( __( 'Welcome and thanks for choosing %1$s theme.', 'hakoniwa' ), esc_attr( $theme_data->name ) );
		printf( '<div class="updated notice notice-success notice-alt is-dismissible"><p>%s</p><p><a class="button button-primary" href="https://hakoniwa.animagate.com/" target="_blank">' . __( 'Theme support page', 'hakoniwa' ) . '</a></p></div>', wp_kses_post( $message ) );

	}

	/**
	 * Switch Theme
	 */
	public function switch_theme() {

		add_action( 'admin_notices', [ $this, 'about_page_notice' ] );

	}

	/**
	 * Add Theme Page
	 */
	public function about_page() {

		$this->menu_title = __( 'About Theme', 'hakoniwa' );

		add_theme_page(
			$this->menu_title,
			$this->menu_title,
			'edit_theme_options',
			'about',
			[ $this, 'theme_info_page' ]
		);

	}

	/**
	 * Theme Page Info
	 */
	public function theme_info_page() {

		$theme_data = wp_get_theme( Define::value( 'theme_name' ) );
		$theme_name = $theme_data->name;
		$message    = sprintf( __( '%1$s is a block theme that allows you to use blocks anywhere on your website.', 'hakoniwa' ), 'Hakoniwa' );

		do_action( Define::value( 'theme_name' ) . '_theme_about_wrapper_before' );
		?>
			<div class="wrap about-wrap">
				<h1><?php printf( esc_html__( 'Welcome to %1$1s - Version %2$2s', 'hakoniwa' ), esc_html( $theme_name ), esc_html( $theme_data->version ) ); ?></h1>
				<div class="about-text"><?php echo wp_kses_post( $message ); ?></div>
				<hr>
				<?php
				do_action( Define::value( 'theme_name' ) . '_theme_about_before' );
				do_action( Define::value( 'theme_name' ) . '_theme_about_content' );
				do_action( Define::value( 'theme_name' ) . '_theme_about_after' );
				?>
			</div>
		<?php
		do_action( Define::value( 'theme_name' ) . '_theme_about_wrapper_after' );
		
	}

}

use hakoniwa\theme\init;
new ThemeAbout();

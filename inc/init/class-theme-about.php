<?php
namespace hakoniwa\theme\init;

use hakoniwa\theme\init\Define;
use hakoniwa\theme\util\Functions;

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
		$message = sprintf( __( 'Welcome and thanks for choosing %1$s theme. See the support page for tips on how to get the most out of the theme.', 'hakoniwa' ), esc_attr( $theme_data->name ) );
		printf( '<div class="updated notice notice-alt is-dismissible hakoniwa-notice"><p>%s</p><p><a class="button button-primary" href="' . admin_url( 'themes.php?page=about' ) . '">' . __( 'Theme support page', 'hakoniwa' ) . '</a></p></div>', wp_kses_post( $message ) );

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
			<div class="hakoniwa-about-wrap">
				<div class="cols">
					<div class="left-col">
						<div class="about-main-visual">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hakoniwa-logo.svg' ); ?>" alt="Hakoniwa">
							<h1><?php printf( esc_html__( 'Welcome to %1$1s - Version %2$2s', 'hakoniwa' ), esc_html( $theme_name ), esc_html( $theme_data->version ) ); ?></h1>
							<div class="description"><?php echo wp_kses_post( $message ); ?></div>
						</div>
						<h2 class="main-title"><?php _e( 'Plugins: Maximize the potential of your theme', 'hakoniwa' ); ?></h2>
						<div class="cards">
							<div class="hakoniwa-about-card hakoniwa-blocks">
								<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-blocks"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 4a1 1 0 0 1 1 -1h5a1 1 0 0 1 1 1v5a1 1 0 0 1 -1 1h-5a1 1 0 0 1 -1 -1z" /><path d="M3 14h12a2 2 0 0 1 2 2v3a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h3a2 2 0 0 1 2 2v12" /></svg>
								<h3 class="card-title">Hakoniwa Blocks</h3>
								<p class="card-description"><?php _e( '20+ high-quality, powerful blocks', 'hakoniwa' ); ?></p>
								<?php
								if( is_plugin_active( 'hakoniwa-blocks/index.php' ) ){
								?>
								<p class="installed"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg><?php _e( 'installed', 'hakoniwa' ); ?></p>
								<?php
								} else {							
								?>
								<p><a class="button button-primary" href="https://hakoniwa.animagate.com/product/plugin-blocks" target="_blank"><?php _e( 'Install Plugin', 'hakoniwa' ); ?></a></p>
								<?php
								}
								?>
							</div>
							<div class="hakoniwa-about-card hakoniwa-tools">
								<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-tool"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10h3v-3l-3.5 -3.5a6 6 0 0 1 8 8l6 6a2 2 0 0 1 -3 3l-6 -6a6 6 0 0 1 -8 -8l3.5 3.5" /></svg>
								<h3 class="card-title">Hakoniwa Tools</h3>
								<p class="card-description"><?php _e( 'All-in-one plugins” with all the functions you need to run your website', 'hakoniwa' ); ?></p>
								<?php
								if( is_plugin_active( 'hakoniwa-tools/index.php' ) ){
								?>
								<p class="installed"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg><?php _e( 'installed', 'hakoniwa' ); ?></p>
								<?php
								} else {							
								?>
								<p><a class="button button-primary" href="https://hakoniwa.animagate.com/product/plugin-tools" target="_blank"><?php _e( 'Install Plugin', 'hakoniwa' ); ?></a></p>
								<?php
								}
								?>
							</div>
						</div>
						<h2 class="main-title"><?php _e( 'Why Choose Hakoniwa?', 'hakoniwa' ); ?></h2>
						<div class="cards">
							<div class="hakoniwa-about-card">
								<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-palette"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 21a9 9 0 0 1 0 -18c4.97 0 9 3.582 9 8c0 1.06 -.474 2.078 -1.318 2.828c-.844 .75 -1.989 1.172 -3.182 1.172h-2.5a2 2 0 0 0 -1 3.75a1.3 1.3 0 0 1 -1 2.25" /><path d="M8.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12.5 7.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M16.5 10.5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
								<h3 class="card-title"><?php _e( 'Simple and modern design', 'hakoniwa' ); ?></h3>
							</div>							
							<div class="hakoniwa-about-card">
								<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-heart-handshake"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /><path d="M12 6l-3.293 3.293a1 1 0 0 0 0 1.414l.543 .543c.69 .69 1.81 .69 2.5 0l1 -1a3.182 3.182 0 0 1 4.5 0l2.25 2.25" /><path d="M12.5 15.5l2 2" /><path d="M15 13l2 2" /></svg>
								<h3 class="card-title"><?php _e( 'Mobile Friendly', 'hakoniwa' ); ?></h3>
							</div>
							<div class="hakoniwa-about-card">
								<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-speedtest"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5.636 19.364a9 9 0 1 1 12.728 0" /><path d="M16 9l-4 4" /></svg>
								<h3 class="card-title"><?php _e( 'Fast page speed', 'hakoniwa' ); ?></h3>
							</div>
							<div class="hakoniwa-about-card">
								<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-seo"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 8h-3a1 1 0 0 0 -1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-3" /><path d="M14 16h-4v-8h4" /><path d="M11 12h2" /><path d="M17 8m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /></svg>
								<h3 class="card-title"><?php _e( 'SEO Ready', 'hakoniwa' ); ?></h3>
							</div>
							<div class="hakoniwa-about-card">
								<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-cog"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path d="M13.5 6.5l4 4" /><path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19.001 15.5v1.5" /><path d="M19.001 21v1.5" /><path d="M22.032 17.25l-1.299 .75" /><path d="M17.27 20l-1.3 .75" /><path d="M15.97 17.25l1.3 .75" /><path d="M20.733 20l1.3 .75" /></svg>
								<h3 class="card-title"><?php _e( 'Full Site Editing support', 'hakoniwa' ); ?></h3>
							</div>
							<div class="hakoniwa-about-card">
								<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-table-dashed"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M3 10h18" /><path d="M10 3v18" /></svg>
								<h3 class="card-title"><?php _e( 'Abundant Patterns', 'hakoniwa' ); ?></h3>
							</div>
							<div class="hakoniwa-about-card">
								<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-language-hiragana"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5h7" /><path d="M7 4c0 4.846 0 7 .5 8" /><path d="M10 8.5c0 2.286 -2 4.5 -3.5 4.5s-2.5 -1.135 -2.5 -2c0 -2 1 -3 3 -3s5 .57 5 2.857c0 1.524 -.667 2.571 -2 3.143" /><path d="M12 20l4 -9l4 9" /><path d="M19.1 18h-6.2" /></svg>
								<h3 class="card-title"><?php _e( 'Translation Ready', 'hakoniwa' ); ?></h3>
							</div>
						</div>
						<h2 class="main-title"><?php _e( 'Customize Manual', 'hakoniwa' ); ?></h2>
						<div class="cards">
							<div class="hakoniwa-about-card">
								<h3 class="card-title"><?php _e( 'What is a site editor?', 'hakoniwa' ); ?></h3>
								<p><a class="button button-hakoniwa-secondary" href="https://hakoniwa.animagate.com/manual/site-editor/" target="_blank"><?php _e( 'View', 'hakoniwa' ); ?></a></p>
							</div>
							<div class="hakoniwa-about-card">
								<h3 class="card-title"><?php _e( 'What is a template?', 'hakoniwa' ); ?></h3>
								<p><a class="button button-hakoniwa-secondary" href="https://hakoniwa.animagate.com/manual/site-editor-template/" target="_blank"><?php _e( 'View', 'hakoniwa' ); ?></a></p>
							</div>
							<div class="hakoniwa-about-card">
								<h3 class="card-title"><?php _e( 'What are template parts?', 'hakoniwa' ); ?></h3>
								<p><a class="button button-hakoniwa-secondary" href="https://hakoniwa.animagate.com/manual/site-editor-template-parts/" target="_blank"><?php _e( 'View', 'hakoniwa' ); ?></a></p>
							</div>
							<div class="hakoniwa-about-card">
								<h3 class="card-title"><?php _e( 'Customize Top Page', 'hakoniwa' ); ?></h3>
								<p><a class="button button-hakoniwa-secondary" href="https://hakoniwa.animagate.com/manual/customize-top-page/" target="_blank"><?php _e( 'View', 'hakoniwa' ); ?></a></p>
							</div>
							<div class="hakoniwa-about-card">
								<h3 class="card-title"><?php _e( 'How to Use Patterns', 'hakoniwa' ); ?></h3>
								<p><a class="button button-hakoniwa-secondary" href="https://hakoniwa.animagate.com/manual/pattern/" target="_blank"><?php _e( 'View', 'hakoniwa' ); ?></a></p>
							</div>
							<div class="hakoniwa-about-card">
								<h3 class="card-title"><?php _e( 'Change Header', 'hakoniwa' ); ?></h3>
								<p><a class="button button-hakoniwa-secondary" href="https://hakoniwa.animagate.com/manual/site-editor-header-change/" target="_blank"><?php _e( 'View', 'hakoniwa' ); ?></a></p>
							</div>
							<div class="hakoniwa-about-card">
								<h3 class="card-title"><?php _e( 'Change Footer', 'hakoniwa' ); ?></h3>
								<p><a class="button button-hakoniwa-secondary" href="https://hakoniwa.animagate.com/manual/site-editor-footer-change/" target="_blank"><?php _e( 'View', 'hakoniwa' ); ?></a></p>
							</div>
							<div class="hakoniwa-about-card">
								<h3 class="card-title"><?php _e( 'Add a sidebar to the page', 'hakoniwa' ); ?></h3>
								<p><a class="button button-hakoniwa-secondary" href="https://hakoniwa.animagate.com/manual/add-sidebar/" target="_blank"><?php _e( 'View', 'hakoniwa' ); ?></a></p>
							</div>
							<div class="hakoniwa-about-card">
								<h3 class="card-title"><?php _e( 'How do I undo a customization?', 'hakoniwa' ); ?></h3>
								<p><a class="button button-hakoniwa-secondary" href="https://hakoniwa.animagate.com/manual/reset-template-pattern/" target="_blank"><?php _e( 'View', 'hakoniwa' ); ?></a></p>
							</div>
						</div>
					</div>
					<div class="right-col">
						<div class="cards">
							<div class="hakoniwa-about-card featured">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hakoniwa-patterns.jpg' ); ?>" alt="Hakoniwa Patterns">
								<h3 class="products-title">Hakoniwa Patterns</h3>
								<p class="card-description"><?php _e( 'Streamline content and page creation in web production, including corporate sites, branding sites, and landing pages (LPs)! We carefully select and distribute high-quality, highly practical “ready-to-use patterns”.', 'hakoniwa' ); ?></p>
								<p><a class="button button-primary" href="https://hakoniwa.animagate.com/patterns/" target="_blank">Hakoniwa Patterns</a></p>
							</div>
							<div class="hakoniwa-about-card">
								<svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-messages"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 14l-3 -3h-7a1 1 0 0 1 -1 -1v-6a1 1 0 0 1 1 -1h9a1 1 0 0 1 1 1v10" /><path d="M14 15v2a1 1 0 0 1 -1 1h-7l-3 3v-10a1 1 0 0 1 1 -1h2" /></svg>
								<h3 class="products-title"><?php _e( 'Support & Forum', 'hakoniwa' ); ?></h3>
								<p class="card-description"><?php _e( 'Join the Discord user community for support and forums.', 'hakoniwa' ); ?></p>
								<p><a class="button button-primary" href="https://discord.gg/54XtRAYMwj" target="_blank"><?php _e( 'Join Discord', 'hakoniwa' ); ?></a></p>
							</div>
							<div class="hakoniwa-about-card">
								<svg class="official" width="100%" height="100%" viewBox="0 0 190 181" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
									<g transform="matrix(1,0,0,1,-296,-788)">
										<g id="ol" transform="matrix(0.261671,0,0,0.261671,-139.586,448.255)">
											<g transform="matrix(0.0543478,0,-0.132405,0.494142,1863.79,727.253)">
												<rect x="1795.28" y="1157.48" width="543.307" height="874.016"/>
											</g>
											<g transform="matrix(0.0543478,0,-0.0103981,0.0388064,1603.65,1698.16)">
												<rect x="1795.28" y="1157.48" width="543.307" height="874.016"/>
											</g>
											<g transform="matrix(0.0543478,0,-0.0104269,0.0389137,1591.38,1743.93)">
												<rect x="1795.28" y="1157.48" width="543.307" height="874.016"/>
											</g>
											<g transform="matrix(0.76087,0,0.00874389,0.0326326,592.834,1755.84)">
												<rect x="1795.28" y="1157.48" width="543.307" height="874.016"/>
												<rect x="1795.28" y="1157.48" width="543.307" height="874.016"/>
											</g>
											<g transform="matrix(0.566165,0,0.00874389,0.0326326,806.709,1261.44)">
												<rect x="1795.28" y="1157.48" width="543.307" height="874.016"/>
											</g>
											<g transform="matrix(0.0652174,0,0.00874389,0.0326326,2084,1261.44)">
												<rect x="1795.28" y="1157.48" width="543.307" height="874.016"/>
											</g>
											<g transform="matrix(0.0652174,0,0.00874389,0.0326326,2031.09,1261.44)">
												<rect x="1795.28" y="1157.48" width="543.307" height="874.016"/>
											</g>
											<g transform="matrix(0.326087,0,0.114868,0.428693,1394.02,951.244)">
												<path d="M2338.58,1157.48L1795.28,1157.48L1795.28,2031.5L2338.58,2031.5L2338.58,1157.48ZM2244.84,1226.36L2244.84,1962.62C2244.84,1962.62 1889.02,1962.62 1889.02,1962.62C1889.02,1962.62 1889.02,1226.36 1889.02,1226.36L2244.84,1226.36Z"/>
											</g>
											<g transform="matrix(0.326087,0,0.211219,0.788278,861.623,386.796)">
												<path d="M2338.58,1157.48L2152.81,1157.48L1795.28,1433.47L1795.28,2031.5L2338.58,2031.5L2338.58,1157.48Z" style="fill:rgb(144,84,154);"/>
												<path d="M2338.58,1157.48L2152.81,1157.48L1795.28,1433.47L1795.28,2031.5L2338.58,2031.5L2338.58,1157.48ZM2244.84,1194.94L2244.84,1994.04C2244.84,1994.04 1889.02,1994.04 1889.02,1994.04C1889.02,1994.04 1889.02,1433.47 1889.02,1433.47C1889.02,1433.47 2198.03,1194.94 2198.03,1194.94L2244.84,1194.94Z"/>
											</g>
										</g>
									</g>
								</svg>
								<h3 class="products-title"><?php _e( 'Follow AnimaGate, Inc.', 'hakoniwa' ); ?></h3>
								<p class="card-description"><?php _e( 'The latest product news and additional features are distributed through our official account.', 'hakoniwa' ); ?></p>
								<ul>
									<li><a href="https://x.com/animagate" target="_blank"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4l11.733 16h4.267l-11.733 -16z" /><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" /></svg></a></li>
								</ul>
							</div>

						</div>
					</div>
				</div>
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

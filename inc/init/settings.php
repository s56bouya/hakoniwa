<?php
namespace hakoniwa\theme\init;

use hakoniwa\theme\init\Define;

class Settings {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'support' ] );
		add_filter( 'post_thumbnail_html', [ $this, 'thumbnail_html' ], 10, 3 );

		// テーマ変更後に初期設定
		add_action( 'after_switch_theme', [ $this, 'option_settings' ] );

		// theme.json の上書き
		add_filter( 'block_editor_settings_all', [ $this, 'override_theme_json' ], 10, 2 );

		// ページトップへ戻る
		add_action( 'wp_footer', [ $this, 'scroll_page_top_button' ], 10 );
	}

	/**
	 * テーマサポート
	 */
	public function support(){
		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'editor-styles' );
		
		add_theme_support( 'responsive-embeds' );
	}

	/**
	 * デフォルトサムネイル
	 */
	public function thumbnail_html( $html, $post_id, $post_thumbnail_id ){
		if( is_archive() || is_front_page() || is_search() ){
			if( ! has_post_thumbnail( $post_id ) && 'page' !== get_option( 'show_on_front' ) ){
				$html = '<div class="no-image"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"></path><line x1="15" y1="8" x2="15.01" y2="8"></line><rect x="4" y="4" width="16" height="16" rx="3"></rect><path d="M4 15l4 -4a3 5 0 0 1 3 0l5 5"></path><path d="M14 14l1 -1a3 5 0 0 1 3 0l2 2"></path></svg></div>';
			}
		}

		return $html;
	}

	/**
	 * オプション設定
	 */
	/**
	 * Profile
	 *
	 * @var array
	 */
	public $general_settings = array(
		'content_size' => '640px',
		'wide_size'    => '960px',
	);

	/**
	 * テーマ変更後 初期設定
	 *
	 * @return void
	 */
	public function option_settings() {

		// General
		if ( empty( get_option( Define::value( 'theme_options_name' ) . '_general' ) ) ) {
			update_option( Define::value( 'theme_options_name' ) . '_general', $this->general_settings );
		}

	}

	/**
	 * theme.json の上書き
	 */
	public function override_theme_json( $editor_settings, $editor_context ) {

		$general_options = get_option( Define::value( 'theme_options_name' ) . '_general' );

		if( $general_options ){
			$editor_settings['__experimentalFeatures']['layout']['contentSize'] = $general_options['content_size'];
			$editor_settings['__experimentalFeatures']['layout']['wideSize']    = $general_options['wide_size'];	
		}

		return $editor_settings;
	}
	
	/**
	 * ページトップボタン
	 *
	 * @return void
	 */
	function scroll_page_top_button() {

		if ( ! apply_filters( Define::value( 'theme_options_name' ) . '_scroll_page_top_button', true ) ) {
			return;
		}

		$output = '';
		$url    = apply_filters( Define::value( 'theme_options_name' ) . '_scroll_page_top_url', '#header' );
		$class  = array();

		$options = get_option( Define::value( 'theme_options_name' ) . '_general' );

		if( $options['scroll_to_button'] ){
			if( isset( $options['scroll_to_button']['desktop'] ) ){
				$class[] = 'is-desktop';
			}

			if( isset( $options['scroll_to_button']['tablet'] ) ){
				$class[] = 'is-tablet';
			}

			if( isset( $options['scroll_to_button']['smartphone'] ) ){
				$class[] = 'is-smartphone';
			}
		}

		$kses_defaults = wp_kses_allowed_html( 'post' );

		$svg_args = array(
			'svg'   => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true,
				'stroke-width'    => true,
				'stroke'          => true,
				'fill'            => true,
				'stroke-linecap'  => true,
				'stroke-linejoin' => true,
			),
			'g'     => array(
				'fill'      => true,
				'transform' => true,
			),
			'title' => array( 'title' => true ),
			'path'  => array(
				'stroke' => true,
				'd'      => true,
				'fill'   => true,
			),
		);

		$allowed_tags = array_merge( $kses_defaults, $svg_args );

		$bottom_right_content = '<div id="scroll-page-top" class="' . implode( ' ', $class ) . '"><a href="' . $url . '">
			<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
				<path stroke="none" d="M0 0h24v24H0z" fill="none"/>
				<path d="M6 15l6 -6l6 6" />
			</svg>
		</a></div>';

		$bottom_right_content = apply_filters( Define::value( 'theme_options_name' ) . '_bottom_right_content', $bottom_right_content, $url );

		$output .= '<div class="footer-bottom-right-content fixed">';
		$output .= apply_filters( Define::value( 'theme_options_name' ) . '_before_bottom_right_content', $before_bottom_right_content = '' );
		$output .= $bottom_right_content;
		$output .= apply_filters( Define::value( 'theme_options_name' ) . '_after_bottom_right_content', $after_bottom_right_content = '' );
		$output .= '</div>';

		echo wp_kses( $output, $allowed_tags );
	}

}

use hakoniwa\theme\init;
new Settings();

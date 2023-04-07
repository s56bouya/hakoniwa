<?php
namespace fse\theme\util;

use fse\theme\init\Define;

class Facebook {

	/**
	 * OGP 作成
	 *
	 */
	public static function output( $property, $content ) {
		$og_property = str_replace( ':', '_', $property );

		$content = apply_filters( Define::value( 'theme_name' ) . '_ogp_' . $og_property, $content );
		if ( empty( $content ) ) {
			return false;
		}

		echo '<meta name="' . esc_attr( $property ) . '" content="' . esc_attr( $content ) . '" />' . "\n";

		return true;
	}

	/**
	 * OGP 作成
	 *
	 */
	public static function create( $page_name ) {
		$options = get_option( $page_name );

		if ( empty( $options ) ) {
			return false;
		}

		if ( ! isset( $options['active'] ) ) {
			return false;
		}

		if ( ! array_key_exists( 'facebook', $options['active'] ) ) {
			return false;
		}

		self::output( 'fb:app_id', $options['facebook_app_id'] );
	}

}

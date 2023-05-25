<?php
namespace hakoniwa\theme\init;

class Define {

	/**
	 * Define Value
	 */
	public static function value( $name ) {

		if ( empty( $name ) ) {

			return false;

		}

		switch ( $name ) {
			case 'theme_name':

				$define = 'hakoniwa';

				break;

			default:

				$define = '';

				break;
		}

		return $define;

	}

}

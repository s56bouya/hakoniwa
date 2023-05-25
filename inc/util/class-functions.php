<?php
namespace hakoniwa\theme\util;

use hakoniwa\theme\init\Define;

class Functions {

	/**
	 * Detect Front Page
	 *
	 * @return boolean
	 */
	public static function is_static_front_page() {

		return ( is_front_page() && ! is_home() );
		
	}

	/**
	 * Get All Post Types
	 *
	 * @return boolean
	 */
	public static function get_all_post_types() {

		$args     = [
			'public' => true,
		];
		
		$output   = 'names';
		$operator = 'and';
		$pts      = get_post_types( $args, $output, $operator );

		return $pts;

	}

	/**
	 * Detect Custom Post Type
	 *
	 * @return boolean
	 */
	public static function is_custom_post_type() {

		$post_obj = get_post_type_object( get_post_type() );

		if ( ! empty( $post_obj ) && false === $post_obj->_builtin ) {

			return $post_obj;

		} else {

			return false;

		}

	}

}

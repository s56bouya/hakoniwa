<?php
namespace hakoniwa\theme\util;

use hakoniwa\theme\init\Define;

class Auth {
	/**
	 * Base file
	 *
	 * @var string
	 */
	private $base_url = '/wp-json/license/auth';

	/**
	 * Remote Check
	 *
	 * @param array $args 設定
	 * @return boolean
	 */
	public function remote_check( $args ) {
		$args = array(
			'url'  	=> $args['url'],
			'key'	=> $args['key'],
		);

		$target_url = Define::value( 'network_auth' ) . $this->base_url . '?' . http_build_query( $args );
		$request    = wp_remote_get(
			$target_url,
			array(
				'sslverify' => false,
			)
		);

//		wp_die( var_dump($target_url) );
//		wp_die( var_dump($request) );

		if ( isset( $request ) && ! empty( $request ) && ! is_wp_error( $request ) && 200 === $request['response']['code'] ) {
			return json_decode( wp_remote_retrieve_body( $request ), true );
		} else {
			return false;
		}

	}
}

use hakoniwa\theme\util;
new Auth();
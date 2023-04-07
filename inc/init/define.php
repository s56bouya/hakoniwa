<?php
namespace fse\theme\init;

class Define {

	/**
	 * 定数
	 */
	public static function value( $name ){
		if( empty( $name ) ){
			return false;
		}

		switch( $name ){
			case 'theme_name':

				$define = 'hakoniwa';

				break;
			case 'theme_options_name':

				$define = 'hakoniwa_options';

				break;

			case 'network_auth':

				$define = 'https://final.localhost';

				break;

			case 'network_active':

				$define = true;

				break;

			case 'product_id':

				$define = 'prod_Me7x97EpjK8bTK';

				break;

			default:

				$define = '';

				break;
		}

		return $define;
	}	
}


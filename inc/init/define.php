<?php
namespace hakoniwa\theme\init;

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

				$define = 'https://hakoniwa.animagate.com';

				break;

			case 'network_active':

				$define = false;

				break;

			case 'product_theme_id':

				$define = 'prod_Me7x97EpjK8bTK';

				break;

			case 'product_plugin_blocks_id':

				$define = 'prod_NehaygIV4aIBiJ';

				break;

			default:

				$define = '';

				break;
		}

		return $define;
	}	
}


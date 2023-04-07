<?php
use hakoniwa\theme\init\Define;

/**
 * Search Title
 */
$search_result_text = '';

return array(
	'title'      => __( '検索タイトル', Define::value( 'theme_name' ) ),
	'categories' => array( 'search' ),
	'content'    => '<!-- wp:group {"layout":{"inherit":true}} -->
					<div class="wp-block-group py-4">
						<!-- wp:heading {"level":1} --><h1 class="has-text-align-center has-3-xl-font-size mt-0">検索結果</h1><!-- /wp:heading -->
						<!-- wp:search {"label":"Search","showLabel":false,"width":100,"widthUnit":"%","buttonText":"Search","buttonUseIcon":true,"className":"m-0"} /-->' . $search_result_text .
					'</div>
					<!-- /wp:group -->',
);

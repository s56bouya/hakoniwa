<?php
use fse\theme\init\Define;

/**
 * Default footer
 */
return array(
	'title'      => __( 'Default footer', Define::value( 'theme_name' ) ),
	'categories' => array( 'footer' ),
	'blockTypes' => array( 'core/template-part/footer' ),
	'content'    => '<!-- wp:group {"align":"wide","layout":{"inherit":true}} -->
						<div class="wp-block-group alignwide py-8">
							<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
							<div class="wp-block-group alignwide">
								<!-- wp:site-title {"level":0} /-->
								<!-- wp:site-tagline /-->
							</div>
							<!-- /wp:group -->
						</div>
					<!-- /wp:group -->',
);

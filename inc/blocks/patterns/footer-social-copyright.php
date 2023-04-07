<?php
use fse\theme\init\Define;

/**
 * Footer with social links and copyright
 */
return array(
	'title'      => __( 'Footer with social links and copyright', Define::value( 'theme_name' ) ),
	'categories' => array( 'footer' ),
	'blockTypes' => array( 'core/template-part/footer' ),
	'content'    => '<!-- wp:group {"align":"full","layout":{"inherit":true}} -->
					<div class="wp-block-group alignfull"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}}} -->
					<div class="wp-block-group alignwide py-4">
					<!-- wp:social-links {"iconColor":"foreground","iconColorValue":"var(--wp--preset--color--foreground)","iconBackgroundColor":"background","iconBackgroundColorValue":"var(--wp--preset--color--background)","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":{"top":"0.5em","left":"0.5em"}}}} -->
					<ul class="wp-block-social-links has-icon-color has-icon-background-color">
						<!-- wp:social-link {"url":"#","service":"facebook"} /-->
						<!-- wp:social-link {"url":"#","service":"twitter"} /-->
						<!-- wp:social-link {"url":"#","service":"instagram"} /-->
					</ul>
					<!-- /wp:social-links -->
					<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px"}}} -->
					<p class="has-text-align-center" style="font-size:16px">' . esc_html__( '© Site Title', Define::value( 'theme_name' ) ) . '</p>
					<!-- /wp:paragraph --></div>
					<!-- /wp:group --></div>
					<!-- /wp:group -->',
);

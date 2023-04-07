<?php
use fse\theme\init\Define;

 /**
  * Title: Footer Social
  * Slug: fse/footer-social
  * Categories: footer
  * Block Types: core/template-part/footer
  */
?>
<!-- wp:group {"align":"full","layout":{"inherit":true}} -->
<div class="wp-block-group alignfull"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
<!-- wp:social-links {"iconColor":"foreground","iconColorValue":"var(--wp--preset--color--foreground)","iconBackgroundColor":"background","iconBackgroundColorValue":"var(--wp--preset--color--background)","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":{"top":"0.5em","left":"0.5em"}}}} -->
<ul class="wp-block-social-links has-icon-color has-icon-background-color">
  <!-- wp:social-link {"url":"#","service":"facebook"} /-->
  <!-- wp:social-link {"url":"#","service":"twitter"} /-->
  <!-- wp:social-link {"url":"#","service":"instagram"} /-->
</ul>
<!-- /wp:social-links -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px"}}} -->
<p class="has-text-align-center mt-10"><?php echo esc_html__( '© Site Title', Define::value( 'theme_name' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

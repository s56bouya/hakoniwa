<?php
 /**
  * Title: Search General
  * Slug: my-theme/search-general
  * Categories: footer
  * Block Types: core/template-part/footer
  */
?>
<!-- wp:group {"align":"full","layout":{"inherit":true}} -->
<div class="wp-block-group alignfull"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}}} -->
<div class="wp-block-group alignwide" style="padding-top:4rem;padding-bottom:4rem">
<!-- wp:social-links {"iconColor":"foreground","iconColorValue":"var(--wp--preset--color--foreground)","iconBackgroundColor":"background","iconBackgroundColorValue":"var(--wp--preset--color--background)","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":{"top":"0.5em","left":"0.5em"}}}} -->
<ul class="wp-block-social-links has-icon-color has-icon-background-color">
  <!-- wp:social-link {"url":"#","service":"facebook"} /-->
</ul>
<!-- /wp:social-links -->

<!-- wp:spacer {"height":50} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"16px"}}} -->
<p class="has-text-align-center" style="font-size:16px"><?php echo esc_html__( '© Site Title', 'twentytwentytwo' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

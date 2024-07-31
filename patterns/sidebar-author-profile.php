<?php
/**
 * Title: Sidebar author profile
 * Slug: hakoniwa/sidebar-author-profile
 * Categories: sidebar, Hakoniwa
 * Viewport width: 960
 *
 * @package Hakoniwa
 * @since 1.0.0
 */

?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"patterns-author-profile-01 is-style-hakoniwa-background-stripe-01","style":{"spacing":{"blockGap":"var:preset|spacing|50","padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group patterns-author-profile-01 is-style-hakoniwa-background-stripe-01" style="padding-top:var(--wp--preset--spacing--80);padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"480px"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"align":"center","className":"has-2-xs-font-size"} -->
<p class="has-text-align-center has-2-xs-font-size"><?php echo esc_html( __('Author', 'hakoniwa' ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:avatar {"size":80,"align":"center","style":{"border":{"radius":"100px"}}} /-->

<!-- wp:post-author-name {"textAlign":"center","isLink":true,"linkTarget":"_blank"} /-->

<!-- wp:post-author-biography /-->

<!-- wp:social-links {"iconColor":"contrast","iconColorValue":"#111111","size":"has-small-icon-size","className":"is-style-logos-only","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|30","left":"var:preset|spacing|30"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<ul class="wp-block-social-links has-small-icon-size has-icon-color is-style-logos-only"><!-- wp:social-link {"url":"","service":"x"} /-->

<!-- wp:social-link {"url":"","service":"facebook"} /-->

<!-- wp:social-link {"url":"","service":"instagram"} /--></ul>
<!-- /wp:social-links --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Categories</h3>
<!-- /wp:heading -->

<!-- wp:categories {"showHierarchy":true} /-->
<!-- wp:calendar /-->
</div>
<!-- /wp:group -->

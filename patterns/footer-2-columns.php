<?php
/**
 * Title: Footer 2 Columns
 * Slug: hakoniwa/footer-2-columns
 * Categories: footer,Hakoniwa
*/
?>
<!-- wp:group {"align":"full","layout":{"inherit":true,"type":"constrained"}} -->
<div class="wp-block-group alignfull"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|30","padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)"><!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"level":3,"className":"is-style-hakoniwa-blocks-heading-border-02"} -->
<h3 class="wp-block-heading is-style-hakoniwa-blocks-heading-border-02">Categories</h3>
<!-- /wp:heading -->

<!-- wp:categories /--></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:heading {"level":3,"className":"is-style-hakoniwa-blocks-heading-border-02"} -->
<h3 class="wp-block-heading is-style-hakoniwa-blocks-heading-border-02">Tags</h3>
<!-- /wp:heading -->

<!-- wp:tag-cloud /--></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php echo esc_html( '©&nbsp;' . get_bloginfo( 'name' ) ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

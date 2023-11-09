<?php
/**
 * Title: Latest Posts 01
 * Slug: hakoniwa/latest-posts-01
 * Categories: Hakoniwa
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"2rem","left":"2rem","top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--80);padding-right:2rem;padding-bottom:var(--wp--preset--spacing--80);padding-left:2rem"><!-- wp:heading {"textAlign":"center","className":"is-style-default","fontSize":"2xl"} -->
	<h2 class="wp-block-heading has-text-align-center is-style-default has-2-xl-font-size">News</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"exclude","inherit":false},"tagName":"section","align":"wide","layout":{"type":"constrained"}} -->
	<section class="wp-block-query alignwide"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:post-template {"align":"wide","className":"archives","layout":{"type":"grid","columnCount":3}} -->
	<!-- wp:post-featured-image {"isLink":true,"className":"aspect-ratio-16-9"} /-->

	<!-- wp:post-title {"isLink":true,"style":{"typography":{"lineHeight":1.4}},"fontSize":"md"} /-->

	<!-- wp:post-excerpt {"style":{"typography":{"lineHeight":1.6}},"fontSize":"2xs"} /-->

	<!-- wp:post-date {"isLink":true,"style":{"typography":{"lineHeight":1.6}},"fontSize":"2xs"} /-->
	<!-- /wp:post-template -->

	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-fill"} -->
	<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" href="#"><?php echo esc_html_x( 'Read more', 'Pattern:Latest Posts 01', 'hakoniwa' ); ?></a></div>
	<!-- /wp:button --></div>
	<!-- /wp:buttons --></div>
	<!-- /wp:group --></section>
	<!-- /wp:query --></div>
	<!-- /wp:group -->

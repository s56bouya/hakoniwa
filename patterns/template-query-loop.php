<?php
/**
 * Title: Template Query Loop Content
 * Slug: hakoniwa/template-query-loop
 * Categories: Hakoniwa
 * 
 * @package Hakoniwa
 * @since 1.0.0
 */

?>
<!-- wp:query {"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"excludeCurrent":null},"metadata":{"patternName":"hakoniwa/template-query-loop","name":"Template Query Loop Content","categories":["Hakoniwa"]},"align":"wide","layout":{"inherit":false}} -->
<div class="wp-block-query alignwide"><!-- wp:post-template {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"240px","autoFit":false}} -->
<!-- wp:group {"style":{"spacing":{"blockGap":"0.5em"}},"fontSize":"card","layout":{"type":"grid","autoFit":true,"columnCount":1,"minimumColumnWidth":"240px"}} -->
<div class="wp-block-group has-card-font-size"><!-- wp:post-featured-image {"isLink":true,"className":"aspect-ratio-16-9"} /-->

<!-- wp:group {"className":"detail","style":{"spacing":{"blockGap":"0.25em"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group detail"><!-- wp:post-title {"isLink":true,"fontSize":"card-title"} /-->

<!-- wp:post-excerpt {"style":{"typography":{"fontSize":"0.8em"}}} /-->

<!-- wp:post-date {"isLink":true,"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"typography":{"fontSize":"0.8em"}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

	<!-- wp:query-no-results -->
		<!-- wp:group {"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|50"}}},"layout":{"type":"default"}} -->
		<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--50)">
			<!-- wp:paragraph -->
			<p><?php echo esc_html( __( 'We could not find any results. You can give it another try through the search form below.', 'hakoniwa' ) ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:search {"label":"Search","showLabel":false,"width":100,"widthUnit":"%","buttonText":"Search","buttonUseIcon":true} /--></div>
		<!-- /wp:group -->
	<!-- /wp:query-no-results -->

	<!-- wp:query-pagination {"align":"wide","fontSize":"xs","layout":{"type":"flex","justifyContent":"center"}} -->
		<!-- wp:query-pagination-previous /-->
		<!-- wp:query-pagination-numbers /-->
		<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->
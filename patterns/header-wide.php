<?php
/**
 * Title: Header(Wide)
 * Slug: hakoniwa/header-wide
 * Block Types: core/template-part/header
 * Categories: header, Hakoniwa
 *
 * @package Hakoniwa
 * @since 1.0.0
 */

?>
<!-- wp:group {"className":"hakoniwa-header-wide","layout":{"inherit":true,"type":"constrained"}} -->
<div id="header" class="wp-block-group hakoniwa-header-wide">
	<!-- wp:group {"align":"wide","className":"hakoniwa-header-main-content","layout":{"type":"flex","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide hakoniwa-header-main-content">
		<!-- wp:group {"style":{"spacing":{"blockGap":"1.5em"}},"layout":{"type":"flex"}} -->
		<div class="wp-block-group">
			<!-- wp:site-logo {"width":64} /-->
			<!-- wp:site-title /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:navigation {"icon":"menu","layout":{"type":"flex","setCascadingProperties":true},"style":{"spacing":{"blockGap":"1.5em"}}} -->
		<!-- wp:page-list /-->
		<!-- /wp:navigation -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

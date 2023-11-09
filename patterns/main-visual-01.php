<?php
/**
 * Title: Main Visual 01
 * Slug: hakoniwa/main-visual-01
 * Categories: Hakoniwa
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull">
	<!-- wp:group {"align":"full","className":"is-style-hakoniwa-background-dot-01","layout":{"type":"default"}} -->
	<div class="wp-block-group alignfull is-style-hakoniwa-background-dot-01">
		<!-- wp:cover {"dimRatio":50,"overlayColor":"tertiary","isDark":false,"align":"full","style":{"spacing":{"padding":{"right":"2rem","left":"2rem"}},"color":{"duotone":"unset"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-cover alignfull is-light" style="padding-right:2rem;padding-left:2rem"><span aria-hidden="true" class="wp-block-cover__background has-tertiary-background-color has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"0","bottom":"0"}}},"layout":{"type":"default"}} -->
		<div class="wp-block-group alignwide" style="padding-top:0;padding-bottom:0">
		<!-- wp:heading {"level":1,"className":"is-style-default","fontSize":"4xl"} -->
		<h1 class="wp-block-heading is-style-default has-4-xl-font-size"><?php echo esc_html_x( 'Welcome to Block Theme Hakoniwa', 'Pattern:Main Visual 01', 'hakoniwa' ); ?></h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph -->
		<p><?php echo esc_html_x( 'Use the blocks to create the website you want. First, use the site editor to customize the top page.', 'Pattern:Main Visual 01', 'hakoniwa' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"is-style-fill"} -->
			<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" href="<?php echo get_admin_url( null, '/site-editor.php?postType=wp_template&postId=hakoniwa//front-page' ); ?>"><?php echo esc_html_x( 'Edit Top Page', 'Pattern:Main Visual 01', 'hakoniwa' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
	</div>
</div>
<!-- /wp:cover -->
</div>
<!-- /wp:group -->
</div>
<!-- /wp:group -->


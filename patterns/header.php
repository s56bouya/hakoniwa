<?php
 /**
  * Title: Header
  * Slug: hakoniwa/header
  * Categories: header
  */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}},"layout":{"inherit":true,"type":"constrained"}} -->
<div id="header" class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
    <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between"}} -->
    <div class="wp-block-group">
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
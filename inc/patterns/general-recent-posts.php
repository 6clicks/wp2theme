<?php
/**
 * Recent posts
 */
return array(
	'title'      => __( 'Recent Posts', 'wp2' ),
	'categories' => array( 'wp2-general' ),
	'content'    => '
		<!-- wp:group {"className":"wp2-container","layout":{"contentSize":"1170px"}} -->
		<div class="wp-block-group wp2-container"><!-- wp:spacer {"height":40} -->
		<div style="height:40px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer -->

		<!-- wp:paragraph {"align":"center","className":"wp2-text-letter-spacing","fontSize":"tiny"} -->
		<p class="has-text-align-center wp2-text-letter-spacing has-tiny-font-size">' . esc_html__( 'LATEST NEWS', 'wp2' ) . '</p>
		<!-- /wp:paragraph -->

		<!-- wp:query {"queryId":1,"query":{"perPage":"3","pages":0,"offset":0,"postType":"post","categoryIds":[],"tagIds":[],"order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"flex","columns":3},"align":"wide","layout":{"inherit":false}} -->
		<div class="wp-block-query alignwide"><!-- wp:post-template {"className":"wp2-post"} -->
		<!-- wp:group {"tagName":"article"} -->
		<article class="wp-block-group"><!-- wp:post-featured-image {"isLink":true,"width":"","height":"","className":"hover-scale"} /-->

		<!-- wp:post-terms {"term":"category","textAlign":"center","className":"wp2-text-letter-spacing"} /-->

		<!-- wp:group {"style":{"spacing":{"padding":{"right":"10%","left":"10%"}}}} -->
		<div class="wp-block-group" style="padding-right:10%;padding-left:10%"><!-- wp:post-title {"textAlign":"center","isLink":true} /--></div>
		<!-- /wp:group -->

		<!-- wp:post-date {"textAlign":"center"} /--></article>
		<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:spacer {"height":60} -->
		<div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
		<!-- /wp:spacer --></div>
		<!-- /wp:query --></div>
		<!-- /wp:group -->',
);




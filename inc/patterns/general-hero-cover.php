<?php
/**
 * General hero cover
 */
return array(
	'title'      => __( 'Hero Cover', 'wp2' ),
	'categories' => array( 'wp2-general' ),
	'content'    => '
			<!-- wp:cover {"url":"' . esc_url( get_theme_file_uri( 'assets/img/wp2_hero_cover.jpg' ) ) .  '","id":10,"hasParallax":true,"dimRatio":30,"overlayColor":"foreground","minHeight":67,"minHeightUnit":"vh","contentPosition":"center center","isDark":false,"className":"wp2-hero","style":{"color":[]}} -->
			<div class="wp-block-cover is-light has-parallax wp2-hero" style="background-image:url(' . esc_url( get_theme_file_uri( 'assets/img/wp2_hero_cover.jpg' ) ) . ');min-height:67vh"><span aria-hidden="true" class="has-foreground-background-color has-background-dim-30 wp-block-cover__gradient-background has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"layout":{"inherit":false,"contentSize":"720px"}} -->
			<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":1,"textColor":"background","fontSize":"huge"} -->
			<h1 class="has-text-align-center has-background-color has-text-color has-huge-font-size" id="hello-i-m-wp2-and-this-is-my-perswp2l-travel-journal">' . __( 'Hello, I\'m wp2. And this is my perswp2l travel journal', 'wp2' ) . '</h1>
			<!-- /wp:heading --></div>
			<!-- /wp:group --></div></div>
			<!-- /wp:cover -->',
);




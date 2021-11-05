<?php
/**
 * WP2: Block Patterns
 *
 * @since 1.0
 */

if ( ! function_exists( 'wp2_register_block_patterns' ) ) :
	function wp2_register_block_patterns() {
		if ( function_exists( 'register_block_pattern_category' ) ) {
			register_block_pattern_category(
				'wp2-general',
				array( 'label' => __( 'WP2 General', 'wp2' ) )
			);
			register_block_pattern_category(
				'wp2-footers',
				array( 'label' => __( 'WP2 Footers', 'wp2' ) )
			);
			register_block_pattern_category(
				'wp2-headers',
				array( 'label' => __( 'WP2 Headers', 'wp2' ) )
			);
			register_block_pattern_category(
				'wp2-query',
				array( 'label' => __( 'WP2 Posts', 'wp2' ) )
			);
			register_block_pattern_category(
				'wp2-pages',
				array( 'label' => __( 'WP2 Pages', 'wp2' ) )
			);
		}
		if ( function_exists( 'register_block_pattern' ) ) {
			$block_patterns = array(
				'general-hero-cover',
				'general-page-title-with-image',
				'general-promo-boxes',
				'general-promo-section',
				'general-recent-posts',
				'header-default',
				'header-centered-logo',
				'footer-default'			
			);

			foreach ( $block_patterns as $block_pattern ) {
				register_block_pattern(
					'wp2/' . $block_pattern,
					require __DIR__ . '/patterns/' . $block_pattern . '.php'
				);
			}
		}
	}
endif;
add_action( 'init', 'wp2_register_block_patterns', 9 );

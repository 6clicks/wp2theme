<?php
/**
 * Custom post type
 *
 * @package WP2
 * @since 1.0.0
 */

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'wp2_flush_rewrite_rules' );

// Flush your rewrite rules
function wp2_flush_rewrite_rules() {
	flush_rewrite_rules();
}
// ajouté un nouveau fichier par CPT que l'ont crée 
require_once  WP2_DIR  .'/inc/cpt/_custom_post_type_demo.php';


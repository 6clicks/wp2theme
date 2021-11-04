<?php
/**
 * sans ce fichier WordPress considère le thème comme déprecié
 *
 * @package wp2
 */

if ( current_user_can( 'activate_plugins' ) ) {
	esc_html_e( 'This theme was built for the WordPress experimental full site editing feature. You need to install and activate the Gutenberg plugin to make it work. ', 'wp2' );
}
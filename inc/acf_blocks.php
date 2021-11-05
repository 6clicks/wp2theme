<?php
/**
 * Acf blocks
 *
 * @package WP2
 * @since 1.0.0
 */


add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'testimonial',
            'title'             => __('Testimonial'),
            'description'       => __('A custom testimonial block.'),
            'render_template'   => 'my_acf_block_render_callback',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'testimonial', 'quote' ),
        ));
    }
}

/**
 * Enqueue block JavaScript and CSS for the editor
 */
function my_block_plugin_editor_scripts() {
	
    // Enqueue block editor JS
    wp_enqueue_script(
        'my-block-editor-js',
		get_template_directory_uri(). '/custom-blocks/js/editor-blocks.js',array('jquery'),'1.0.0',true);

    // Enqueue block editor styles
    wp_enqueue_style(
        'my-block-editor-css',
		get_template_directory_uri(). '/assets/css/blocks/editor-blocks.css',array(), '1.0.0',true );

}

// Hook the enqueue functions into the editor
add_action( 'enqueue_block_editor_assets', 'my_block_plugin_editor_scripts' );

/**
 * Enqueue frontend and editor JavaScript and CSS
 */
function my_block_plugin_scripts() {
	
    // Enqueue block JS
    wp_enqueue_script(
        'my-block-js',
        get_template_directory_uri() . '/custom-blocks/js/blocks.js',array('jquery'), '1.0.0' );
    // Enqueue block editor styles
    wp_enqueue_style(
        'my-block-css',
        get_template_directory_uri() . '/css/blocks/blocks.css', array(), '1.0.0' );

}

// Hook the enqueue functions into the frontend and editor
add_action( 'enqueue_block_assets', 'my_block_plugin_scripts' );


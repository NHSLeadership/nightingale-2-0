<?php
/**
 * Enqueue Gutenberg block editor style
 *
 * @package Nightingale-2-0
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

/**
 * Line up the admin editor css
 */
function nightingale_gutenberg_editor_styles() {
	wp_enqueue_style( 'nhsl-gut-editor-styles', get_template_directory_uri() . '/style-gutenburg.css', false, '1.1.7', 'all' );
	wp_enqueue_style( 'nhsl-gut-editor-styles', get_template_directory_uri() . '/page-colours.min.css', false, '1.1.7', 'all' );
}

add_action( 'enqueue_block_editor_assets', 'nightingale_gutenberg_editor_styles', 100 );



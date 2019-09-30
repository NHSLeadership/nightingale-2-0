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
	wp_enqueue_style( 'nhsl-block-editor-styles', get_theme_file_uri( '/style-gutenburg.css' ), false, '1.0', 'all' );
}

add_action( 'enqueue_block_editor_assets', 'nightingale_gutenberg_editor_styles', 100 );

/**
 * Gutenberg scripts and styles
 */
function nightingale_gutenberg_scripts() {

	wp_enqueue_script(
		'nightingale-editor',
		get_stylesheet_directory_uri() . '/assets/js/editor.js',
		array( 'wp-blocks', 'wp-dom' ),
		filemtime( get_stylesheet_directory() . '/assets/js/editor.js' ),
		true
	);
}

add_action( 'enqueue_block_editor_assets', 'nightingale_gutenberg_scripts' );

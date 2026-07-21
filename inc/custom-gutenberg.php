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
	// Prevent editor styles being loaded on front-end requests.
	if ( ! is_admin() ) {
		return;
	}

	wp_enqueue_style(
		'nhsl-gut-editor-styles',
		get_template_directory_uri() . '/style-gutenburg.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);

	wp_enqueue_style(
		'nhsl-page-colours',
		get_template_directory_uri() . '/page-colours.min.css',
		array(),
		wp_get_theme()->get( 'Version' )
	);
}

add_action(
	'enqueue_block_assets',
	'nightingale_gutenberg_editor_styles',
	100
);

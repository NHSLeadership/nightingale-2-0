<?php
/**
 * Performance tweaks to improve load times and overall performance of site.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

/**
 * Defer JS to footer
 *
 * @param string $url javascript file being loaded.
 *
 * @return string $url Javascript file with defer tag added.
 */
function nightingale_defer_parsing_js( $url ) {
	// Add the files to exclude from defer. Add jquery.js by default.
	$exclude_files = array( 'jquery.min.js' );
	// Bypass JS defer for logged in users.
	if ( ! is_user_logged_in() ) {
		if ( false === strpos( $url, '.js' ) ) {
			return $url;
		}

		foreach ( $exclude_files as $file ) {
			if ( strpos( $url, $file ) ) {
				return $url;
			}
		}
	} else {
		return $url;
	}

	return "$url' defer='defer";

}

add_filter( 'clean_url', 'nightingale_defer_parsing_js', 11, 1 );

/**
 * Defer CSS Loading to after load.
 *
 * @param string $html raw content coming in to the function.
 * @param string $handle which string are we looking for.
 * @param url    $href the resource being amended.
 * @param string $media view type.
 *
 * @return string
 */
function nightingale_add_rel_preload( $html, $handle, $href, $media ) {

	if ( is_admin() ) {
		return $html;
	}


	$html = <<<EOT
<link rel='preload' as='style' onerror="this.rel='stylesheet'" onload="this.onload=null;this.rel='stylesheet'" id='$handle' href='$href' media='all' />
<link rel='stylesheet' id='$handle' href='$href' media='all' />
EOT;

	return $html;
}

add_filter( 'style_loader_tag', 'nightingale_add_rel_preload', 10, 4 );

/*
 * Clean up the WordPress head.
 */

// remove header links.
add_action( 'init', 'nightingale_head_cleanup' );

/**
 * Remove a chunk of stuff from the header to optimise loading.
 */
function nightingale_head_cleanup() {
	remove_action( 'wp_head', 'feed_links_extra', 3 );                      // Category Feeds.
	remove_action( 'wp_head', 'feed_links', 2 );                            // Post and Comment Feeds.
	remove_action( 'wp_head', 'rsd_link' );                                 // EditURI link.
	remove_action( 'wp_head', 'wlwmanifest_link' );                         // Windows Live Writer.
	remove_action( 'wp_head', 'index_rel_link' );                           // index link.
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );              // previous link.
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );               // start link.
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );   // Links for Adjacent Posts.
	remove_action( 'wp_head', 'wp_generator' );                             // WP version.
}

/**
 * Put a more modern, remote hosted version of jQuery into our theme
 */
function nightingale_include_custom_jquery() {
	wp_register_script( 'jquerynew', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '3.4.1', true ); // Re-Register correct version of jQuery, remote loaded through Google CDN.
	wp_enqueue_script( 'jquerynew', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), '3.4.1', true ); // Queue it up.
}

add_action( 'wp_enqueue_scripts', 'nightingale_include_custom_jquery' );

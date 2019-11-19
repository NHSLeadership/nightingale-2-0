<?php
/**
 * Performance tweaks to improve load times and overall performance of site.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

/**
 * Load in the loadcss javascript file to header inline.
 */
function nightingale_load_css() {
	wp_register_script( 'loadcss', get_template_directory_uri() . '/js/loadcss.js', array(), '30072019', false ); // Register loadCSS javascript function.
	wp_enqueue_script( 'loadcss', get_template_directory_uri() . '/js/loadcss.js', array(), '30072019', false ); // Queue it up.

}

add_action( 'wp_head', 'nightingale_load_css', 1 );
add_action( 'login_head', 'nightingale_load_css', 1 );

/**
 * Load in the instantpage javascript file to header inline.
 */
function nightingale_load_instantpage() {
	wp_register_script( 'instantpage', get_template_directory_uri() . '/js/instantpage.js', array(), '23092019', false ); // Register instantpage javascript function.
	wp_enqueue_script( 'instantpage', get_template_directory_uri() . '/js/instantpage.js', array(), '23092019', false ); // Queue it up.

}

add_action( 'wp_head', 'nightingale_load_instantpage', 99 );
add_action( 'login_head', 'nightingale_load_instantpage', 99 );

/**
 * Run all css includes through loadcss function.
 *
 * @param string $html full string of original declaration.
 * @param string $handle unique identifier.
 * @param string $href precise link of stylesheet.
 *
 * @return string
 */
function nightingale_loadcss_files( $html, $handle, $href ) {
	if ( $html ) {
		if ( is_admin() ) {
			return $html;
		}
		$dom = new DOMDocument();
		$dom->loadHTML( $html );
		$a = $dom->getElementById( $handle . '-css' );
		if ( ! empty( $a ) ) {
			return "<script>loadCSS('" . $a->getAttribute( 'href' ) . "',0,'" . $a->getAttribute( 'media' ) . "');</script>\n";
		}
	}
}

add_filter( 'style_loader_tag', 'nightingale_loadcss_files', 9999, 3 );

/**
 * Defer JS to footer
 *
 * @param string $url javascript file being loaded.
 *
 * @return string $url Javascript file with defer tag added.
 */
function nightingale_defer_parsing_js( $url ) {
	// Add the files to exclude from defer. Add jquery.js by default.
	$exclude_files = array( 'jquery', 'loadcss' );
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

// Down and dirty trick to load scripts BEFORE css to make loadCSS work properly.
remove_action( 'wp_head', 'wp_print_styles', 8 );
add_action( 'wp_head', 'wp_print_styles', 10 );

/**
 * Disable the emoji's.
 */
function nightingale_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	// Remove from TinyMCE.
	add_filter( 'tiny_mce_plugins', 'nightingale_disable_emojis_tinymce' );
}

add_action( 'init', 'nightingale_disable_emojis' );

/**
 * Filter out the tinymce emoji plugin.
 *
 * @param array $plugins any plugins using emojis.
 *
 * @return array.
 */
function nightingale_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

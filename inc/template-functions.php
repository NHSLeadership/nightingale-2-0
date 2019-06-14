<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Nightingale_2.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function nightingale_2_0_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

    $classes[] = nightingale_2_0_get_header_style();
	return $classes;
}
add_filter( 'body_class', 'nightingale_2_0_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function nightingale_2_0_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'nightingale_2_0_pingback_header' );

if( ! function_exists( 'nightingale_2_0_get_header_style' ) ) {
    function nightingale_2_0_get_header_style() {

        $themeoptions_header_style = esc_attr(get_theme_mod( 'theme-header-style', 'default' ));

        if ( $themeoptions_header_style == 'default' ) {
            $default_position = 'page-header-default';
        } elseif ( $themeoptions_header_style == 'centered' ) {
            $default_position = 'page-header-white';
        }

        return $default_position;
    }
}

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

// remove "type" from script and style tags - not needed for html 5 validation
add_filter( 'script_loader_tag', 'nightingale_2_0__remove_type', 10, 3 );
add_filter( 'style_loader_tag', 'nightingale_2_0__remove_type', 10, 3 );  // Ignore the $media argument to allow for a common function.
function nightingale_2_0__remove_type( $markup, $handle, $href ) {

    // Remove the 'type' attribute.
    $markup = str_replace( " type='text/javascript'", '', $markup );
    $markup = str_replace( " type='text/css'", '', $markup );
    return $markup;
}
// Store and process wp_head output to operate on inline scripts and styles.
add_action( 'wp_head', 'nightingale_2_0__wp_head_ob_start', 0 );
function nightingale_2_0__wp_head_ob_start() {
    ob_start();
}
add_action( 'wp_head', 'nightingale_2_0__wp_head_ob_end', 10000 );
function nightingale_2_0__wp_head_ob_end() {
    $wp_head_markup = ob_get_contents();
    ob_end_clean();

    // Remove the 'type' attribute. Note the use of single and double quotes.
    $wp_head_markup = str_replace( " type='text/javascript'", '', $wp_head_markup );
    $wp_head_markup = str_replace( ' type="text/javascript"', '', $wp_head_markup );
    $wp_head_markup = str_replace( ' type="text/css"', '', $wp_head_markup );
    $wp_head_markup = str_replace( " type='text/css'", '', $wp_head_markup );
    echo $wp_head_markup;
}
// end remove "type" from script and style tags

//customise the read more link
function nightingale_2_0_read_more() {

    return '<div class="nhsuk-action-link">
  <a class="nhsuk-action-link__link" href="'.get_permalink().'"><svg class="nhsuk-icon nhsuk-icon__arrow-right-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
      <path d="M0 0h24v24H0z" fill="none"></path>
      <path d="M12 2a10 10 0 0 0-9.95 9h11.64L9.74 7.05a1 1 0 0 1 1.41-1.41l5.66 5.65a1 1 0 0 1 0 1.42l-5.66 5.65a1 1 0 0 1-1.41 0 1 1 0 0 1 0-1.41L13.69 13H2.05A10 10 0 1 0 12 2z"></path>
    </svg><span class="nhsuk-action-link__text">read more</span><span class="nhsuk-u-visually-hidden"> about '.get_the_title().'</span></a></div>';
}



add_filter( 'excerpt_more', 'nightingale_2_0_read_more', 10, 1 );




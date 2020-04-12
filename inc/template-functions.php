<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   1.1 21st August 2019
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function nightingale_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	$classes[] = nightingale_get_header_style();

	return $classes;
}

add_filter( 'body_class', 'nightingale_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function nightingale_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'nightingale_pingback_header' );

if ( ! function_exists( 'nightingale_get_header_style' ) ) {
	/**
	 * Figure whether we are using standard blue header with white text, or an inverse header which is white with blue / grey text.
	 *
	 * @return string $default_position.
	 */
	function nightingale_get_header_style() {

		$themeoptions_header_style = get_theme_mod( 'theme-header-style', 'default' );

		if ( 'default' === $themeoptions_header_style ) {
			$default_position = 'page-header-default';
		} elseif ( 'centered' === $themeoptions_header_style ) {
			$default_position = 'page-header-white';
		}

		return $default_position;
	}
}


/**
 * Adds Correct Class to excerpt paragraph tag
 *
 * @param string $excerpt the_expert html.
 */
function nightingale_add_class_to_excerpt( $excerpt ) {
	return str_replace( '<p>', '<p class="nhsuk-promo__description">', $excerpt );
}

add_filter( 'the_excerpt', 'nightingale_add_class_to_excerpt' );

/**
 * Shortens the excerpt to 20 char
 *
 * @param int $length length to shorten content to.
 */
function nightingale_shorten_excerpt( $length ) {
	if ( is_admin() ) {
		return $length;
	}

	return 20;
}

add_filter( 'excerpt_length', 'nightingale_shorten_excerpt', 20 );


/**
 * Customise the read more link
 */
function nightingale_read_more() {
	return null;
}


add_filter( 'excerpt_more', 'nightingale_read_more', 10, 1 );


/**
 * Customise the read more link.
 *
 * @param string $title The title for the link (used in visually hidden area for screen readers to better describe the link).
 * @param string $link  The href of the resource being linked to.
 *                      return string output html.
 */
function nightingale_read_more_posts( $title, $link ) {

	return '<div class="nhsuk-action-link">
  <a class="nhsuk-action-link__link" href="' . $link . '"><svg class="nhsuk-icon nhsuk-icon__arrow-right-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
	  <path d="M0 0h24v24H0z" fill="none"></path>
	  <path d="M12 2a10 10 0 0 0-9.95 9h11.64L9.74 7.05a1 1 0 0 1 1.41-1.41l5.66 5.65a1 1 0 0 1 0 1.42l-5.66 5.65a1 1 0 0 1-1.41 0 1 1 0 0 1 0-1.41L13.69 13H2.05A10 10 0 1 0 12 2z"></path>
	</svg><span class="nhsuk-action-link__text">' . esc_html_e( 'read more', 'nightingale' ) . '</span><span class="nhsuk-u-visually-hidden"> about ' . $title . '</span></a></div>';

}

/**
 * Whether show sidebar returns true or false
 */
function nightingale_show_sidebar() {
	return ( 'true' === get_theme_mod( 'blog_sidebar' ) );
}

/**
 * Determine if page should have sidebar on left or right, and return additional class if required.
 *
 * @param string $sidebar location string for sidebar.
 */
function nightingale_sidebar_location( $sidebar ) {
	$sidebar_location = get_theme_mod( 'sidebar_location', 'right' );
	$sidefloat        = 'contentleft';
	if ( 'right' !== $sidebar_location ) {
		if ( is_active_sidebar( $sidebar ) ) {
			$sidefloat = ' contentright';
		}
	}

	return $sidefloat;
}

<?php
/**
 * Generate breadcrumbs
 * Get path to current page and leave breacrumb trail for users to navigate back up the decision tree
 *
 * @link      https://developer.wordpress.org/themes/basics/template-files/
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   1.1 21st August 2019
 */

/**
 *  Create the breadcrumb
 *
 * @param int     $id        Post id of the page being queried.
 * @param boolean $link      Should current page be linked or not.
 * @param string  $separator Add any fancy separators.
 * @param string  $nicename  Clean up the name or not.
 * @param array   $visited   Has this page been visited.
 * @param boolean $iscrumb   Is this to be added to the breadcrumb.
 *
 * @return array  $chain
 */
function nightingale_category_parents( $id, $link = false, $separator = '', $nicename = false, $visited = array(), $iscrumb = false ) {
	$chain  = '';
	$parent = get_term( $id, 'category' );
	if ( is_wp_error( $parent ) ) {
		return $parent;
	}
	if ( $nicename ) {
		$name = $parent->slug;
	} else {
		$name = $parent->name;
	}
	if ( $parent->parent && ( $parent->parent !== $parent->term_id ) && ! in_array( $parent->parent, $visited, true ) ) {
		$visited[] = $parent->parent;
		$chain    .= '<li class="nhsuk-breadcrumb__item"><a itemprop="item" href="' . get_category_parents( $parent->parent, $link, $separator, $nicename ) . '</li>' . $separator;
	}
	if ( $iscrumb ) {
		$chain .= '<li class="nhsuk-breadcrumb__item"><a itemprop="item" href="' . esc_url( get_category_link( $parent->term_id ) ) . '">' . $name . '</a></li>' . $separator;
	} elseif ( $link && ! $iscrumb ) {
		$chain .= '<li class="nhsuk-breadcrumb__item"><a itemprop="item" href="' . esc_url( get_category_link( $parent->term_id ) ) . '">' . $name . '</a>' . $separator . '</li>';
	} else {
		$chain .= '<li class="nhsuk-breadcrumb__item">' . $name . $separator . '</li>';
	}

	return $chain;
}

/**
 * Check to see if LearnDash extension Uncanny Toolkit is running.
 *
 * @return bool
 */
function nightingale_uncanny_breadcrumb_check() {
	if ( in_array( 'uncanny-learndash-toolkit/uncanny-learndash-toolkit.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
		$uo_active_classes = get_option( 'uncanny_toolkit_active_classes', 0 );
		if ( 0 !== $uo_active_classes ) {
			if ( ! key_exists( 'uncanny_learndash_toolkit\Breadcrumbs', $uo_active_classes ) ) {
				return false; // plugin is active but breadcrumbs aren't turned on.
			}
		}
		$classes = get_body_class();
		$matches = preg_grep( '/sfwd/i', $classes );
		if ( count( $matches ) > 0 ) {
			return true; // this is a LearnDash page, the Uncanny Toolkit is installed and the breadcrumb is active.
		} else {
			return false; // this isn't a Learndash page.
		}
	} else {
		return false; // plugin isn't active.
	}
}


/**
 * Nightingale Breadcrumb.
 * Generate the breadcrumb trail.
 *
 * @return string $breadcrumbs.
 */
function nightingale_breadcrumb() {
	if ( is_home() && is_front_page() ) {
		return;
	}
	if ( true === nightingale_uncanny_breadcrumb_check() ) {
		$breadcrumbs = uo_breadcrumbs( false );
	} else {
		$back_one_level                 = empty( $back_one_level ) ? array( esc_url( home_url() ), __( 'Home', 'nightingale' ) ) : $back_one_level;
		list( $trail, $back_one_level ) = nightingale_breadcrumb_trail();
		$breadcrumbs                    = sprintf(
			'<ol class="nhsuk-breadcrumb__list"><li class="nhsuk-breadcrumb__item"><a href="%2$s">%3$s</a></li>%1$s</ol>',
			$trail,
			esc_url( home_url() ),
			esc_html( __( 'Home', 'nightingale' ) )
		);
	}
	ob_start();
	if ( true === nightingale_uncanny_breadcrumb_check() ) {
		echo '<style>
			.ld-breadcrumbs {
				position: relative;
			}
			.ld-breadcrumbs-segments {
				display: none !important;
			}
			.ld-status {
				position: absolute;
				right: 0;
			}
		</style>';
	}

	printf(
		'<nav class="nhsuk-breadcrumb" aria-label="Breadcrumb"><div class="nhsuk-width-container">%1$s <p class="nhsuk-breadcrumb__back"><a class="nhsuk-breadcrumb__backlink" href="%2$s"> %3$s %4$s</a></p></div></nav>',
		$breadcrumbs, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		esc_url( $back_one_level[0] ),
		esc_html( 'Back to ', 'nightingale' ),
		esc_html( $back_one_level[1] )
	);

	$output = ob_get_clean();

	return $output;
}

/**
 * Nightingale Breadcrumb Trail Creation
 *
 * @return array - array of relevant links and titles.
 */
function nightingale_breadcrumb_trail() {
	global $wp_query;
	$back_one_level = empty( $back_one_level ) ? array( esc_url( home_url() ), __( 'Home', 'nightingale' ) ) : $back_one_level;
	$trail          = '';
	if ( is_category() ) {
		$cat_obj    = $wp_query->get_queried_object();
		$this_cat   = get_category( $cat_obj->term_id );
		$parent_cat = get_category( $this_cat->parent );
		if ( 0 !== $this_cat->parent ) {
			$cat_parents = nightingale_category_parents( $parent_cat, true, '', false, array(), true );
		}
		if ( 0 !== $this_cat->parent && ! is_wp_error( $cat_parents ) ) {
			$trail = $cat_parents; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		$trail .= '<li class="nhsuk-breadcrumb__item"><a  href="' . esc_url( get_category_link( $this_cat ) ) . '">' . esc_html( single_cat_title( '', false ) ) . '</a></li>';
	} elseif ( is_post_type_archive( 'tribe_events' ) ) {
		$trail = '<li class="nhsuk-breadcrumb__item">' . esc_html( tribe_get_event_label_plural() ) . '</li>';
	} elseif ( is_archive() && ! is_category() ) {
		$trail = '<li class="nhsuk-breadcrumb__item">' . esc_html( 'Archives', 'nightingale' ) . '</li>';
	} elseif ( is_search() ) {
		$trail = '<li class="nhsuk-breadcrumb__item">' . esc_html( 'Search Results', 'nightingale' ) . '</li>';
	} elseif ( is_404() ) {
		$trail = '<li class="nhsuk-breadcrumb__item">' . esc_html( '404 Not Found', 'nightingale' ) . '</li>';
	} elseif ( is_singular( 'post' ) ) {
		$category    = get_the_category();
		$category_id = get_cat_ID( $category[0]->cat_name );
		$cat_parents = nightingale_category_parents( $category_id, true, '', false, array(), true );
		if ( ! is_wp_error( $cat_parents ) ) {
			$trail .= $cat_parents; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	} elseif ( is_singular( 'attachment' ) ) {
		$trail = '<li class="nhsuk-breadcrumb__item">' . the_title() . '</li>';
	} elseif ( is_singular( 'tribe_events' ) ) {
		$post   = $wp_query->get_queried_object();
		$trail  = '<li class="nhsuk-breadcrumb__item"><a href="' . esc_url( tribe_get_events_link() ) . '">' . esc_html( tribe_get_event_label_plural() ) . '</a></li>';
		$trail .= '<li class="nhsuk-breadcrumb__item event">' . esc_html( get_the_title( $post ) ) . '</li>';
	} elseif ( is_page() ) {
		$post = $wp_query->get_queried_object();
		if ( 0 !== $post->post_parent ) {
			$title     = the_title( '', '', false );
			$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
			array_push( $ancestors, $post->ID );
			$home_page = get_option( 'page_on_front' );
			foreach ( $ancestors as $ancestor ) {
				if ( ( end( $ancestors ) !== $ancestor ) && ( ( $home_page !== $ancestor ) ) ) {
					$trail         .= '<li class="nhsuk-breadcrumb__item"> <a href="' . esc_url( get_permalink( $ancestor ) ) . '">' . esc_html( wp_strip_all_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ) ) . '</span></a></li>';
					$back_one_level = array(
						esc_url( get_permalink( $ancestor ) ),
						wp_strip_all_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ),
					);
				}
			}
			$parent         = $post->post_parent;
			$back_one_level = array( get_permalink( $parent ), get_the_title( $parent ) );
		}
	}

	if ( ! ( is_archive() || is_category() || is_post_type_archive() || is_search() || is_404() || is_singular( 'tribe_events' ) ) ) {
		$trail .= '<li class="nhsuk-breadcrumb__item current">' . esc_html( get_the_title() ) . '</li>';
	}

	return array( apply_filters( 'nightingale_modify_breadcrumb', $trail ), $back_one_level );
}

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

/*
 * Add excerpt ability to posts so the excerpt can be used in search results.
 */
add_post_type_support( 'page', 'excerpt' );

/**
 * Adds Correct Class to excerpt paragraph tag
 *
 * @param string $excerpt the_expert html.
 */
function nightingale_add_class_to_excerpt( $excerpt ) {
	if ( is_admin() ) {
		return $excerpt;
	}

	return str_replace( '<p>', '<p class="nhsuk-card__description">', $excerpt );
}

add_filter( 'the_excerpt', 'nightingale_add_class_to_excerpt', 10 );

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

add_filter( 'excerpt_length', 'nightingale_shorten_excerpt', 10 );

/**
 * Customise the read more link.
 *
 * @param string $title The title for the link (used in visually hidden area for screen readers to better describe the link).
 * @param string $link  The href of the resource being linked to.
 *                      return string output html.
 */
function nightingale_read_more_posts( $title, $link ) {

	$readmorelink = '<div class="nhsuk-action-link nhsuk-readmore">';
	if ( '' !== $link ) {
		$readmorelink .= '<a class="nhsuk-card__link nhsuk-action-link__link" href="' . $link . '">';
	}
	$readmorelink .= '<span class="nhsuk-action-link__text">' . esc_html__( 'read more ', 'nightingale' ) . '</span><span class="nhsuk-u-visually-hidden">' . esc_html__( ' about ', 'nightingale' ) . $title . '</span><svg class="nhsuk-icon nhsuk-icon__arrow-right-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
	  <path d="M0 0h24v24H0z" fill="none"></path>
	  <path d="M12 2a10 10 0 0 0-9.95 9h11.64L9.74 7.05a1 1 0 0 1 1.41-1.41l5.66 5.65a1 1 0 0 1 0 1.42l-5.66 5.65a1 1 0 0 1-1.41 0 1 1 0 0 1 0-1.41L13.69 13H2.05A10 10 0 1 0 12 2z"></path>
	</svg>';
	if ( '' !== $link ) {
		$readmorelink .= '</a>';
	}
	$readmorelink .= '</div>';

	return $readmorelink;

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

/**
 * Get the custom colour name to return into the body class if required
 *
 * @param array $classes the pre-existing classes for a WordPress page.
 */
function nightingale_custom_page_colour( $classes ) {
    $colour = get_theme_mod( 'theme_colour', 'nhs_blue' );
    if ( '' !== $colour ) {
        if ( 'nhs_blue' !== $colour ) {
            $colour_array      = array(
                '005eb8' => 'nhs-blue',
                '003087' => 'dark-blue',
                '0072ce' => 'bright-blue',
                '768692' => 'mid-grey',
                '425563' => 'dark-grey',
                '231f20' => 'black',
                '330072' => 'purple',
                'ae2573' => 'pink',
                '704c9c' => 'light-purple',
                'da291c' => 'emergency-services-red',
                '006747' => 'dark-green',
                '78be20' => 'light-green',
                '00a499' => 'aqua-green',
                '0b0c0c' => 'gds-black',
            );
            $theme_colour_name = 'page-colour--' . $colour_array[ $colour ];
            $classes[]         = $theme_colour_name;
        }
    }
    return $classes;
}

add_filter( 'body_class', 'nightingale_custom_page_colour' );


/**
 * Function to sanitise content and remove empty elements that cause a11y and w3c validation errors.
 *
 * @param bool $b_print Boolean argument specifying whether or not to print the function output.
 *
 * @return mixed|string|string[]|void|null Return the sanitised output, or original output if flag set to false.
 */
function nightingale_clean_bad_content( $b_print = false ) {

	global $post;
	$nightingale_post_content  = $post->post_content;
	$nightingale_remove_filter = array( '~<p[^>]*>\s?</p>~', '~<a[^>]*>\s?</a>~', '~<h[^>]*>\s?</h[^>]>~', '~<font[^>]*>~', '~<\/font>~' );
	$nightingale_post_content  = preg_replace( $nightingale_remove_filter, '', $nightingale_post_content );
	$nightingale_post_content  = apply_filters( 'the_content', $nightingale_post_content );
	if ( false === $b_print ) {
		return $nightingale_post_content;
	} else {
		echo $nightingale_post_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Function to display dropdown of categories for filtering of posts display.
 *
 * @param int   $catcount   - the number of categories in the original block setup if it is set to specifics.
 * @param array $categories - array of categories in the block setup if it is set to all categories.
 * @param array $catout     - array of categories in the block setup if it is set to specifics.
 */
function nightingale_latest_posts_category_filter( $catcount, $categories, $catout = array() ) {
	$postfilter = wp_unslash( isset( $_POST['cat_filter'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
	if ( ( $catcount > 1 ) || ( empty( $categories ) ) ) : // there is more than one category, or _all_ categories are available.
		echo '<div class="nhsuk-width-container nhsuk-cat-filter"><span style="float: right;"><form action="" method="post">';
		echo '<label class="nhsuk-u-visually-hidden" for="cat_filter">' . esc_html__( 'Filter the posts you can see', 'nightingale' ) . '</label>';
		if ( $catcount > 1 ) : // there is more than one category.
			echo '<select name="cat_filter" id="cat_filter" class="nhsuk-select"><option value="0"></option>';
			foreach ( $catout as $catfiltered ) {
				echo '<option value="' . esc_attr( $catfiltered ) . '">' . esc_html( get_cat_name( $catfiltered ) ) . '</option>';
			}
			echo '</select>';
		elseif ( empty( $categories ) ) : // or _all_ categories are available.
			wp_dropdown_categories(
				array(
					'hide_if_empty'   => true,
					'name'            => 'cat_filter',
					'orderby'         => 'name',
					'selected'        => $postfilter,
					'hierarchical'    => true,
					'class'           => 'nhsuk-select',
					'show_option_all' => __( 'Show All', 'nightingale' ),
				)
			);
		endif;
		wp_nonce_field( 'latest-post-cat-selection', 'cat-selector' );
		echo '</form></span></div>';
		wp_enqueue_script( 'latest-posts-category', get_template_directory_uri() . '/js/latest-posts-category.js', '', '1.0', true );

		elseif ( $postfilter ) :
			echo '<div class="nhsuk-width-container nhsuk-cat-filter">';
			echo '<h2 class="nhsuk-heading-m">';
			esc_html_e( 'Showing Posts from the category ', 'nightingale' );
			echo esc_html( get_cat_name( $postfilter ) ) . '</h2><span class="nhsuk-cat-reset">';
			echo '<form action="" method="post"><input type="hidden" name="cat_filter" value=""0" /><input type="submit" class="nhsuk-button" value="' . esc_html__( 'Reset Filter', 'nightingale' ) . '" /></form>';
			echo '</span></div>';
	endif;
}
add_filter( 'comment_form_field_cookies', 'nightingale_style_comment_cookies' );
/**
 * Modify the markup of the comment cookie checkbox to match nhsuk styled output.
 *
 * @return string corrected output
 */
function nightingale_style_comment_cookies() {
	return '<p class="comment-form-cookies-consent nhsuk-checkboxes__item">
				<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" class="nhsuk-checkboxes__input" value="yes">
				<label class="nhsuk-checkboxes__label" for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'nightingale' ) . '</label>
			</p>';
}

add_filter( 'comment_form_defaults', 'nightingale_comment_defaults' );

/**
 * Function to clean up the comment form and use nhs markup
 *
 * @param string $defaults the original default fields for comments.
 *
 * @return string
 */
function nightingale_comment_defaults( $defaults ) {
	$defaults['class_container'] = 'nhsuk-form-group';
	$defaults['submit_button']   = '<input name="%1$s" type="submit" id="%2$s" class="nhsuk-button %3$s" value="%4$s" />';
	return $defaults;
}

add_filter( 'cancel_comment_reply_link', 'nightingale_cancel_comment_link' );

/**
 * Function to add nhsuk button styling to cancel comment link
 *
 * @param string $link the original markup for the link.
 *
 * @return string|string[]
 */
function nightingale_cancel_comment_link( $link ) {
	$link = str_replace( 'id="cancel-comment-reply-link"', 'id="cancel-comment-reply-link" class="nhsuk-button nhsuk-button--reverse"', $link );
	return $link;
}


add_filter( 'get_comment_author_link', 'nightingale_comments', 98 );

/**
 * Function to add tag markup to comments
 *
 * @param string $return the original markup.
 *
 * @return string $return the corrected markup
 */
function nightingale_comments( $return ) {
	$return = str_replace( 'comment-author-label-administrator', 'nhsuk-tag--aqua-green', $return );
	$return = str_replace( 'comment-author-label-facilitator', 'nhsuk-tag--blue', $return );
	$return = str_replace( 'comment-author-label', 'comment-author-label nhsuk-tag', $return );
	return $return;
}

/**
 * Function to modify markup on menu list items
 *
 * @param array $classes the original classes.
 * @param int   $item the item in question.
 * @param array $args the arguments for this element.
 *
 * @return array $classes the modified class array.
 */
function nightingale_additional_menu_class_on_li( $classes, $item, $args ) {
	if ( isset( $args->add_li_class ) ) {
		$classes[] = $args->add_li_class;
	}
	return $classes;
}

add_filter( 'nav_menu_css_class', 'nightingale_additional_menu_class_on_li', 1, 3 );

/**
 * Function to modify markup on menu links
 *
 * @param array $atts the menu attributes.
 * @param int   $item the item in question.
 * @param array $args the arguments for this element.
 *
 * @return mixed the returned corrected argument
 */
function nightingale_additional_menu_class_on_a( $atts, $item, $args ) {
	if ( property_exists( $args, 'link_class' ) ) {
		$atts['class'] = $args->link_class;
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'nightingale_additional_menu_class_on_a', 1, 3 );

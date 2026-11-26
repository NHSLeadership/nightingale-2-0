<?php
/**
 * Replace css classes in standard navigation with Nightingale classes
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 **/

/**
 * Paginate archived pages
 */
function nightingale_archive_pagination() {

	$args = array(
		'prev_text' => '<span class="nhsuk-pagination__title">' . esc_html__( 'Previous', 'nightingale' ) . '</span>
								<span class="nhsuk-u-visually-hidden">:</span>
								<svg class="nhsuk-icon nhsuk-icon--arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
								  <path d="M10.7 6.3c.4.4.4 1 0 1.4L7.4 11H19a1 1 0 0 1 0 2H7.4l3.3 3.3c.4.4.4 1 0 1.4a1 1 0 0 1-1.4 0l-5-5A1 1 0 0 1 4 12c0-.3.1-.5.3-.7l5-5a1 1 0 0 1 1.4 0Z"/>
								</svg>',
		'next_text' => '<span class="nhsuk-pagination__title">' . esc_html__( 'Next', 'nightingale' ) . '</span>
								<svg class="nhsuk-icon nhsuk-icon--arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
								  <path d="m14.7 6.3 5 5c.2.2.3.4.3.7 0 .3-.1.5-.3.7l-5 5a1 1 0 0 1-1.4-1.4l3.3-3.3H5a1 1 0 0 1 0-2h11.6l-3.3-3.3a1 1 0 1 1 1.4-1.4Z"/>
								</svg>',
	);

	$paginate = paginate_links(
		array(
			'mid_size'           => 2,
			'prev_text'          => $args['prev_text'],
			'next_text'          => $args['next_text'],
			'type'               => 'array',
			'before_page_number' => '<span class="nhsuk-u-visually-hidden">Page </span>',
		)
	);

	if ( $paginate ) {

		$pagination = '<div class="navigation"><nav class="nhsuk-pagination" role="navigation" aria-label="Pagination"><ul class="nhsuk-list nhsuk-pagination__list">';

		$count = count( $paginate ) - 1;

		$first_item = array_slice( $paginate, 0, 1 )[0];
		$last_item  = array_slice( $paginate, $count, 1 )[0];

		$prev_markup = '';
		$next_markup = '';

		// Capture next, to output later.
		if ( false !== strpos( $last_item, 'class="next page-numbers"' ) ) {
			$next_markup = "<li class='nhsuk-pagination-item--next'>{$last_item}</li>";
			array_pop( $paginate );
		}

		// Capture prev, to output later.
		if ( false !== strpos( $first_item, 'class="prev page-numbers"' ) ) {
			$prev_markup = "<li class='nhsuk-pagination-item--previous'>{$first_item}</li>";
			array_shift( $paginate );
		}

		// Output in correct focus order: Previous -> Numbers -> Next.
		$pagination .= $prev_markup;

		$pagination .= "<li class='nhsuk-pagination-numbers'>";
		foreach ( $paginate as $element ) {
			$pagination .= $element;
		}
		$pagination .= '</li>';

		$pagination .= $next_markup;

		$pagination .= '</ul></nav></div>';

		echo $pagination; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

/**
 * Add in a previous and next functionality
 */
function nightingale_get_prev_next() {
	echo '<div class="navigation">
	<nav class="nhsuk-pagination" role="navigation" aria-label="Pagination">
  <ul class="nhsuk-list nhsuk-pagination__list">';
	echo nightingale_the_post_navigation(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo '</ul></nav></div>';
}

/**
 * Add in a method to go backwards and forwards between posts.
 *
 * @param array $args the arguments coming in to the function.
 *
 * @return string the output.
 */
function nightingale_the_post_navigation( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'prev_text'          => '<span class="nhsuk-pagination__title">Previous</span>
									<span class="nhsuk-u-visually-hidden">:</span>
									<span class="nhsuk-pagination__page">%title</span>
									<svg class="nhsuk-icon nhsuk-icon--arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
									  <path d="M10.7 6.3c.4.4.4 1 0 1.4L7.4 11H19a1 1 0 0 1 0 2H7.4l3.3 3.3c.4.4.4 1 0 1.4a1 1 0 0 1-1.4 0l-5-5A1 1 0 0 1 4 12c0-.3.1-.5.3-.7l5-5a1 1 0 0 1 1.4 0Z"/>
									</svg>',
			'next_text'          => '<span class="nhsuk-pagination__title">Next</span>
									<span class="nhsuk-u-visually-hidden">:</span>
									<span class="nhsuk-pagination__page">%title</span>
									<svg class="nhsuk-icon nhsuk-icon--arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
									  <path d="m14.7 6.3 5 5c.2.2.3.4.3.7 0 .3-.1.5-.3.7l-5 5a1 1 0 0 1-1.4-1.4l3.3-3.3H5a1 1 0 0 1 0-2h11.6l-3.3-3.3a1 1 0 1 1 1.4-1.4Z"/>
									</svg>',
			'in_same_term'       => false,
			'excluded_terms'     => '',
			'taxonomy'           => 'category',
			'screen_reader_text' => __( 'Post navigation', 'nightingale' ),
		)
	);

	$navigation = '';

	$previous = get_previous_post_link(
		'<li class="nhsuk-pagination-item--previous">%link</li>',
		$args['prev_text'],
		$args['in_same_term'],
		$args['excluded_terms'],
		$args['taxonomy']
	);

	$next = get_next_post_link(
		'<li class="nhsuk-pagination-item--next">%link</li>',
		$args['next_text'],
		$args['in_same_term'],
		$args['excluded_terms'],
		$args['taxonomy']
	);

	// Only add markup if there's somewhere to navigate to.
	if ( $previous || $next ) {
		$navigation = $previous . $next;
	}

	return $navigation;
}

/**
 * Filter wp_link_pages to do both next and number for post broken into multiple pages.
 */

add_filter( 'wp_link_pages_args', 'nightingale_link_pages_args_prevnext_add' );
/**
 * Add prev and next links to a numbered link list
 *
 * @param array $args the values passed in to create the links.
 */
function nightingale_link_pages_args_prevnext_add( $args ) {
	global $page, $numpages;
	$args['before'] .= '<nav class="pagination_split_post">'; // Put the pagenav links into their own region.
	$args['after']  .= '</nav>'; // End pagenav links.
	if ( $page - 1 ) {
		// there is a previous page.
		$args['before'] .= _wp_link_page( $page - 1 ) . $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a>';
	}

	if ( $page < $numpages ) {
		// there is a next page.
		$args['after'] = _wp_link_page( $page + 1 ) . $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . '</a>' . $args['after'];
	}

	return $args;
}

/**
 * Add a class to previous link in pagination
 *
 * @param string $format the original markup.
 */
function nightingale_posts_link__class( $format ) {
	$format = str_replace( 'href=', 'class="nhsuk-pagination__link" href=', $format );
	return $format;
}
add_filter( 'next_post_link', 'nightingale_posts_link__class' );
add_filter( 'previous_post_link', 'nightingale_posts_link__class' );

add_filter( 'wp_link_pages_link', 'nightingale_split_post_pagination' );

/**
 * Function to add tag markup to pagination output
 *
 * @param string $output the original markup.
 *
 * @return string $output the corrected markup
 */
function nightingale_split_post_pagination( $output ) {
	$output = str_replace( '"post-page-numbers current"', '"post-page-numbers current nhsuk-tag nhsuk-tag--white"', $output );
	$output = str_replace( '"post-page-numbers"', '"post-page-numbers nhsuk-tag nhsuk-tag--grey"', $output );
	return $output;
}

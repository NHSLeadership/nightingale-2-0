<?php
/**
 * Nightingale 2.0 rendering of The Events Calendar plugin output.
 *
 * @link      https://developer.wordpress.org/themes/basics/theme-functions/
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   1.0 18th February 2020
 */

/**
 * Add Sidebar to events section
 */
function nightingale_widgets_events() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Events Sidebar', 'nightingale' ),
			'id'            => 'events-side',
			'description'   => esc_html__( 'Elements to show in the page sidebar. each widget will show as a panel. If empty you will have a blank right hand panel.', 'nightingale' ),
			'before_widget' => '<section id="%1$s" class="nhsuk-related-nav %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="nhsuk-related-nav__heading">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'nightingale_widgets_events', 10 );


/**
 * Remove end time of event on event archive page
 *
 * @link https://gist.github.com/b76421f2490a8b8995493f203e11b331
 *
 * @param array $formatting_details how will we show this.
 *
 * @return array
 */
function nightingale_remove_end_time_single( $formatting_details ) {
	$formatting_details['show_end_time'] = 0;

	return $formatting_details;
}

add_filter( 'tribe_events_event_schedule_details_formatting', 'nightingale_remove_end_time_single', 10, 2 );


/**
 * Location of Calendar Events folder so can change easily.
 */
function nightingale_events_template_location() {
	return 'tribe/events/';
}


/**
 * The Events Calendar and related plugins: Add your own location for template file loading.
 *
 * @link https://gist.github.com/b76421f2490a8b8995493f203e11b331
 * @see  \Tribe__Events__Templates::getTemplateHierarchy()
 *
 * @param string $file     The full file path trying to be loaded.
 * @param string $template The template name, such as.
 *
 * @return string
 */
function nightingale_additional_template_locations( $file, $template ) {

	// this only works for old template files, not the new ones for now.

	$directory = nightingale_events_template_location();

	$template_folder = [
		'tribe' => trailingslashit( get_template_directory() ) . $directory,
	];

	foreach ( $template_folder as $location ) {

		$new_file = trailingslashit( $location ) . $template;

		if ( file_exists( $new_file ) ) {

			return $new_file;
		}
	}

	return $file;

}

add_filter( 'tribe_events_template', 'nightingale_additional_template_locations', 10, 2 );


/**
 * Add Classes to the link on single events pages to make them styled correctly
 *
 * @param string $link The link on single events pages.
 *
 * @return string
 */
function nightingale_modify_link_class( $link ) {

	$modified_link = str_replace(
		'">', // string to search for.
		'" class="nhsuk-pagination__link">', // what to replace it with.
		$link // the string to search through.
	);

	return $modified_link;
}

add_filter( 'tribe_events_get_event_link', 'nightingale_modify_link_class', 10 );


/**
 * Add Events Meta Data into the post archive template
 */
function nightingale_add_meta_content_events() {

	if ( ! is_post_type_archive( 'tribe_events' ) ) {
		return;
	}

	$location = nightingale_events_template_location() . 'v2/';

	get_template_part( $location . 'events-meta' );

}

add_action( 'nightingale_before_archive_content', 'nightingale_add_meta_content_events' );

/**
 * Add Events Categories into the post archive template
 */
function nightingale_add_event_cats() {

	if ( ! is_post_type_archive( 'tribe_events' ) ) {
		return;
	}

	$location = nightingale_events_template_location() . 'v2/';

	get_template_part( $location . 'events-categories' );

}

add_action( 'nightingale_after_archive_content', 'nightingale_add_event_cats' );

/**
 * SVG Icons used in the events section added here so is easy to change in the future if needed
 *
 * @return array
 */
function nightingale_events_icons() {
	return array(
		'calendar' => '<svg class="nhsuk-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M400 64h-48V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H160V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm-6 400H54c-3.3 0-6-2.7-6-6V160h352v298c0 3.3-2.7 6-6 6z"/></svg>',
		'marker'   => '<svg class="nhsuk-icon map-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M192 0C85.903 0 0 86.014 0 192c0 71.117 23.991 93.341 151.271 297.424 18.785 30.119 62.694 30.083 81.457 0C360.075 285.234 384 263.103 384 192 384 85.903 297.986 0 192 0zm0 464C64.576 259.686 48 246.788 48 192c0-79.529 64.471-144 144-144s144 64.471 144 144c0 54.553-15.166 65.425-144 272zm-80-272c0-44.183 35.817-80 80-80s80 35.817 80 80-35.817 80-80 80-80-35.817-80-80z"/></svg>',
		'wallet'   => '<svg class="nhsuk-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M448 112V96c0-35.35-28.65-64-64-64H96C42.98 32 0 74.98 0 128v256c0 53.02 42.98 96 96 96h352c35.35 0 64-28.65 64-64V176c0-35.35-28.65-64-64-64zm16 304c0 8.82-7.18 16-16 16H96c-26.47 0-48-21.53-48-48V128c0-26.47 21.53-48 48-48h288c8.82 0 16 7.18 16 16v32H112c-8.84 0-16 7.16-16 16s7.16 16 16 16h336c8.82 0 16 7.18 16 16v240zm-80-160c-17.67 0-32 14.33-32 32s14.33 32 32 32 32-14.33 32-32-14.33-32-32-32z"/></svg>',
		'tag'      => '<svg class="nhsuk-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M497.941 225.941L286.059 14.059A48 48 0 0 0 252.118 0H48C21.49 0 0 21.49 0 48v204.118a47.998 47.998 0 0 0 14.059 33.941l211.882 211.882c18.745 18.745 49.137 18.746 67.882 0l204.118-204.118c18.745-18.745 18.745-49.137 0-67.882zM259.886 463.996L48 252.118V48h204.118L464 259.882 259.886 463.996zM192 144c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48z"/></svg>',
	);
}

/**
 * Gets the start and end dates and turns them into human readable format.
 *
 * @param string $date_format how do we want to show the date.
 */
function nightingale_start_end_event( $date_format ) {


	$all_day = get_post_meta( get_the_id(), '_EventAllDay', true );

	$time_format     = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT ); // get time format.
	$event_date_attr = tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
	$start_date      = tribe_get_start_date( null, false, $date_format ); // start date in correct format.

	$start_time = ! $all_day ? tribe_get_start_date( null, false, $time_format ) : ''; // start time in time format.
	$end_date   = tribe_get_end_date( null, false, $date_format ); // end date in correct format.
	$end_time   = ! $all_day ? tribe_get_end_date( null, false, $time_format ) : ''; // end time in time format.
	$end        = $end_date === $start_date ? $end_time : $end_date . ' ' . $end_time; // if start and end date are the same, just show the time.

	return array(
		'start-date'      => $start_date,
		'start-time'      => $start_time,
		'end-date'        => $end_date,
		'end-time'        => $end_time,
		'end'             => $end,
		'all_day'         => $all_day,
		'event_date_attr' => $event_date_attr,
	);
}


/**
 * Enqueue scripts and styles.
 */
function nightingale_events_scripts() {

	if ( is_post_type_archive( 'tribe_events' ) ) {

		$event_js = '/js/events-category.js';

		wp_enqueue_script( 'nightingale-events-cat', get_template_directory_uri() . $event_js, array( 'jquery' ), filemtime( get_template_directory() . $event_js ), true );
	}

}

add_action( 'wp_enqueue_scripts', 'nightingale_events_scripts' );

add_action(
	'wp_enqueue_scripts',
	function () {

		// This is based on using the "skeleton styles" option.
		$styles = [
			'tribe-common-full-style',
		];

		wp_deregister_style( $styles );

	},
	99
);

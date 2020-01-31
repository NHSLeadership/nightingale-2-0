<?php

function tribe_remove_end_time_single( $formatting_details ) {
	$formatting_details['show_end_time'] = 0;

	return $formatting_details;
}
add_filter( 'tribe_events_event_schedule_details_formatting', 'tribe_remove_end_time_single', 10, 2);


/**
 * The Events Calendar and related plugins: Add your own location for template file loading.
 *
 * @link https://gist.github.com/b76421f2490a8b8995493f203e11b331
 *
 * @see \Tribe__Events__Templates::getTemplateHierarchy()
 *
 * @param string $file     The full file path trying to be loaded.
 * @param string $template The template name, such as
 *
 * @return string
 */

function tribe_additional_template_locations( string $file, string $template ) { 

// Put them in the order of priority (first location gets loaded before second location if first exists) 

$new_locations = [
		'my_plugin'   => trailingslashit( plugin_dir_path( __FILE__ ) ) . 'tribe-events',
];
 
foreach ( $new_locations as $location ) {
  $new_file = trailingslashit( $location ) . $template;
    if ( file_exists( $new_file ) ) {
      return $new_file;
    }
  }
 
  return $file;
}
 
// add_filter( 'tribe_events_template', 'tribe_additional_template_locations', 10, 2 );
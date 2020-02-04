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

function tribe_additional_template_locations( $file, $template ) { 


return trailingslashit( get_theme_root() ) . 'nightingale-2-0/inc/tribe/' . $template;

 
}
 
// add_filter( 'tribe_events_template', 'tribe_additional_template_locations', 80, 2 );

function nightingale_modify_link_class( $link ){

	$modified_link = str_replace(
		'">', // string to search for
		'" class="nhsuk-pagination__link">', // what to replace it with
		$link // the string to search through
	);

	return $modified_link;
}

add_filter('tribe_events_get_event_link', 'nightingale_modify_link_class', 10 );
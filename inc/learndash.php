<?php
/**
 * Customised Learndash output markup
 *
 * @date         October 31st 2019
 * @version      1.0
 * @author       Tony Blacker
 * @organisation NHS Leadership Academy
 * @copyright    OGL v3
 * @package      Nightingale Theme
 */

add_filter(
	'learndash_content',
	function ( $content, $post ) {
		// create empty find and replace arrays.
		$find    = array();
		$replace = array();
		// search for whitespace and trim it down for later searches.
		$find[]    = '/\s\s+/';
		$replace[] = ' ';
		// sort out styling page titles.
		$find[]    = '#<header><h1>([^"]+)</h1></header>#';
		$replace[] = '<header class="entry-header"><h1 class="entry-title">$1</h1></header>';
		// sort out radio styling.
		$find[]    = '#<label> <input class="wpProQuiz_questionInput" type="radio" name="([^"]+)" value="([^"]+)">([^<]+)<\/label>#';
		$replace[] = '<div class="nhsuk-radios__item"><input class="nhsuk-radios__input" type="radio" name="$1" value="$2"><label class="nhsuk-label nhsuk-radios__label">$3</label></div>';
		// sort out checkbox styling.
		$find[]    = '#<label> <input class="wpProQuiz_questionInput" type="checkbox" name="([^"]+)" value="([^"]+)">([^<]+)<\/label>#';
		$replace[] = '<div class="nhsuk-checkboxes__item"><input class="nhsuk-checkboxes__input" type="radio" name="$1" value="$2"><label class="nhsuk-label nhsuk-checkboxes__label">$3</label></div>';
		$content   = preg_replace( $find, $replace, $content );

		return $content;
	},
	10,
	2
);

if ( is_plugin_active( 'learndash-course-grid/learndash_course_grid.php' ) ) {

    remove_filter('learndash_template', 'learndash_course_grid_course_list', 999999, 5);
    add_filter('learndash_template', 'nightingale_learndash_course_grid_course_list', 999999, 5);

    function nightingale_learndash_course_grid_course_list($filepath, $name, $args, $echo, $return_file_path)
    {

        if ($name == "course_list_template" && strpos($filepath, LEARNDASH_LMS_PLUGIN_DIR) !== false) {
            if ($args['shortcode_atts']['course_grid'] == 'false' ||
                $args['shortcode_atts']['course_grid'] === false ||
                empty($args['shortcode_atts']['course_grid'])) {
                return $filepath;
            }

            return apply_filters('learndash_course_grid_template',
                get_template_directory().'/learndash-course-grid/course_list_template.php', $filepath, $name, $args,
                $return_file_path);
        }

        return $filepath;
    }
}

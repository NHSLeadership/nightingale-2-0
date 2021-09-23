<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * This file controls the course list template and brings it inside the theme if course grid plugin exists.
 *
 * @since 2.3.1
 *
 * @package Nightingale
 */

if ( is_plugin_active( 'learndash-course-grid/learndash_course_grid.php' ) ) {
	include get_template_directory() . '/learndash-course-grid/course_list_template.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	// the above line is an include rather than a get_template_part as it is effectively a shortcode and needs variables carrying across.
	// get_template_part ignores all of these variables (such as the settings for category, how many items to show, show image etc etc.).
}

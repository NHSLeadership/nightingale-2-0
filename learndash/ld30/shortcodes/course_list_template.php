<?php // phpcs:ignore WordPress.Files.FileName.NotHyphenatedLowercase
/**
 * This file controls the course list template and brings it inside the theme if course grid plugin exists.
 *
 * @since 2.5.4
 *
 * @package Nightingale
 */

if ( is_plugin_active( 'learndash-course-grid/learndash_course_grid.php' ) ) {
	get_template_part( '/learndash-course-grid/course_list_template.php' );
}

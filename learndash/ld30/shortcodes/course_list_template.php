<?php

if ( is_plugin_active( 'learndash-course-grid/learndash_course_grid.php' ) ) {
	include( get_template_directory().'/learndash-course-grid/course_list_template.php');
} else {
    include ('course_list_template_orig.php');

}
?>

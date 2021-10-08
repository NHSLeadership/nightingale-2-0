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
		// sort out all the buttons in one go.
		// search for whitespace and trim it down for later searches.
		// sort out all the buttons in one go.
		$find[]    = '#ld-button#';
		$replace[] = 'nhsuk-button';
		$find[]    = '#btn-join#';
		$replace[] = 'nhsuk-button';
		$find[]    = '#ld-icon-arrow-down ld-icon ld-primary-background#';
		$replace[] = '';
		$find[]    = '#ld-text ld-primary-color#';
		$replace[] = '';
		$find[]    = '#ld-logout#';
		$replace[] = 'nhsuk-button nhsuk-button--secondary';
		$find[]    = '#ld-login#';
		$replace[] = 'nhsuk-button';
		$find[]    = '#button button-primary#';
		$replace[] = 'nhsuk-button';
		$find[]    = '#ld-search-prompt#';
		$replace[] = 'nhsuk-button nhsuk-button--reverse';
		$find[]    = '#ld-button-reverse#';
		$replace[] = 'nhsuk-button nhsuk-button--reverse';
		$find[]    = '#wpProQuiz_button#';
		$replace[] = 'nhsuk-button';
		$find[]    = '#wpProQuiz_QuestionButton#';
		$replace[] = 'nhsuk-button nhsuk-button--secondary';
		$find[]    = '#wpProQuiz_TipButton#';
		$replace[] = 'nhsuk-button nhsuk-button--reverse';
		$find[]    = '#learndash_mark_complete_button#';
		$replace[] = 'nhsuk-button nhsuk-mark-complete';
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

add_filter( 'the_content', 'nightingale_learndash_logins_rework', 99 );

/**
 * Modify LearnDash login/logout block to show as an nhsuk button
 *
 * @param string $content the raw html.
 *
 * @return string $content the modified html.
 */
function nightingale_learndash_logins_rework( $content ) {
	$content = str_replace( 'ld-login-button ld-button', 'nhsuk-button', $content );
	return $content;
}

/**
 * Modify login modal buttons.
 */
add_filter(
	'learndash_login_model_register_button_class',
	function( $register_button_class ) {
		// May add any custom logic using $register_button_class.
		$register_button_class .= ' nhsuk-button';
		// Always return $register_button_class.
		return $register_button_class;
	}
);

/**
 * Function to amend markup of modal output so that styling becomes native.
 *
 * @param string $content - the original markup.
 */
function nightingale_learndash_clean_modal_ouput( $content ) {
	$content = str_replace( 'button button-primary', 'nhsuk-button', $content );
	$content = str_replace( '<label ', '<label class="nhsuk-label" ', $content );
	$content = str_replace( 'type="text" ', 'type="text" class="nhsuk-input" ', $content );
	$content = str_replace( 'type="password" ', 'type="password" class="nhsuk-input" ', $content );
	return $content;
}

/**
 * Clean up the markup inside the learndash registration modal.
 *
 * @param string $content the original markup.
 *
 * @return string|string[]
 */
function nightingale_learndash_clean_modal_registration( $content ) {
	$content = nightingale_learndash_clean_modal_ouput( $content );
	return $content;
}

add_filter( 'learndash_status_bubble', 'nightingale_learndash_status_bubble' );

/**
 * Function to add tag markup to LD status bubbles
 *
 * @param string $content the original markup.
 *
 * @return string|string[]
 */
function nightingale_learndash_status_bubble( $content ) {
	$content = str_replace( 'ld-status ', 'nhsuk-tag" ', $content );
	$content = str_replace( 'ld-status-complete', 'nhsuk-tag--green" ', $content );
	$content = str_replace( 'ld-status-waiting', 'nhsuk-tag--yellow" ', $content );
	return $content;
}
if ( is_plugin_active( 'learndash-course-grid/learndash_course_grid.php' ) ) {

	add_action(
		'after_setup_theme',
		function() {
			remove_filter( 'learndash_template', 'learndash_course_grid_course_list', 999999, 5 );
		}
	);
	add_filter( 'learndash_template', 'nightingale_learndash_course_grid_course_list', 'learndash-course-grid', 999999, 5 );

	/**
	 * Function to output the learndash course grid using the correct layout.
	 *
	 * @param string  $filepath - path to the file.
	 * @param string  $name - filename.
	 * @param array   $args - array of arguments to create the output.
	 * @param boolean $echo - do we want this layout echod or stored for later use.
	 * @param string  $return_file_path - initial / default layout file.
	 *
	 * @return corrected filepath for output layout.
	 */
	function nightingale_learndash_course_grid_course_list( $filepath, $name, $args, $echo, $return_file_path ) {

		if ( 'course_list_template' === $name && false !== strpos( $filepath, LEARNDASH_LMS_PLUGIN_DIR ) ) {
			if ( false === $args['shortcode_atts']['course_grid'] ||
				false === $args['shortcode_atts']['course_grid'] ||
				empty( $args['shortcode_atts']['course_grid'] ) ) {
				return $filepath;
			}

			return apply_filters(
				'learndash_course_grid_template',
				get_template_directory() . '/learndash-course-grid/course_list_template.php',
				$filepath,
				$name,
				$args,
				$return_file_path
			);
		}

		return $filepath;
	}
}

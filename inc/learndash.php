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

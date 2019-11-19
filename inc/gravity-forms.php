<?php
/**
 * Customised Gravity Forms output markup
 *
 * @date September 26 2019
 * @version 1.0
 * @author Tony Blacker
 * @organisation NHS Leadership Academy
 * @copyright OGL v3
 * @package Nightingale Theme
 */

add_filter(
	'gform_get_form_filter',
	function ( $form_string, $form ) {

		// Replace form description span with <small> elements.
		$form_string = preg_replace( "#<span class='gform_description'>(.*?)</span>#", '<small>$1</small>', $form_string );

		// Style error messages.
		// Message at top of form.
		$form_string = str_replace( 'validation_error', 'c-form-input is-error validation_error', $form_string );
		// Fields with CSS class = "gfield_error".
		$form_string = str_replace( 'gfield_error', 'is-error gfield_error', $form_string );
		// Fields contained in <li> elements that have CSS class = "gfield_error".
		$form_string = preg_replace( "#<li(.*?)gfield_error(.*?)<input(.*?)class='#s", "<li$1gfield_error$2<input$3class='gfield_error is-error ", $form_string );
		// Error messages below fields.
		$form_string = str_replace( 'validation_message', 'c-form-error validation_message', $form_string );

		// Style <ul>.
		$form_string = str_replace( "class='gform_fields", "class='c-form-list gform_fields", $form_string );

		// Replace <h3> with <h2>.
		$form_string = str_replace( '<h3', '<h2', $form_string );
		$form_string = str_replace( '/h3>', '/h2>', $form_string );

		// Replace field description divs with <small> elements.
		$form_string = preg_replace( "#<div class='gfield_description'>(.*?)</div>#", "<span class='nhsuk-hint'>$1</span>", $form_string );

		// Replace field instruction divs with <small> elements.
		$form_string = preg_replace( "#<div class='instruction(.*?)>(.*?)</div>#", '<small>$2</small>', $form_string );

		// Indicate mandatory fields with "Required" rather than "*".
		$form_string = str_replace( "<span class='gfield_required'>*</span>", "&nbsp;&nbsp;<span class='gfield_required nhsuk-pill-standard nhsuk-pill-warn'>Required</span>", $form_string );

		// Replace main <label> elements with <strong>s.
		$form_string = preg_replace( "#<label class='gfield_label'(.*?)>(.*?)</label>#", '', $form_string );


		// Remove <ul>s around elements.
		$form_string = preg_replace( "#<ul class='gfield(.*?)>(.*?)</ul>#s", '$2', $form_string );


		// Style the submit button.
		$form_string = str_replace( 'gform_button', 'nhsuk-button gform_button', $form_string );

		return $form_string;
	},
	10,
	2
);

// Use gform_field_content to style individual fields.
// See https://docs.gravityforms.com/gform_field_content.
add_filter( 'gform_field_content', 'nightingale_clean_gf_inputs', 10, 2 );

/**
 *
 * Clean Gravity Forms inputs out
 *
 * @param string $field_content the rendered output of a GF generated object.
 * @param array  $field the initialised value of the field as created by GF.
 *
 * @return string
 */
function nightingale_clean_gf_inputs( $field_content, $field ) {
	if ( '' !== $field->validation_message ) {
		$errorflag  = 1;
		$grouperror = ' nhsuk-form-group--error';
	} else {
		$errorflag  = 0;
		$grouperror = '';
	}
	$fieldset = '<div class="nhsuk-form-group' . $grouperror . '"><fieldset class="nhsuk-fieldset" aria-describedby="example-hint">
                                      <legend class="nhsuk-fieldset__legend">
                                        ' . $field->label . '';
	if ( '' !== $field->isRequired ) {
		$fieldset .= '&nbsp;&nbsp;<span class="nhsuk-pill-warn">Required</span>';
	}
	if ( 1 === $errorflag ) {
		$fieldset .= '<span class="nhsuk-error-message">' . $field->validation_message . '</span>';
	}
	$fieldset .= '</legend>';
	if ( ! empty( $field->description ) ) {
		$fieldset .= '<span class="nhsuk-hint">
                                        ' . $field->description . '
                                      </span>';
	}
	$ender = '';
	$extra = '';
	if ( $field->gwreadonly_enable > 0 ) {
		$extra .= ' readonly';
	}
	$wrapper = '';
	$choices = ''; // initialise all the strings.

	switch ( $field->type ) {
		// Text inputs.
		case 'text':
			if ( 1 === $errorflag ) {
				$field_content = str_replace( "type='text' value='' class='", "type='text' value='' class='nhsuk-input nhsuk-input--error ", $field_content );
			} else {
				$field_content = str_replace( "type='text' value='' class='", "type='text' value='' class='nhsuk-input ", $field_content );
			}
			break;
		// Date inputs.
		case 'date':
			if ( 1 === $errorflag ) {
				$field_content = str_replace( "type='text' value='' class='", "type='text' value='' class='nhsuk-input nhsuk-input--width-5 nhsuk-input--error ", $field_content );
			} else {
				$field_content = str_replace( "type='text' value='' class='", "type='text' value='' class='nhsuk-input nhsuk-input--width-5 ", $field_content );
			}
			break;
		// Web address inputs.
		case 'website':
			if ( 1 === $errorflag ) {
				$field_content = str_replace( "type='url' value='' class='", "type='url' value='' class='nhsuk-input nhsuk-input--width-10 nhsuk-input--error ", $field_content );
			} else {
				$field_content = str_replace( "type='url' value='' class='", "type='url' value='' class='nhsuk-input nhsuk-input--width-10 ", $field_content );
			}
			break;

		// Text areas.
		case 'textarea':
			if ( 1 === $errorflag ) {
				$field_content = preg_replace( "#<textarea(.*?)class='#", "<textarea$1class='nhsuk-textarea nhsuk-textarea--error ", $field_content );
			} else {
				$field_content = preg_replace( "#<textarea(.*?)class='#", "<textarea$1class='nhsuk-textarea ", $field_content );
			}
			break;

		// Selects.
		case 'select':
			if ( 1 === $errorflag ) {
				$field_content = str_replace( 'gfield_select', 'nhsuk-select nhsuk-select--error', $field_content );
			} else {
				$field_content = str_replace( 'gfield_select', 'nhsuk-select', $field_content );
			}
			break;

		// Emails.
		case 'email':
			if ( 1 === $errorflag ) {
				$field_content = str_replace( "type='email' value='' class='", "type='email' value='' class='nhsuk-input nhsuk-input--error ", $field_content );
			} else {
				$field_content = str_replace( "type='email' value='' class='", "type='email' value='' class='nhsuk-input ", $field_content );
			}
			break;

		// Phone.
		case 'phone':
			if ( 1 === $errorflag ) {
				$field_content = str_replace( "type='tel' value class='", "type='tel' value='' class='nhsuk-input nhsuk-input--error ", $field_content );
			} else {
				$field_content = str_replace( "type='tel' value class='", "type='tel' value='' class='nhsuk-input ", $field_content );
			}
			break;
		// Numbers.
		case 'number':
			if ( 1 === $errorflag ) {
				$field_content = preg_replace( "#<input(.*?)class='#", "<input$1class='nhsuk-input nhsuk-input--error ", $field_content );
			} else {
				$field_content = preg_replace( "#<input(.*?)class='#", "<input$1class='nhsuk-input ", $field_content );
			}
			break;

		// Checkboxes.
		case 'checkbox':
			$field_content = str_replace( 'ginput_container_checkbox', 'nhsuk-checkboxes', $field_content );
			// Replace <li> elements with suitably-styled <label>s.
			$field_content = str_replace( "<li class='", "<div class='nhsuk-checkboxes__item ", $field_content );
			$field_content = str_replace( '</li', '</div', $field_content );
			$field_content = preg_replace( "#<label for='choice(.*?)>(.*?)</label>#i", "<label class='nhsuk-label nhsuk-checkboxes__label'>$2</label>", $field_content );

			// Style <input>s.
			$field_content = str_replace( "type='checkbox'", "type='checkbox' class='nhsuk-checkboxes__input'", $field_content );
			break;

		// Radio buttons.
		case 'radio':
			$field_content = str_replace( 'ginput_container_radio', 'nhsuk-radios', $field_content );
			$field_content = str_replace( "<li class='", "<div class='nhsuk-radios__item ", $field_content );
			$field_content = str_replace( '</li', '</div', $field_content );
			$field_content = preg_replace( "#<label for='choice(.*?)>(.*?)</label>#i", "<label class='nhsuk-label nhsuk-radios__label'>$2</label>", $field_content );
			// Style <input>s.
			$field_content = str_replace( "type='radio'", "type='radio' class='nhsuk-radios__input'", $field_content );
			break;

		// Poll.
		case 'poll':
		case 'survey':
			// options - likert, rank, rating, radio, check, text, textarea, select.
			// rank - leave alone.
			// ratings - sorted in css.
			$field_content = preg_replace( '/\s\s+/', '', $field_content );
			$field_content = str_replace( 'ginput_container_radio', 'nhsuk-radios--inline', $field_content ); // radio.
			$field_content = str_replace( 'ginput_container_checkbox', 'nhsuk-checkboxes', $field_content ); // checkbox.
			if ( 1 === $errorflag ) {
				$field_content = str_replace( 'gfield_select', 'nhsuk-select nhsuk-select--error', $field_content );
				$field_content = str_replace( "type='text' value='' class='", "type='text' value='' class='nhsuk-input nhsuk-input--error ", $field_content );
				$field_content = preg_replace( "#<textarea(.*?)class='#", "<textarea$1class='nhsuk-textarea nhsuk-textarea--error ", $field_content );
			} else {
				$field_content = str_replace( 'gfield_select', 'nhsuk-select', $field_content );
				$field_content = str_replace( "type='text' value='' class='", "type='text' value='' class='nhsuk-input ", $field_content );
				$field_content = preg_replace( "#<textarea(.*?)class='#", "<textarea$1class='nhsuk-textarea ", $field_content );
			}
			$field_content = preg_replace( '/\s\s+/', '', $field_content );
			$find          = array();
			$replace       = array();
			$find []       = "#<li class='(.*?)'><input(.*?)type='radio'(.*?)><label(.*?)</label></li>#i";
			$replace[]     = "<div class='nhsuk-radios__item $1'><input $2 type='radio' $3 class='nhsuk-radios__input'><label class='nhsuk-label nhsuk-radios__label' $4</label> </div>";
			$find []       = "#<li class='(.*?)'><input(.*?)type='checkbox'(.*?)><label(.*?)</label></li>#i";
			$replace[]     = "<div class='nhsuk-checkboxes__item $1'><input $2 type='checkboxes' $3 class='nhsuk-checkboxes__input'><label class='nhsuk-label nhsuk-checkboxes__label' $4</label> </div>";
			// likert sort out. This is messy.
			$field_content = preg_replace( $find, $replace, $field_content );
			break;
		// Name inputs.
		case 'name':
			$field_content = str_replace( "class='name_prefix", "style='flex: 1; float: left;' class='name_prefix", $field_content );
			$field_content = str_replace( "aria-label='Name prefix'", "aria-label='Name prefix' class='nhsuk-select", $field_content );
			$field_content = str_replace( "class='name_first'", "class='name-first' style='flex: 2; float: left;'", $field_content );
			$field_content = str_replace( "aria-label='First name'", "aria-label='First name' class='nhsuk-input nhsuk-input--width-10", $field_content );
			$field_content = str_replace( "class='name_middle'", "class='name-middle' style='flex: 3; float: left;'", $field_content );
			$field_content = str_replace( "aria-label='Middle name'", "aria-label='Middle name' class='nhsuk-input nhsuk-input--width-10", $field_content );
			$field_content = str_replace( "class='name_last'", "class='name-last' style='flex: 4; float: left;'", $field_content );
			$field_content = str_replace( "aria-label='Last name'", "aria-label='Last name' class='nhsuk-input nhsuk-input--width-10", $field_content );
			$field_content = str_replace( "class='name_suffix", "style='flex: 5; float: left;' class='name-suffix", $field_content );
			$field_content = str_replace( "aria-label='Name suffix'", "aria-label='Name suffix' class='nhsuk-input nhsuk-input--width-2", $field_content );
			$field_content = preg_replace( '#<div(.*?)ginput_container_name(.*?)>(.*?)</div>#i', "<div $1nhsuk-form-group_name$2>$3</div><div style='clear: both;'></div>", $field_content );
			if ( 1 === $errorflag ) {
				$field_content = str_replace( 'nhsuk-input', 'nhsuk-input nhsuk-input--error', $field_content );
			}
			break;
		case 'time':
			if ( 1 === $errorflag ) {
				$field_content = preg_replace( "#<input(.*?)type='number'#", "<input$1type='number' class='nhsuk-input nhsuk-input--width-2 nhsuk-input--error ", $field_content );
			} else {
				$field_content = preg_replace( "#<input(.*?)type='number'#", "<input$1type='number' class='nhsuk-input nhsuk-input--width-2 ", $field_content );
			}
			$field_content = str_replace( "class='gfield_time_hour", "style='flex: 1; float: left;' class='gfield_time_hour", $field_content );
			$field_content = str_replace( "class='gfield_time_minute", "style='flex: 2; float: left;' class='gfield_time_minute", $field_content );
			$field_content = str_replace( "class='gfield_time_ampm", "style='flex: 3; float: left;' class='gfield_time_ampm", $field_content );
			if ( 1 === $errorflag ) {
				$field_content = str_replace( '<select', "<select class='nhsuk-select nhsuk-select--error'", $field_content );
			} else {
				$field_content = str_replace( '<select', "<select class='nhsuk-select'", $field_content );
			}
			break;
		case 'address':
			if ( 1 === $errorflag ) {
				$field_content = str_replace( "type='text'", "type='text' value='' class='nhsuk-input nhsuk-input--error' ", $field_content );
			} else {
				$field_content = str_replace( "type='text'", "type='text' value='' class='nhsuk-input' ", $field_content );
			}
			if ( 1 === $errorflag ) {
				$field_content = str_replace( '<select', "<select class='nhsuk-select nhsuk-select--error'", $field_content );
			} else {
				$field_content = str_replace( '<select', "<select class='nhsuk-select'", $field_content );
			}
			$field_content = str_replace( '<label ', '<label class="nhsuk-label" ', $field_content );
			break;
		case 'consent':
			$field_content = str_replace( 'ginput_container_consent', 'ginput_container_consent nhsuk-checkboxes__item', $field_content );
			$field_content = str_replace( 'gfield_consent_label', 'gfield_consent_label nhsuk-label nhsuk-checkboxes__label', $field_content );
			$field_content = str_replace( "type='checkbox'", "type='checkbox' class='nhsuk-checkboxes__input'", $field_content );
			$field_content = '<div class="nhsuk_checkboxes">' . $field_content . '</div>';
			break;
		default: // everything else.
			$field_content = $field_content;
			break;
	}
	$field_content = preg_replace( "#<label class='gfield_label(.*?)>(.*?)</label>#i", ' ', $field_content );


	$ender     .= '</fieldset></div>';
	$collection = $fieldset . $wrapper . $field_content . $ender;

	return $collection;
};

// Extend expiration of save and continue links from 30 days to 1 year.
add_filter( 'gform_incomplete_submissions_expiration_days', 'gwp_days', 10, 1 );

/**
 * Set an expiry for partially completed Gravity Forms
 *
 * @param int $expiration_days how long before we kill off a partial entry.
 *
 * @return int $expiration_days how long before we kill off a partial entry.
 */
function gwp_days( $expiration_days ) {
	$expiration_days = 365;

	return $expiration_days;
}

add_filter(
	'gform_get_form_filter',
	function ( $form_string, $form ) {
		// Style the submit button.
		$form_string = str_replace( 'gform_button', 'gform_button nhsuk-button', $form_string );
		return $form_string;
	},
	10,
	2
);

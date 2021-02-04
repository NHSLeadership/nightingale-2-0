<?php
/**
 * Customised Gravity Forms output markup
 *
 * @date         September 26 2019
 * @version      1.0
 * @author       Tony Blacker
 * @organisation NHS Leadership Academy
 * @copyright    OGL v3
 * @package      Nightingale Theme
 */

add_filter(
	'gform_get_form_filter',
	function ( $form_string, $form ) {
		// Replace form description span with <nhsuk-hint> elements.
		$form_string = preg_replace( "#<span class='gform_description'>(.*?)</span>#", '<span class="nhsuk-hint">$1</span>', $form_string );
		// Style error messages.
		// Message at top of form.
		$form_string = str_replace( 'validation_error', 'nhsuk-error-message is-error', $form_string );
		// Fields with CSS class = "gfield_error".
		$form_string = str_replace( 'gfield_error', 'is-error gfield_error', $form_string );
		// Fields contained in <li> elements that have CSS class = "gfield_error".
		$form_string = preg_replace( "#<li(.*?)gfield_error(.*?)<input(.*?)class='#s", "<li$1gfield_error$2<input$3class='gfield_error is-error ", $form_string );
		// Error messages below fields.
		$form_string = str_replace( 'validation_message', 'nhsuk-u-visually-hidden validation_message', $form_string );
		// Style <ul>.
		$form_string = str_replace( "class='gform_fields", "class='c-form-list gform_fields", $form_string );
		// Replace <h3> with <h2>.
		$form_string = str_replace( '<h3', '<h2', $form_string );
		$form_string = str_replace( '/h3>', '/h2>', $form_string );
		// Replace field description divs with <small> elements.
		$form_string = preg_replace( "#<div class='gfield_description'(.*?)</div>#", "<span class='nhsuk-hint'$1</span>", $form_string );
		// Replace field instruction divs with <small> elements.
		$form_string = preg_replace( "#<div class='instruction(.*?)>(.*?)</div>#", '<small>$2</small>', $form_string );
		// Remove "required" tag NHSUK Service manual insted recommends highlighting optional fields, which is done elsewhere.
		$form_string = str_replace( "<span class='gfield_required'>*</span>", '', $form_string );
		// Replace main gfield_label elements with nhsuk-label.
		$form_string = preg_replace( '#gfield_label#s', 'nhsuk-label', $form_string );
		// Remove <ul>s around elements.
		$form_string = preg_replace( "#<ul class='gfield(.*?)>(.*?)</ul>#s", '$2', $form_string );
		// Add nhsuk-form-group to form <li> elements.
		$form_string = preg_replace( "#<li(.*?)field_(.*?)class='(.*?)#m", "<li$1field_$2class='nhsuk-form-group $3", $form_string );
		// Style the submit button.
		$form_string = str_replace( 'gform_button', 'nhsuk-button gform_button', $form_string );
		// Style the save and continue functionality.
		$form_string = preg_replace( "#<a (.*?)class='gform_save_link' (.*?)</a>#", "<a $1 class='nhsuk-button nhsuk-button--secondary gform_save_link' $2</a>", $form_string );

		return $form_string;
	},
	10,
	2
);

// Use gform_field_content to style individual fields.
// See https://docs.gravityforms.com/gform_field_content.
add_filter( 'gform_field_content', 'nightingale_clean_gf_inputs', 10, 2 );

/**
 * Clean Gravity Forms inputs out
 *
 * @param string $field_content the rendered output of a GF generated object.
 * @param array  $field         the initialised value of the field as created by GF.
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
	$label = '';
	if ( ( 'html' !== $field->type ) && ( 'section' !== $field->type ) && ( 'radio' !== $field->type ) && ( 'address' !== $field->type ) && ( 'hidden_label' !== $field->labelPlacement ) && ( empty( $field->gsurveyLikertRows ) ) ) { // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		$label .= '<label for="input_' . $field->formId . '_' . $field->id . '" class="nhsuk-label">' . $field->label; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
		if ( true !== $field->isRequired ) { // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			$label .= '&nbsp;&nbsp;<span class="nhsuk-tag">Optional</span>';
		}

		if ( 1 === $errorflag ) {
			$label .= '<span class="nhsuk-error-message">' . $field->validation_message . '</span>';
		}
		$label .= '<br/>';
		$label .= '</label>';
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
			// Replace li with field group.
			$field_content = str_replace( 'ginput_container ginput_container_select', 'ginput_container ginput_container_select nhsuk-dropdown', $field_content );
			if ( 'number' === $field->type ) {
				$field_content = preg_replace( "#<input(.*?)class='#", "<input$1class='c-form-input ", $field_content );
			}
			if ( 1 === $errorflag ) {
				$field_content = str_replace( 'gfield_select', 'gfield_select nhsuk-select nhsuk-select--error', $field_content );
			} else {
				$field_content = str_replace( 'gfield_select', 'gfield_select nhsuk-select', $field_content );
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
			$field_content = str_replace( 'ginput_container_checkbox', 'nhsuk-checkboxes input_' . $field->formId . '_' . $field->id, $field_content ); // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			// Replace <li> elements with suitably-styled <label>s.
			$field_content = str_replace( "<li class='", "<div class='nhsuk-checkboxes__item ", $field_content );
			$field_content = str_replace( '</li', '</div', $field_content );
			$field_content = preg_replace( '#<label for(.*?)>(.*?)</label>#i', "<label for$1 class='nhsuk-label nhsuk-checkboxes__label'>$2</label>", $field_content );

			// Style <input>s.
			$field_content = str_replace( "type='checkbox'", "type='checkbox' class='nhsuk-checkboxes__input'", $field_content );
			break;

		// Radio buttons.
		case 'radio':
		case 'quiz':
			$field_content = str_replace( 'ginput_container_radio', 'nhsuk-radios input_' . $field->formId . '_' . $field->id, $field_content ); // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			$field_content = str_replace( "<li class='", "<div class='nhsuk-radios__item ", $field_content );
			$field_content = str_replace( '</li', '</div', $field_content );
			$field_content = preg_replace( '#<label for(.*?)>(.*?)</label>#i', "<label class='nhsuk-label nhsuk-radios__label' for$1>$2</label>", $field_content );
			// Style <input>s.
			$field_content = str_replace( "type='radio'", "type='radio' class='nhsuk-radios__input'", $field_content );
			// For accessibility convert radio labels to legends and place them with radio buttons inside fieldsets.
			$radiolabel = '';
			if ( true !== $field->isRequired ) { // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
				$radiolabel .= '&nbsp;&nbsp;<span class="nhsuk-tag">Optional</span>';
			}

			if ( 1 === $errorflag ) {
				$radiolabel .= '<span class="nhsuk-error-message">' . $field->validation_message . '</span>';
			}
			$radiolabel   .= '<br/>';
			$find          = "#<label class='gfield_label'(\s*?)>(.*?)</label>(.*?)<div(.*?)>(.*?)<ul class='gfield_radio' id='(.*?)'>(.*?)</ul></div>#";
			$replace       = "<fieldset class='ginput_container nhsuk-fieldset' id='$6'><legend class='nhsuk-fieldset__legend'>$2 $radiolabel</legend>$3<div class='nhsuk-radios'>$7</div></fieldset>";
			$field_content = preg_replace( $find, $replace, $field_content );
			break;

		// Poll.
		case 'poll':
		case 'survey':
			// options - likert, rank, rating, radio, check, text, textarea, select.
			// rank - leave alone.
			// ratings - sorted in css.
			$field_content = preg_replace( '/\s\s+/', '', $field_content );
			$field_content = str_replace( 'ginput_container_radio', 'nhsuk-radios--inline input_' . $field->formId . '_' . $field->id, $field_content ); // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			$field_content = str_replace( 'ginput_container_checkbox', 'nhsuk-checkboxes input_' . $field->formId . '_' . $field->id, $field_content ); // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
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
			// For accessibility add labels (for screen readers only) to survey radio buttons.
			$likertlabel = '';
			if ( true !== $field->isRequired ) { // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
				$likertlabel .= '&nbsp;&nbsp;<span class="nhsuk-tag">Optional</span>';
			}

			if ( 1 === $errorflag ) {
				$likertlabel .= '<span class="nhsuk-error-message">' . $field->validation_message . '</span>';
			}
			$likertlabel .= '<br/>';
			$find[]       = "#<label class='gfield_label'>(.*?)</label><div(.*?)><table class='gsurvey-likert'(.*?)><thead>(.*?)</thead><tbody>(.*?)</tbody></table></div>#"; // strip out all the table gunk.
			$replace[]    = "<fieldset class='gsurvey-likert nhsuk-fieldset'$2><legend class='nhsuk-fieldset__legend'>$1$likertlabel</legend><div class='nhsuk-radios nhsuk-radios--inline nhsuk-likert'><div class='nhsuk-likert__row nhsuk-likert__header'>$4</div>$5</div></fieldset>"; // replace it with a much simpler div layout.
			$find[]       = '#<th(.*?)>(.*?)</th>#';
			$replace[]    = "<div class='nhsuk-radios__item nhsuk-likert__item'>$2</div>";
			$find[]       = "#<div class='nhsuk-radios nhsuk-radios--inline nhsuk-likert'>(.*?)<tr><td(.*?)class='gsurvey-likert-row-label'>(.*?)</td>(.*?)</tr></div>#"; // identify multi row tables.
			$replace[]    = "<div class='nhsuk-radios nhsuk-radios--inline nhsuk-likert nhsuk-likert__multi'>$1<tr><td$2 class='gsurvey-likert-row-label'>$3</td>$4</tr></div>";
			$find[]       = "#<tr><td(.*?)class='gsurvey-likert-row-label'>(.*?)</td>(.*?)</tr>#"; // modify multi row grids.
			$replace[]    = "<div class='nhsuk-likert__row'$1><div class='nhsuk-likert__item nhsuk-likert__rowlabel'>$2</div>$3</div>";
			$find[]       = '#<tr>(.*?)</tr>#'; // now mop up the single row grids.
			$replace[]    = "<div class='nhsuk-likert__row'>$1</div>";
			$find[]       = "#<td data-label='(.*?)' class='gsurvey-likert-choice'><input name='(.*?)' type='radio' value='(.*?)'id='(.*?)'/></td>#"; // we just have to pull out the td's now.
			$replace[]    = "<div data-label='$1' class='nhsuk-radios__item nhsuk-likert__item'><input name='$2' class='nhsuk-radios__input' type='radio' value='$3' id='$4'/><label class='nhsuk-label nhsuk-radios__label' for='$4'><span class='nhsuk-u-visually-hidden'>$1</span></label></div>"; // and turn them into pretty divs with nhsuk-radios.

			$field_content = preg_replace( $find, $replace, $field_content );
			break;
		// Name inputs.
		case 'name':
			$field_content = str_replace( "class='name_prefix", "style='flex: 1; float: left;' class='name_prefix", $field_content );
			$field_content = str_replace( "aria-label='Name prefix'", "aria-label='Name prefix' class='nhsuk-select'", $field_content );
			$field_content = str_replace( "class='name_first'", "class='name-first' style='flex: 2; float: left;'", $field_content );
			$field_content = str_replace( "aria-label='First name'", "aria-label='First name' class='nhsuk-input nhsuk-input--width-10'", $field_content );
			$field_content = str_replace( "class='name_middle'", "class='name-middle' style='flex: 3; float: left;'", $field_content );
			$field_content = str_replace( "aria-label='Middle name'", "aria-label='Middle name' class='nhsuk-input nhsuk-input--width-10'", $field_content );
			$field_content = str_replace( "class='name_last'", "class='name-last' style='flex: 4; float: left;'", $field_content );
			$field_content = str_replace( "aria-label='Last name'", "aria-label='Last name' class='nhsuk-input nhsuk-input--width-10'", $field_content );
			$field_content = str_replace( "class='name_suffix", "style='flex: 5; float: left;' class='name-suffix", $field_content );
			$field_content = str_replace( "aria-label='Name suffix'", "aria-label='Name suffix' class='nhsuk-input nhsuk-input--width-2'", $field_content );
			$field_content = preg_replace( '#<div(.*?)ginput_container_name(.*?)>(.*?)</div>#i', "<div $1nhsuk-form-group_name$2>$3</div><div style='clear: both;'></div>", $field_content );
			if ( 1 === $errorflag ) {
				$field_content = str_replace( 'nhsuk-input', 'nhsuk-input nhsuk-input--error', $field_content );
			}
			break;
		case 'time':
			if ( 1 === $errorflag ) {
				$field_content = preg_replace( "#<input(.*?)type='number'#", "<input$1type='number' class='nhsuk-input nhsuk-input--width-2 nhsuk-input--error' ", $field_content );
			} else {
				$field_content = preg_replace( "#<input(.*?)type='number'#", "<input$1type='number' class='nhsuk-input nhsuk-input--width-2' ", $field_content );
			}
			$field_content = str_replace( "class='gfield_time_hour", "style='flex: 1; float: left;' class='gfield_time_hour'", $field_content );
			$field_content = str_replace( "class='gfield_time_minute", "style='flex: 2; float: left;' class='gfield_time_minute'", $field_content );
			$field_content = str_replace( "class='gfield_time_ampm", "style='flex: 3; float: left;' class='gfield_time_ampm'", $field_content );
			if ( 1 === $errorflag ) {
				$field_content = str_replace( '<select', "<select class='nhsuk-select nhsuk-select--error'", $field_content );
			} else {
				$field_content = str_replace( '<select', "<select class='nhsuk-select'", $field_content );
			}
			break;
		case 'address':
			if ( 1 === $errorflag ) {
				$field_content = str_replace( "type='text'", "type='text' class='nhsuk-input nhsuk-input--error' ", $field_content );
			} else {
				$field_content = str_replace( "type='text'", "type='text' class='nhsuk-input' ", $field_content );
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
		case 'html':
			// style the submission preview screen.
			$field_content = preg_replace( '/<table(.*?)>(.*?)<\/table>/si', '<div>$2</div>', $field_content );
			$field_content = preg_replace( '/<table(.*?)>(.*?)<\/table>/si', '<div><dl class="nhsuk-summary-list">$2</dl></div>', $field_content );
			$field_content = preg_replace( '/<tbody>(.*?)<\/tbody>/i', '$1', $field_content );
			$field_content = preg_replace( '/<tr bgcolor="\#EAF2FA"(.*?)<\/tr>/si', '<div class="nhsuk-summary-list__row"><dt class="nhsuk-summary-list__key"$1</dt>', $field_content );
			$field_content = preg_replace( '/<tr bgcolor="\#FFFFFF"(.*?)<\/tr>/si', '<dd class="nhsuk-summary-list__value"$1</dd></div>', $field_content );
			$field_content = preg_replace( '/<td width="20">&nbsp;<\/td>/si', '', $field_content );


			$field_content = preg_replace( '/<td(.*?)>(.*?)<\/td>/si', '$2', $field_content );
			$field_content = preg_replace( '/<font style="font-family: sans-serif; font-size:12px;">(.*?)<\/font>/si', '$1', $field_content );

			break;
		default: // everything else.
			$field_content = $field_content;
			break;
	}
	$field_content = preg_replace( "#<label class='gfield_label(.*?)>(.*?)</label>#i", ' ', $field_content );

	$collection = $label . $wrapper . $field_content . $ender;

	return $collection;
}

// Extend expiration of save and continue links from 30 days to 1 year.
add_filter( 'gform_incomplete_submissions_expiration_days', 'nightingale_gwp_days', 10, 1 );

/**
 * Set an expiry for partially completed Gravity Forms
 *
 * @param int $expiration_days how long before we kill off a partial entry.
 *
 * @return int $expiration_days how long before we kill off a partial entry.
 */
function nightingale_gwp_days( $expiration_days ) {
	$expiration_days = 365;

	return $expiration_days;
}

add_filter( 'gform_file_upload_markup', 'nightingale_change_upload_markup', 10, 4 );

/**
 * Function to tidy the markup of upload fields.
 *
 * @param string $file_upload_markup The original markup generated by the system.
 * @param array  $file_info          The information about the file.
 * @param int    $form_id            The form ID.
 * @param int    $field_id           The field ID.
 *
 * @return string
 */
function nightingale_change_upload_markup( $file_upload_markup, $file_info, $form_id, $field_id ) {
	return '<strong>' . esc_html( $file_info['uploaded_filename'] ) . "</strong > <img class='gform_delete' src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAABmJLR0QA/wD/AP+gvaeTAAABKUlEQVRYhe2Uuw4BQRSGPwqJW6KgU4jeA0jEC2h4Ku8hXkFJiCdYURJR0Ot0FM5kx2TZHTu7QvZPTjYzszP/d85cIFMme42AM3Az4gwM0wAIMldxSgNAmUXtf6tciJFLBXrlHZs410dltZn/9Qr8HIBZ0rC2cwDnygD+EmDvcjHbU78Dmlr7Qswn3RZAmavKdgUiNQCAPrAFWhqEqQYwBzpJAMyk76BBmOae/DNPAqAELKT/CLQN842MeUDdFiCqSjyy0yH0zCOZxwEAKANL/O2wylzpJJN6MSBW+IlsTPOwh2gi37W2SFhcgYHMKwI1bb0qULHJoACM8SthY17nec9VJV7dDqcKOnDvbodz81cHLhUIdf08gTFVwd+OZRIAHYEIMtchpkDrDvRKkk0dBvEBAAAAAElFTkSuQmCC' 
				  onclick='gformDeleteUploadedFile({$form_id}, {$field_id }, this)' alt='Delete this file' />";
}

/**
 * Include specific javascript to override Gravity things.
 */
function nightingale_gravity_scripts() {
	wp_enqueue_script( 'nightingale-gravity', get_template_directory_uri() . '/js/gravity-overrides.js', '', '20201021', true );
}

add_action( 'wp_enqueue_scripts', 'nightingale_gravity_scripts' );

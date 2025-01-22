<?php
/**
 * Customised Gravity Forms output markup
 *
 * @date         December 3 2024
 * @version      1.1
 * @author       Tony Blacker, Chris Brown
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
		$form_string = str_replace( 'validation_error', 'nhsuk-error-message is-error', $form_string );                                                              // legacy.
		$form_string = str_replace( 'gform_submission_error', 'nhsuk-error-message is-error', $form_string );                                                        // new.

		// Fields with CSS class = "gfield_error".
		$form_string = str_replace( 'gfield_error', 'is-error gfield_error', $form_string );
		// Fields contained in li elements that have CSS class = "gfield_error".

		$form_string = preg_replace( "#<li(.*?)gfield_error(.*?)<input(.*?)class='#s", "<li$1gfield_error$2<input$3class='gfield_error is-error ", $form_string );   // legacy.
		$form_string = preg_replace( "#<div(.*?)gfield_error(.*?)<input(.*?)class='#s", "<div$1gfield_error$2<input$3class='gfield_error is-error ", $form_string ); // new.
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
		// Remove uls around elements.add_filter(
	'gform_get_form_filter',
	function ( $form_string, $form ) {
		// Replace form description span with <nhsuk-hint> elements.
		$form_string = preg_replace( "#<span class='gform_description'>(.*?)</span>#", '<span class="nhsuk-hint">$1</span>', $form_string );
		// Style error messages.
		// Message at top of form.
		$form_string = str_replace( 'validation_error', 'nhsuk-error-message is-error', $form_string );                                                              // legacy.
		$form_string = str_replace( 'gform_submission_error', 'nhsuk-error-message is-error', $form_string );                                                        // new.

		// Fields with CSS class = "gfield_error".
		$form_string = str_replace( 'gfield_error', 'is-error gfield_error', $form_string );
		// Fields contained in li elements that have CSS class = "gfield_error".

		$form_string = preg_replace( "#<li(.*?)gfield_error(.*?)<input(.*?)class='#s", "<li$1gfield_error$2<input$3class='gfield_error is-error ", $form_string );   // legacy.
		$form_string = preg_replace( "#<div(.*?)gfield_error(.*?)<input(.*?)class='#s", "<div$1gfield_error$2<input$3class='gfield_error is-error ", $form_string ); // new.
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
		// Remove uls around elements.
		$form_string = preg_replace( "#<div class='gfield_radio(.*?)>(.*?)</div></div>#s", '$2</div>', $form_string );                                               // new - radios.
		$form_string = preg_replace( "#<ul class='gfield(.*?)>(.*?)</ul>#s", '$2', $form_string );                                                                   // legacy.
		// Add nhsuk-form-group to form li elements.
		$form_string = preg_replace( "#<li(.*?)field_(.*?)class='(.*?)#m", "<li$1field_$2class='nhsuk-form-group $3", $form_string );                                // legacy.

		// Style the submit button.
		$form_string = str_replace( 'gform_button', 'nhsuk-button', $form_string );
		// Style the next button.
		$form_string = str_replace( 'gform_next_button gform-theme-button button', 'gform_next_button nhsuk-button', $form_string ); // For Gravity Forms version 2.7+.
		$form_string = str_replace( 'gform_next_button button', 'nhsuk-button', $form_string ); // Prior to gforms 2.7.
		// Style the previous button.
		$form_string = str_replace( 'gform_previous_button gform-theme-button', 'gform_previous_button nhsuk-button nhsuk-button--reverse', $form_string ); // For Gravity Forms version 2.7+.
		$form_string = str_replace( 'gform_previous_button button', 'nhsuk-button nhsuk-button--reverse', $form_string ); // Prior to gforms 2.7.
		// Style last page button.
		$form_string = str_replace( 'button gform_button gform_last_page_button', 'gform_previous_button nhsuk-button nhsuk-button--reverse', $form_string ); // For Gravity Forms version 2.7+.
		// Style the save and continue functionality.
		$form_string = str_replace( 'gform_save_link button', 'nhsuk-button nhsuk-button--secondary', $form_string );
		$form_string = str_replace( 'gform_save_link', 'nhsuk-button nhsuk-button--secondary', $form_string );

		$form_string = add_nhsuk_group_error_class_for_validation( $form_string );
		$form_string    = add_nhsuk_class( $form_string ); // Add  'nhsuk-form-group' to 'gfield'.
		return $form_string;
	},
	10,
	2
);

/**
 * Adds nhsuk form group error class to gravity form div having individual form elemen(s)
 * with gfield error class.
 *
 * @param mixed $html html content.
 * @return bool|string
 */
function add_nhsuk_group_error_class_for_validation( $html ) {
	// Create a new DOMDocument instance with UTF-8 encoding.
	$doc = new DOMDocument( '1.0', 'UTF-8' );
	// Suppress warnings due to malformed HTML.
	libxml_use_internal_errors( true );
	// Ensure the HTML is encoded in UTF-8 before loading.
	$html = mb_convert_encoding( $html, 'HTML-ENTITIES', 'UTF-8' );
	// Load HTML with UTF-8 encoding.
	$doc->loadHTML( $html );
	libxml_clear_errors();
	// Create XPath for DOM traversal.
	$xpath = new DOMXPath( $doc );
	// Query the outer divs.
	$outer_divs = $xpath->query( "//div[contains(@class, 'ginput_container')]" );
	if ( $outer_divs->length > 0 ) {
		foreach ( $outer_divs as $outer_div ) {
			// Find the inner divs containing error classes.
			$inner_divs = $xpath->query( ".//*[contains(@class, 'gfield_error is-error')]", $outer_div );
			if ( $inner_divs->length > 0 ) {
				// Append the 'nhsuk-form-group--error' class.
				$existing_class = $outer_div->getAttribute( 'class' );
				$new_class      = 'nhsuk-form-group--error';
				$class_array    = explode( ' ', $existing_class );
				if ( ! in_array( $new_class, $class_array, true ) ) {
					$updated_class = trim( $existing_class . ' ' . $new_class );
					$outer_div->setAttribute( 'class', $updated_class );
				}
				break;
			}
		}
	}

	// Save the HTML and return it with proper encoding handling.
	$html = $doc->saveHTML();

	// Convert the HTML back to UTF-8 and return.
	return mb_convert_encoding( $html, 'UTF-8', 'HTML-ENTITIES' );
}

/**
 * Str_replace was replacing every 'gfield' in the input box to 'gfield nhsuk-form-group'.
 * For example, an address '10 springfield road' was convereting into '10 springfield nhsuk-form-group'.
 * This method used php DOMDocument() to do the replacement.
 *
 * @param string $form_string the rendered html output of a GF.
 * @param string $additional  Additional class to append.
 * @return string
 */
function add_nhsuk_class( $form_string, $additional = '' ) {
	global $wp_version;
	if ( (float) $wp_version >= 6.2 ) {
		$form_string = add_nhsuk_class_with_tag_processor( $form_string, $additional = '' );
		return $form_string;
	} else {
		$form_string = add_nhsuk_class_with_dom( $form_string, $additional = '' );
		return $form_string;
	}

}

/**
 * This method uses WP html tag processor to add nhsuk class.
 *
 * @param string $form_string the rendered html output of a GF.
 * @param string $additional  Additional class to append.
 * @return string
 */
function add_nhsuk_class_with_tag_processor( $form_string, $additional = '' ) {
	$form_string = new \WP_HTML_Tag_Processor( $form_string );
	$query       = array(
		'class_name' => 'gfield',
	);
	$class_name  = 'nhsuk-form-group';
	if ( ! empty( $additional ) ) {
		$class_name = $class_name . ' ' . $additional;
	}
	while ( $form_string->next_tag( $query ) ) {
		$form_string->add_class( $class_name );
	}
	return $form_string->get_updated_html();
}


/**
 * This method used php DOMDocument() to add nhsuk class.
 *
 * @param string $html_text the rendered html output of a GF.
 * @param string $additional  Additional class to append.
 * @return string
 */
function add_nhsuk_class_with_dom( $html_text, $additional = '' ) {
	// Enable internal error handling mode to stop libxml errors display in the browser.
	libxml_use_internal_errors( true );

	$dom = new DOMDocument();
	// Load HTML into the DOMDocument.
	$dom->loadHTML( $html_text, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );

	// Create a DOMXPath object to query the DOMDocument.
	$xpath = new DOMXPath( $dom );

	// Replace the class name.
	$gfield_class = 'gfield ';
	$nhsuk_class  = 'nhsuk-form-group';
	if ( ! empty( $additional ) ) {
		$nhsuk_class = $nhsuk_class . ' ' . $additional;
	}
	// Find elements with the old class name.
	$elements = $xpath->query( "//*[contains(@class, '$gfield_class')]" );
	// Loop through the found elements and replace the class name.
	foreach ( $elements as $element ) {
		$class_attr = $element->getAttribute( 'class' );
		$element->setAttribute(
			'class',
			$class_attr . ' ' . $nhsuk_class
		);
	}

	libxml_use_internal_errors( false );

	// Get the modified HTML.
	return $dom->saveHTML();
}



// Use gform_field_content to style individual fields.
// See https://docs.gravityforms.com/gform_field_content.
add_filter( 'gform_field_content', 'nightingale_clean_gf_inputs', 12, 5 );

/**
 * Clean Gravity Forms inputs out
 *
 * @param string $field_content the rendered output of a GF generated object.
 * @param array  $field         the initialised value of the field as created by GF.
 * @param string $value         unused in this function, but required to get to the form_id value as parent function specifies it.
 * @param int    $lead_id       unused in this function, but required to get to the form_id value as parent function specifies it.
 * @param int    $form_id       the ID of the wrapping form, used to determine whether the form is legacy view or not.
 *
 * @return string
 */
function nightingale_clean_gf_inputs( $field_content, $field, $value, $lead_id, $form_id ) {
	$legacy = 0; // default to assuming every layout is the new style (new as in from Gravity Forms 2.5 onwards).
	if ( GFCommon::is_legacy_markup_enabled( $form_id ) ) {
		$legacy = 1; // if older than GF 2.5 _or_ newer but this form set to use old display, set flag to true.
	}
	$errorclass = '';
	if ( '' !== $field->validation_message ) {
		$errorflag  = 1;
		$grouperror = ' nhsuk-form-group--error';
	} else {
		$errorflag  = 0;
		$grouperror = '';
	}
	if ( 1 === $legacy ) { // this is the older code.

		$extra = '';
		if ( $field->gwreadonly_enable > 0 ) {
			$extra .= ' readonly';
		}
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
				$field_content = str_replace( 'ginput_container ginput_container_select', 'nhsuk-dropdown', $field_content );
				if ( 'number' === $field->type ) {
					$field_content = preg_replace( "#<input(.*?)class='#", "<input$1class='c-form-input ", $field_content );
				}
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
				$field_content = str_replace( 'ginput_container_checkbox', 'nhsuk-checkboxes input_' . $field->formId . '_' . $field->id, $field_content ); // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
				// Replace <li> elements with suitably-styled <label>s.
				$field_content = str_replace( "<li class='", "<div class='nhsuk-checkboxes__item ", $field_content );
				$field_content = str_replace( '</li', '</div', $field_content );
				$field_content = str_replace( 'gfield-choice-input', 'gfield-choice-input nhsuk-checkboxes__input', $field_content );
				$field_content = preg_replace( '#<label for(.*?)>(.*?)</label>#i', "<label for$1 class='nhsuk-label nhsuk-checkboxes__label'>$2</label>", $field_content );
				// Fix for gravity forms 2.7+.
				$field_content = str_replace( 'gform-field-label gform-field-label--type-inline', 'nhsuk-label nhsuk-checkboxes__label', $field_content );
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
				// Style inputs.
				$field_content = str_replace( "type='radio'", "type='radio' class='nhsuk-radios__input'", $field_content );                          // legacy.
				$field_content = str_replace( 'gfield-choice-input', 'nhsuk-radios__input', $field_content );                                    // new.
				$field_content = str_replace( 'gchoice gchoice_', 'nhsuk-radios__item gchoice gchoice_', $field_content );                           // new.
				// For accessibility convert radio labels to legends and place them with radio buttons inside fieldsets.
				$radiolabel = '';
				if ( true !== $field->isRequired ) { // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
					$radiolabel .= '&nbsp;&nbsp;<span class="nhsuk-tag">Optional</span>';
				}

				if ( 1 === $errorflag ) {
					$radiolabel .= '<span class="nhsuk-error-message">' . $field->validation_message . '</span>';
				}
				$radiolabel   .= '<br/>';
				$find          = '#<label class="nhsuk-form-group(.*?)>(.*?)</label>#i';
				$replace       = "<legend class='nhsuk-fieldset__legend$1>$2 $radiolabel</legend>";
				$field_content = preg_replace( $find, $replace, $field_content );

				$field_content = str_replace( "onfocus=\"jQuery(this).next('input').focus();\" />", "onfocus=\"jQuery(this).next('input').focus();\" /><label class=\"nhsuk-radios__label\" style=\"padding:5px;\"></label>", $field_content );
				$field_content = str_replace( 'onfocus=\'jQuery(this).prev("input")[0].click()', 'style="width:85%;" onfocus=\'jQuery(this).parent().find("input[type=\"radio\"]").first().prop("checked", true)', $field_content );
				break;

			// Poll.
			case 'poll':
			case 'survey':
				// options - likert, rank, rating, radio, check, text, textarea, select.
				// rank - leave alone.
				// ratings - sorted in css.
				$field_content = preg_replace( '/\s\s+/', '', $field_content );
				$field_content = str_replace( 'ginput_container_radio', 'nhsuk-radios--inline input_' . $field->formId . '_' . $field->id, $field_content ); // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
				$field_content = str_replace( 'ginput_container_checkbox', 'nhsuk-checkboxes input_' . $field->formId . '_' . $field->id, $field_content );  // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
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
				$likertlabel  .= '<br/>';
				$find[]        = "#<label class='gfield_label'>(.*?)</label><div(.*?)><table class='gsurvey-likert'(.*?)><thead>(.*?)</thead><tbody>(.*?)</tbody></table></div>#";                                                                                                              // strip out all the table gunk.
				$replace[]     = "<fieldset class='gsurvey-likert nhsuk-fieldset'$2><legend class='nhsuk-fieldset__legend'>$1$likertlabel</legend><div class='nhsuk-radios nhsuk-radios--inline nhsuk-likert'><div class='nhsuk-likert__row nhsuk-likert__header'>$4</div>$5</div></fieldset>"; // replace it with a much simpler div layout.
				$find[]        = '#<th(.*?)>(.*?)</th>#';
				$replace[]     = "<div class='nhsuk-radios__item nhsuk-likert__item'>$2</div>";
				$find[]        = "#<div class='nhsuk-radios nhsuk-radios--inline nhsuk-likert'>(.*?)<tr><td(.*?)class='gsurvey-likert-row-label'>(.*?)</td>(.*?)</tr></div>#"; // identify multi row tables.
				$replace[]     = "<div class='nhsuk-radios nhsuk-radios--inline nhsuk-likert nhsuk-likert__multi'>$1<tr><td$2 class='gsurvey-likert-row-label'>$3</td>$4</tr></div>";
				$find[]        = "#<tr><td(.*?)class='gsurvey-likert-row-label'>(.*?)</td>(.*?)</tr>#"; // modify multi row grids.
				$replace[]     = "<div class='nhsuk-likert__row'$1><div class='nhsuk-likert__item nhsuk-likert__rowlabel'>$2</div>$3</div>";
				$find[]        = '#<tr>(.*?)</tr>#'; // now mop up the single row grids.
				$replace[]     = "<div class='nhsuk-likert__row'>$1</div>";
				$find[]        = "#<td data-label='(.*?)' class='gsurvey-likert-choice'><input name='(.*?)' type='radio' value='(.*?)'id='(.*?)'/></td>#";                                                                                                                                                 // we just have to pull out the td's now.
				$replace[]     = "<div data-label='$1' class='nhsuk-radios__item nhsuk-likert__item'><input name='$2' class='nhsuk-radios__input' type='radio' value='$3' id='$4'/><label class='nhsuk-label nhsuk-radios__label' for='$4'><span class='nhsuk-u-visually-hidden'>$1</span></label></div>"; // and turn them into pretty divs with nhsuk-radios.
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
			default: // everything else.
				$field_content = $field_content;
				break;
		}
	} else { // end legacy code modifications, start modifications to newer layout.
		if ( 1 === $errorflag ) {
			$outererror = 'nhsuk-form-group--error';
		} else {
			$outererror = '';
		}
		$field_content    = add_nhsuk_class( $field_content, $outererror ); // Add  'nhsuk-form-group' to 'gfield'.

		// reverse the logic of required highlighting - instead highlight only the optional fields.
		if ( true !== $field->isRequired ) { // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
			$outerfind[]    = '</label>';
			$outerreplace[] = '&nbsp;&nbsp;<span class="nhsuk-tag">Optional</span></label>';
		} else {
			$outerfind[]    = '<span class="gfield_required"><span class="gfield_required gfield_required_text">(Required)</span></span>';
			$outerreplace[] = '';
		}
		$field_content = str_replace( $outerfind, $outerreplace, $field_content );
		switch ( $field->type ) {
			// Text areas.
			case 'text':
			case 'phone':
			case 'email':
			case 'website':
			case 'phone':
			case 'number':
				if ( 1 === $errorflag ) {
					$errorclass = 'nhsuk-input--error';
				}
				$find[]        = "class='$field->size";
				$replace       = "class='$field->size nhsuk-input $errorclass";
				$field_content = str_replace( $find, $replace, $field_content );
				break;

			case 'time':
				if ( 1 === $errorflag ) {
					$errorclass = 'nhsuk-input--error';
				}
				$find[]    = "type='number'";
				$replace[] = "type='number' class='nhsuk-input nhsuk-input--width-2'";
				$find[]    = 'ginput_container';
				$replace[] = 'ginput_container alignleft';
				$find[]    = 'below ';
				$replace[] = 'below alignleft ';
				$find[]    = '<select';
				if ( 1 === $errorflag ) {
					$replace[] = "<select class='nhsuk-select nhsuk-select--error'";
				} else {
					$replace[] = "<select class='nhsuk-select'";
				}
				$field_content = str_replace( $find, $replace, $field_content );
				break;

			// Name inputs.
			case 'name':
				// leave this alone, they seem to have done a decent job and it is very accessible now.
				if ( strpos( $field_content, '<select' ) !== false ) {
					$field_content = add_class_to_select( $field_content, 'nhsuk-select' );
				}
				break;
			// Checkboxes.
			case 'checkbox':
				$find[]        = 'gfield_checkbox';
				$replace[]     = 'gfield_checkbox nhsuk_checkbox';
				$find[]        = 'gchoice ';
				$replace[]     = 'gchoice nhsuk-checkboxes__item ';
				$find[]        = 'gfield-choice-input';
				$replace[]     = 'gfield-choice-input nhsuk-checkboxes__input';
				$find[]        = 'label for';
				$replace[]     = 'label class="nhsuk-label nhsuk-checkboxes__label" for';
				$field_content = str_replace( $find, $replace, $field_content );
				break;
			// Selects.
			case 'select':
				if ( 1 === $errorflag ) {
					$errorclass = 'nhsuk-select--error';
				}
				$find[]        = 'gfield_select';
				$replace[]     = 'gfield_select nhsuk-select ' . $errorclass;
				$field_content = str_replace( $find, $replace, $field_content );
				break;
			case 'radio':
			case 'quiz':
				$find[]        = 'ginput_container ginput_container_radio';
				$replace[]     = 'ginput_container ginput_container_radio nhsuk-radios';
				$find[]        = 'gchoice ';
				$replace[]     = 'gchoice nhsuk-radios__item ';
				$find[]        = 'gfield-choice-input';
				$replace[]     = 'gfield-choice-input nhsuk-radios__input';
				$find[]        = 'label for';
				$replace[]     = 'label class="nhsuk-label nhsuk-radios__label" for';
				$find[]        = 'gfield_select';
				$replace[]     = 'gfield_select nhsuk-select ';
				$ffind []      = "#<div class='gchoice (.*?)'><input(.*?)type='radio'(.*?)><label(.*?)</label></div>#i";
				$rreplace[]    = "<div class='gchoice nhsuk-radios__item $1'><input $2 type='radio' $3 class='nhsuk-radios__input'><label class='nhsuk-label nhsuk-radios__label' $4</label> </div>";
				$ffind []      = "#<div class='gchoice (.*?)<input(.*?)class='gfield-choice-input(.*?)type='checkbox'(.*?)><label(.*?)</label></div>#i";
				$rreplace[]    = "<div class='gchoice nhsuk-checkboxes__item $1'<input $2 type='checkbox' class='gfield_choice_input nhsuk-checkboxes__input $3 $4><label class='nhsuk-label nhsuk-checkboxes__label' $5</label> </div>";
				$field_content = preg_replace( $ffind, $rreplace, $field_content );
				$field_content = str_replace( $find, $replace, $field_content );
				break;
			case 'textarea':
				if ( 1 === $errorflag ) {
					$errorclass = 'nhsuk-textarea--error';
				}
				$find[]        = "class='textarea";
				$replace[]     = "class='textarea nhsuk-textarea $errorclass";
				$field_content = str_replace( $find, $replace, $field_content );
				break;
			// Date inputs.
			case 'date':
				if ( 1 === $errorflag ) {
					$errorclass = 'nhsuk-input--error';
				}
				$find[]        = 'datepicker ';
				$replace[]     = "datepicker nhsuk-input nhsuk-input--width-10 $errorclass ";
				$field_content = str_replace( $find, $replace, $field_content );
				break;
			case 'address':
				if ( 1 === $errorflag ) {
					$errorclass = 'nhsuk-input--error';
				}
				$find[]        = "type='text'";
				$replace[]     = "type='text' class='nhsuk-input $errorclass' ";
				$find[]        = '<label ';
				$replace[]     = '<label class="nhsuk-label" ';
				$find[]        = '<select ';
				$replace[]     = '<select class="nhsuk-select" ';
				$field_content = str_replace( $find, $replace, $field_content );
				break;

			case 'consent':
				$find[]        = 'ginput_container_consent';
				$replace[]     = 'ginput_container_consent nhsuk-checkboxes__item';
				$find[]        = 'gfield_consent_label';
				$replace[]     = 'gfield_consent_label nhsuk-label nhsuk-checkboxes__label';
				$find[]        = "type='checkbox'";
				$replace[]     = "type='checkbox' class='nhsuk-checkboxes__input'";
				$field_content = str_replace( $find, $replace, $field_content );
				$field_content = '<div class="nhsuk_checkboxes">' . $field_content . '</div>';
				break;
			// Poll.
			case 'poll':
			case 'survey':
				// options - likert, rank, rating, radio, check, text, textarea, select.
				// rank - leave alone.
				// ratings - sorted in css.
				$ffind[]       = 'ginput_container_checkbox';
				$rreplace[]    = 'nhsuk-checkboxes input_' . $field->formId . '_' . $field->id; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
				$ffind[]       = 'ginput_container_radio';
				$rreplace[]    = 'nhsuk-radios input_' . $field->formId . '_' . $field->id; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase
				$ffind[]       = 'gfield-choice-input';
				$rreplace[]    = 'gfield-choice-input nhsuk-radios__input';
				$field_content = str_replace( $ffind, $rreplace, $field_content );
				$field_content = preg_replace( '/\s\s+/', '', $field_content );
				if ( 1 === $errorflag ) {
					$field_content = str_replace( 'gfield_select', 'nhsuk-select nhsuk-select--error', $field_content );
					$field_content = str_replace( "type='text' value='' class='", "type='text' value='' class='nhsuk-input nhsuk-input--error ", $field_content );
					$field_content = preg_replace( "#<textarea(.*?)class='#", "<textarea$1class='nhsuk-textarea nhsuk-textarea--error ", $field_content );
				} else {
					$field_content = str_replace( 'gfield_select', 'nhsuk-select', $field_content );
					$field_content = str_replace( "type='text' value='' class='", "type='text' value='' class='nhsuk-input ", $field_content );
					$field_content = preg_replace( "#<textarea(.*?)class='#", "<textarea$1class='nhsuk-textarea ", $field_content );
				}
				$find []   = "#<div class='gchoice (.*?)'><input(.*?)type='radio'(.*?)><label(.*?)</label></div>#i";
				$replace[] = "<div class='gchoice nhsuk-radios__item $1'><input $2 type='radio' $3 class='nhsuk-radios__input'><label class='nhsuk-label nhsuk-radios__label' $4</label> </div>";
				$find []   = "#<div class='gchoice (.*?)'><input(.*?)class='gfield-choice-input(.*?)type='checkbox'(.*?)><label(.*?)</label></div>#i";
				$replace[] = "<div class='gchoice nhsuk-checkboxes__item $1'><input $2 type='checkboxes' class='gfield_choice_input nhsuk-checkboxes__input $3 $4><label class='nhsuk-label nhsuk-checkboxes__label' $5</label> </div>";

				// likert sort out. This is messy.

				$find[]        = "#<label class='gfield_label'>(.*?)</label><div(.*?)><table class='gsurvey-likert'(.*?)><thead>(.*?)</thead><tbody>(.*?)</tbody></table></div>#";                                                                                                              // strip out all the table gunk.
				$replace[]     = "<fieldset class='gsurvey-likert nhsuk-fieldset'$2><legend class='nhsuk-fieldset__legend'>$1</legend><div class='nhsuk-radios nhsuk-radios--inline nhsuk-likert'><div class='nhsuk-likert__row nhsuk-likert__header'>$4</div>$5</div></fieldset>";             // replace it with a much simpler div layout.
				$find[]        = '#<th(.*?)>(.*?)</th>#';
				$replace[]     = "<div class='nhsuk-radios__item nhsuk-likert__item'>$2</div>";
				$find[]        = "#<div class='nhsuk-radios nhsuk-radios--inline nhsuk-likert'>(.*?)<tr><td(.*?)class='gsurvey-likert-row-label'>(.*?)</td>(.*?)</tr></div>#"; // identify multi row tables.
				$replace[]     = "<div class='nhsuk-radios nhsuk-radios--inline nhsuk-likert nhsuk-likert__multi'>$1<tr><td$2 class='gsurvey-likert-row-label'>$3</td>$4</tr></div>";
				$find[]        = "#<tr><td(.*?)class='gsurvey-likert-row-label'>(.*?)</td>(.*?)</tr>#"; // modify multi row grids.
				$replace[]     = "<div class='nhsuk-likert__row'$1><div class='nhsuk-likert__item nhsuk-likert__rowlabel'>$2</div>$3</div>";
				$find[]        = '#<tr>(.*?)</tr>#'; // now mop up the single row grids.
				$replace[]     = "<div class='nhsuk-likert__row'>$1</div>";
				$find[]        = "#<td data-label='(.*?)' class='gsurvey-likert-choice'><input name='(.*?)' type='radio' value='(.*?)'id='(.*?)'/></td>#";                                                                                                                                                 // we just have to pull out the td's now.
				$replace[]     = "<div data-label='$1' class='nhsuk-radios__item nhsuk-likert__item'><input name='$2' class='nhsuk-radios__input' type='radio' value='$3' id='$4'/><label class='nhsuk-label nhsuk-radios__label' for='$4'><span class='nhsuk-u-visually-hidden'>$1</span></label></div>"; // and turn them into pretty divs with nhsuk-radios.
				$field_content = preg_replace( $find, $replace, $field_content );
				$field_content = str_replace( 'nhsuk-checkboxes__input  nhsuk-radios__input', 'nhsuk-checkboxes__input', $field_content );
				break;
			// Chained Selects.
			case 'chainedselect':
				if ( 1 === $errorflag ) {
					$errorclass = 'nhsuk-select--error';
				}
				$find[]        = '<select';
				$replace[]     = '<select class="gfield_select nhsuk-select ' . $errorclass . '"';
				$field_content = str_replace( $find, $replace, $field_content );
				break;
			default: // everything else.
				$field_content = $field_content;
				break;

		}
	}

	return $field_content;
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

/**
 * This function adds the passed classs name to the select box.
 * 
 * @param mixed $html HTML content.
 * @param mixed $class_name class name to add.
 * @return array|string|null
 */
function add_class_to_select( $html, $class_name ) {
	// Regex to find the <select> tag.
	$pattern = '/<select([^>]*)>/i';

	// Perform the replacement.
	$updated_html = preg_replace_callback(
		$pattern,
		function ( $matches ) use ( $class_name ) {
			if ( strpos( $matches[1], 'class=' ) !== false ) {
				// If a class already exists, append the new class if not present.
				return str_replace( 'class="', 'class="' . $class_name . ' ', $matches[0] );
			} else {
				// No class attribute, add one.
				return '<select' . $matches[1] . ' class="' . $class_name . '">';
			}
		},
		$html
	);

	return $updated_html;
}



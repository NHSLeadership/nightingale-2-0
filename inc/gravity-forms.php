<?php
/**
 * Style Gravity Forms
 * Field Types are:
 *  text
 *  textarea
 *  checkbox
 *  radio
 *  email
 *  number
 *  select
 *  multiselect
 *
 * Also extend expiration of save and continue links from 30 days to 1 year
 *
 */

 // Use gform_get_form_filter to style main form elements
 // See https://docs.gravityforms.com/gform_get_form_filter/
 add_filter( 'gform_get_form_filter', function ( $form_string, $form ) {

    // Replace form description span with <small> elements
    $form_string = preg_replace("#<span class='gform_description'>(.*?)</span>#", "<small>$1</small>", $form_string);

    // Style error messages
      // Message at top of form
      $form_string = str_replace( "validation_error", "c-form-input is-error validation_error", $form_string );
      // Fields with CSS class = "gfield_error"
      $form_string = str_replace( "gfield_error", "is-error gfield_error", $form_string );
      // Fields contained in <li> elements that have CSS class = "gfield_error"
      $form_string = preg_replace( "#<li(.*?)gfield_error(.*?)<input(.*?)class='#s", "<li$1gfield_error$2<input$3class='gfield_error is-error ", $form_string );
      // Error messages below fields
      $form_string = str_replace("validation_message", "c-form-error validation_message", $form_string);

    // Style <ul>
    $form_string = str_replace( "class='gform_fields", "class='c-form-list gform_fields", $form_string );

    // Replace <h3> with <h2>
    $form_string = str_replace( "<h3", "<h2", $form_string );
    $form_string = str_replace( "/h3>", "/h2>", $form_string );

    // Replace field description divs with <small> elements
    $form_string = preg_replace("#<div class='gfield_description'>(.*?)</div>#", "<small>$1</small>", $form_string);

    // Replace field instruction divs with <small> elements
    $form_string = preg_replace("#<div class='instruction(.*?)>(.*?)</div>#", "<small>$2</small>", $form_string);

    // Indicate mandatory fields with "Required" rather than "*"
    $form_string = str_replace( "<span class='gfield_required'>*</span>", "<span class='gfield_required'> (Required)</span>", $form_string );

    // Replace main <label> elements with <strong>s
    $form_string = preg_replace("#<label class='gfield_label'(.*?)>(.*?)</label>#", "<strong class='c-form-label'>$2</strong>", $form_string);

    // Remove <ul>s around elements
    $form_string = preg_replace("#<ul class='gfield(.*?)>(.*?)</ul>#s", "$2", $form_string);

    // Replace checkbox and radio option <label>s with <span>s
    $form_string = preg_replace("#<label for='choice(.*?)>(.*?)</label>#i", "<span class='c-form-checkbox__faux'></span>$2", $form_string);

    //Style the submit button
    $form_string = str_replace( "gform_button", "c-btn c-btn--submit gform_button", $form_string );

    return $form_string;
 }, 10, 2 );

// Use gform_field_content to style individual fields
// See https://docs.gravityforms.com/gform_field_content/
add_filter( 'gform_field_content', function ( $field_content, $field ) {

    // Text inputs
    if ( $field->type == 'text' ) {
      $field_content = str_replace( "type='text' value='' class='", "type='text' value='' class='c-form-input ", $field_content );
    }

    // Text areas
    if ( $field->type == 'textarea' ) {
      $field_content = preg_replace( "#<textarea(.*?)class='#", "<textarea$1class='nhsuk-textarea ", $field_content );
    }

    // Selects
    if ( $field->type == 'select' ) {
      $field_content = str_replace( "ginput_container ginput_container_select", "c-form-dropdown", $field_content );
      $field_content = str_replace( "gfield_select", "nhsuk-select", $field_content );
    }

    // Emails
    if ( $field->type == 'email' ) {
      $field_content = str_replace( "type='email' value='' class='", "type='email' value='' class='c-form-input ", $field_content );
    }

    // Numbers
    if ( $field->type == 'number' ) {
      $field_content = preg_replace("#<input(.*?)class='#", "<input$1class='c-form-input ", $field_content);
    }

    // Checkboxes
    if ( $field->type == 'checkbox' ) {

      // Replace <li> elements with suitably-styled <label>s
      $field_content = str_replace("<li class='", "<label class='c-form-checkbox ", $field_content);
      $field_content = str_replace("</li", "</label", $field_content);

      // Style <input>s
      $field_content = str_replace( "type='checkbox'", "type='checkbox' class='nhsuk-checkboxes__input'", $field_content );

    }

    // Radio buttons
    if ( $field->type == 'radio' ) {

      // Replace <li> elements with <label>s with Nightingale CSS classes
      $field_content = str_replace("<li class='", "<label class='c-form-checkbox c-form-checkbox--radio ", $field_content);
      $field_content = str_replace("</li", "</label", $field_content);

      // Style <input>s
      $field_content = str_replace( "type='radio'", "type='radio' class='c-form-checkbox__input'", $field_content );

    }

    return $field_content;
}, 10, 2 );

// Extend expiration of save and continue links from 30 days to 1 year
add_filter( 'gform_incomplete_submissions_expiration_days', 'gwp_days', 10, 1 );
function gwp_days( $expiration_days ) {
    $expiration_days = 365;
    return $expiration_days;
}


/**
 * Styling for the extra bits that sit outside the main form area in multipage forms.
 */

// Style the previous button
add_filter( 'gform_previous_button', 'form_previous_button', 10, 2 );
function form_previous_button( $button, $form ) {
    return str_replace( "gform_previous_button button", "nhsuk-button nhsuk-button--reverse", $button );
}

// Style the next button
add_filter( 'gform_next_button', 'form_next_button', 10, 2 );
function form_next_button( $button, $form ) {
    return str_replace( "gform_next_button button", "nhsuk-button", $button );
}

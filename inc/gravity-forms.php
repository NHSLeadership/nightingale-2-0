<?php
/**
 * Customised Gravity Forms output markup
 * @date September 26 2019
 * @version 1.0
 * @author Tony Blacker
 * @organisation NHS Leadership Academy
 * @copyright OGL v3
 */
add_filter( 'gform_field_content', 'nightingale_clean_gf_inputs', 10, 5);
function nightingale_clean_gf_inputs( $input, $field, $value, $lead_id, $form_id )
{
/*
	echo '<pre>';
	echo print_r($field);
	echo '</pre>';
	echo '<hr />';
*/

	if ($field->validation_message != '') {
		$errorflag = 1;
		$grouperror = ' nhsuk-form-group--error';
	} else {
		$errorflag = 0;
		$grouperror = '';
	}
	$fieldset = '<div class="nhsuk-form-group'.$grouperror.'"><fieldset class="nhsuk-fieldset" aria-describedby="example-hint">
                                      <legend class="nhsuk-fieldset__legend">
                                        ' . $field->label . '';
	if ($field->isRequired != '') {
		$fieldset .= '&nbsp;&nbsp;<span class="nhsuk-pill-warn">Required</span>';
	}
	if ($errorflag == 1) {
		$fieldset .= '<span class="nhsuk-error-message">'.$field->validation_message.'</span>';
	}
	$fieldset .= '</legend>';
	if (!empty($field->description)) {
		$fieldset .= '<span class="nhsuk-hint">
                                        ' . $field->description . '
                                      </span>';
	}
	$ender = '';
	$extra = '';
	if ($field->gwreadonly_enable > 0) {
		$extra .= ' readonly';
	}
	$wrapper = '';
	$choices = ''; // initialise all the strings
	switch ($field->type) { // available values: radio, poll, survey, email, number, multiselect, text, textarea, checkbox, select
		case 'multiselect':
			break;
		case 'checkbox':
			$wrapper .= '<div class="nhsuk-checkboxes" id="input_' . $form_id . '_' . $field->id . '">';
			$i = 0;
			foreach ($field->choices as $selection) {
				$choices .= '<div class="nhsuk-checkboxes__item">
                                      <input class="nhsuk-checkboxes__input" id="choice_' . $form_id . '_' . $field->id . '_' . $i . '" name="input_' . $field->id . '" type="checkbox" value="' . $selection['value'] . '"'.$extra.'>
                                      <label class="nhsuk-label nhsuk-checkboxes__label" for="choice_' . $form_id . '_' . $field->id . '_' . $i . '" id="label_' . $form_id . '_' . $field->id . '_' . $i . '">
                                        ' . $selection['text'] . '
                                      </label>
                                    </div>';
				$i++;
			}
			$ender .= '</div>';
			break;
		case 'poll':
		case 'radio':
			$wrapper .= '<div class="nhsuk-radios  nhsuk-radios--inline" id="input_' . $form_id . '_' . $field->id . '">';
			$i = 0;
			foreach ($field->choices as $selection) {
				$choices .= '<div class="nhsuk-radios__item">
                                      <input class="nhsuk-radios__input" id="choice_' . $form_id . '_' . $field->id . '_' . $i . '" name="input_' . $field->id . '" type="radio" value="' . $selection['value'] . '">
                                      <label class="nhsuk-label nhsuk-radios__label" for="choice_' . $form_id . '_' . $field->id . '_' . $i . '" id="label_' . $form_id . '_' . $field->id . '_' . $i . '">
                                        ' . $selection['text'] . '
                                      </label>
                                    </div>';
				$i++;
			}
			$ender .= '</div>';
			break;
		case 'survey':
			//@todo this looks pants in mobile view. It really needs to be made into a div layout
			$choices .= '<table class="gsurveytable"><tr><td ></td>';
			foreach ($field->choices as $options) {
				$choices .= '<td>'.$options['text'].'</td>';
			}
			$choices .= '</tr>';
			$i = 1;
			if ($field->inputs) {
				foreach ($field->inputs as $selection) {
					$choices .= '<tr class="nhsuk-radios nhsuk-radios--inline"><td>'.$selection['label'].'</td>';
					$j = 1;
					foreach ($field->choices as $options) {
						if ($options['isSelected'] == '1') {
							$extra = ' checked';
						} else {
							$extra = '';
						}
						$choices .= '<td><div class="nhsuk-radios__item">
                                        <input class="nhsuk-radios__input" id="choice_' . $form_id . '_' . $field->id . '_' . $i . '_'. $j . '" name="input_' . $field->id . '.'.$i.'" type="radio" value="' . $options['value'] . '"'.$extra.'>
                                        <label class="nhsuk-label nhsuk-radios__label" for="choice_' . $form_id . '_' . $field->id . '_' . $i . '_'. $j . '">'.$options['text'].'</label>
                                      </div></td>';
						$j++;
					}
					$choices .= '</tr>';
					$i++;
				}
			}
			$choices .= '</table>';
			break;
		case 'textarea' : // text field
			$choices .= '<textarea rows="5" class="nhsuk-textarea" id="label_' . $form_id . '_' . $field->id . '" name="input_' . $field->id . '" ' . $extra .'></textarea>';
			break;
		case 'number':
			$choices .= '<input class="nhsuk-input nhsuk-input--width-10" id="input_' . $form_id . '_' . $field->id . '" name="input_' . $field->id . '" type="number" placeholder="'.$field->placeholder.'" value="'.$value.'" ' . $extra .'>';
			break;
		case 'email':
			$choices .= '<input class="nhsuk-input nhsuk-input--width-20" id="input_' . $form_id . '_' . $field->id . '" name="input_' . $field->id . '" type="email" placeholder="'.$field->placeholder.'" value="'.$value.'" ' . $extra .'>';
			break;
		case 'text':
			$choices .= '<input class="nhsuk-input" id="input_' . $form_id . '_' . $field->id . '" name="input_' . $field->id . '" type="text" placeholder="'.$field->placeholder.'" value="'.$value.'" ' . $extra .'>';
			break;
		case 'select':
			$choices .= '<select class="nhsuk-select" id="input_' . $form_id . '_' . $field->id . '" name="input_' . $field->id . '">';
			$i = 0;
			foreach ($field->choices as $selection) {
				if ($selection['isSelected'] == '1') {
					$extra = ' selected';
				} else {
					$extra = '';
				}
				$choices .= '<option value="' . $selection['value'] . '"'.$extra.'>'.$selection['value'].'</option>';
				$i++;
			}
			$choices .= '</select>';
			break;
		default:
			break;
	}
	$ender .= '</fieldset></div>';
	$collection = $fieldset . $wrapper . $choices . $ender;
	return $collection;
};
// Extend expiration of save and continue links from 30 days to 1 year
add_filter( 'gform_incomplete_submissions_expiration_days', 'gwp_days', 10, 1 );
function gwp_days( $expiration_days ) {
	$expiration_days = 365;
	return $expiration_days;
}
add_filter( 'gform_get_form_filter', function ( $form_string, $form ) {
	//Style the submit button
	$form_string = str_replace( "gform_button", "nhsuk-button", $form_string );
	return $form_string;
}, 10, 2 );

<?php
/**
 * The template for the select input.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets/v2/components/meta/select.php
 *
 * @since5.0.0
 *
 * @version5.0.0
 *
 * @var string $field_name The meta field name.
 * @var string $field_id The meta field id.
 * @var bool   $required A bool indicating if the meta field is required or not.
 * @var bool $disabled A bool indicating if the meta field is disabled or not.
 * @var string|int $attendee_id The attendee ID, to build the ID/name.
 * @var array $classes Array containing the CSS classes for the field.
 * @var Tribe__Tickets__Ticket_Object $ticket The ticket object.
 * @var Tribe__Tickets_Plus__Meta__Field__Select $field
 *
 * @see Tribe__Tickets_Plus__Meta__Field__Select
 *
 * @package Nightingale
 */

$slug    = $field->slug;
$options = $field->get_hashed_options_map();

// Bail if there are no options.
if ( ! $options ) {
	return;
}
$classes[] = 'nhsuk-form-group';

?>
<div <?php tribe_classes( $classes ); ?>>
	<label
		class="nhsuk-label"
		for="<?php echo esc_attr( $field_id ); ?>"
		><?php echo wp_kses_post( $field->label ); ?><?php tribe_required_label( $required ); ?>
	</label>
	<select
		<?php tribe_disabled( $disabled ); ?>
		id="<?php echo esc_attr( $field_id ); ?>"
		class="nhsuk-select"
		name="<?php echo esc_attr( $field_name ); ?>"
		<?php tribe_required( $required ); ?>
	>
		<option value=""><?php esc_html_e( 'Select an option', 'nightingale' ); ?></option>
		<?php foreach ( $options as $option => $label ) : ?>
			<option
				<?php selected( $label, $value ); ?> value="<?php echo esc_attr( $label ); ?>"><?php echo esc_html( $label ); ?></option>
		<?php endforeach; ?>
	</select>
</div>

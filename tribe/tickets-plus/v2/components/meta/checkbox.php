<?php
/**
 * This template renders the Checkbox field.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets/v2/components/meta/checkbox.php
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
 * @var Tribe__Tickets_Plus__Meta__Field__Checkbox $field.
 *
 * @see Tribe__Tickets_Plus__Meta__Field__Checkbox
 *
 * @package Nightingale
 */

$options = $field->get_hashed_options_map();

if ( ! $options ) {
	return;
}
$field_slug = $field->slug;
$classes[]  = 'nhsuk-form-group';
?>
<div <?php tribe_classes( $classes ); ?>>
	<fieldset class="nhsuk-fieldset" aria-describedby="example-hint">
		<legend class="nhsuk-fieldset__legend nhsuk-fieldset__legend--s">
			<h1 class="nhsuk-fieldset__heading">
				<?php echo wp_kses_post( $field->label ); ?><?php tribe_required_label( $required ); ?>
			</h1>
		</legend>

	<div class="nhsuk-checkboxes">
		<?php
		foreach ( $options as $option ) :
			$option_slug = md5( sanitize_title( $option ) );
			$option_id   = tribe_tickets_plus_meta_field_id( $ticket->ID, $field_slug, $option_slug, $attendee_id );
			$slug        = $field_slug . '_' . $option_slug;
			$field_name  = tribe_tickets_plus_meta_field_name( $ticket->ID, $slug, $attendee_id );
			$value       = [];
			?>

		<div class="nhsuk-checkboxes__item">

				<input
					class="nhsuk-checkboxes__input"
					id="<?php echo esc_attr( $option_id ); ?>"
					name="<?php echo esc_attr( $field_name ); ?>"
					type="checkbox"
					value="<?php echo esc_attr( $option ); ?>"
					<?php checked( true, in_array( $slug, $value, true ) ); ?>
					<?php disabled( $field->is_restricted( $attendee_id ) ); ?>
					<?php tribe_required( $required ); ?>
				/>
			<label
				class="nhsuk-label nhsuk-checkboxes__label"
				for="<?php echo esc_attr( $option_id ); ?>"
			>
				<?php echo wp_kses_post( $option ); ?>
			</label>
		</div>
		<?php endforeach; ?>
	</div>
	<input
		type="hidden"
		name="<?php echo esc_attr( tribe_tickets_plus_meta_field_name( $ticket->ID, null, $attendee_id ) . '[0]' ); ?>"
		<?php disabled( $field->is_restricted( $attendee_id ) ); ?>
		value=""
		autocomplete="off"
	>
	</fieldset>
</div>

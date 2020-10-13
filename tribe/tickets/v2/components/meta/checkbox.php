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
 */

$options = $field->get_hashed_options_map();

if ( ! $options ) {
	return;
}

$field_slug = $field->slug;
?>
<div <?php tribe_classes( $classes ); ?>>
	<header class="tribe-tickets__form-field-label">
		<span>
			<?php echo wp_kses_post( $field->label ); ?><?php tribe_required_label( $required ); ?>
		</span>
	</header>
	<div class="tribe-common-form-control-checkbox-radio-group">
		<?php
		foreach ( $options as $option ) :
			$option_slug = md5( sanitize_title( $option ) );
			$option_id   = tribe_tickets_plus_meta_field_id( $ticket->ID, $field_slug, $option_slug, $attendee_id );
			$slug        = $field_slug . '_' . $option_slug;
			$field_name  = tribe_tickets_plus_meta_field_name( $ticket->ID, $slug, $attendee_id );
			$value       = [];
			?>

		<div class="tribe-common-form-control-checkbox">
			<label
				class="tribe-common-form-control-checkbox__label"
				for="<?php echo esc_attr( $option_id ); ?>"
			>
				<input
					class="tribe-common-form-control-checkbox__input tribe-tickets__form-field-input tribe-tickets__form-field-input--checkbox"
					id="<?php echo esc_attr( $option_id ); ?>"
					name="<?php echo esc_attr( $field_name ); ?>"
					type="checkbox"
					value="<?php echo esc_attr( $option ); ?>"
					<?php checked( true, in_array( $slug, $value, true ) ); ?>
					<?php disabled( $field->is_restricted( $attendee_id ) ); ?>
					<?php tribe_required( $required ); ?>
				/><hr />
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
</div>

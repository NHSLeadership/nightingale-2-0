<?php
/**
 * This template renders the Text or Textarea field.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets/v2/components/meta/text.php
 *
 * @since5.0.0
 *
 * @version5.0.0
 *
 * @var string $field_name The meta field name.
 * @var string $field_id The meta field id.
 * @var bool   $required A bool indicating if the meta field is required or not.
 * @var string|int $attendee_id The attendee ID, to build the ID/name.
 * @var array $classes Array containing the CSS classes for the field.
 * @var Tribe__Tickets__Ticket_Object $ticket The ticket object.
 * @var Tribe__Tickets_Plus__Meta__Field__Text $field.
 *
 * @see Tribe__Tickets_Plus__Meta__Field__Text
 */

$multiline = Tribe__Utils__Array::get( $field, [ 'extra', 'multiline' ], null );
?>
<div <?php tribe_classes( $classes ); ?>>
	<label
		class="tribe-tickets__form-field-label"
		for="<?php echo esc_attr( $field_id ); ?>"
	><?php echo wp_kses_post( $field->label ); ?><?php tribe_required_label( $required ); ?></label>
	<?php if ( $multiline ) : ?>
		<textarea
			id="<?php echo esc_attr( $field_id ); ?>"
			class="tribe-common-form-control-text__input tribe-tickets__form-field-input"
			name="<?php echo esc_attr( $field_name ); ?>"
			<?php tribe_required( $required ); ?>
			<?php tribe_disabled( $disabled ); ?>
		><?php echo esc_textarea( $value ); ?></textarea>
	<?php else : ?>
		<input
			type="text"
			id="<?php echo esc_attr( $field_id ); ?>"
			class="tribe-common-form-control-text__input tribe-tickets__form-field-input"
			name="<?php echo esc_attr( $field_name ); ?>"
			value="<?php echo esc_attr( $value ); ?>"
			<?php tribe_required( $required ); ?>
			<?php tribe_disabled( $disabled ); ?>
		/>
	<?php endif; ?>
</div>

<?php
/**
 * This template renders the date time field.
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets/v2/components/meta/datetime.php
 *
 * @since 5.0.0
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
 * @var Tribe__Tickets_Plus__Meta__Field__Datetime $field.
 *
 * @see Tribe__Tickets_Plus__Meta__Field__Datetime
 *
 * @package Nightingale
 */

$classes[] = 'nhsuk-form-group';
?>
<div <?php tribe_classes( $classes ); ?>>
	<label
		class="nhsuk-label"
		for="<?php echo esc_attr( $field_id ); ?>"
	><?php echo wp_kses_post( $field->label ); ?><?php tribe_required_label( $required ); ?></label>
	<input
		type="date"
		id="<?php echo esc_attr( $field_id ); ?>"
		class="nhsuk-input"
		name="<?php echo esc_attr( $field_name ); ?>"
		value="<?php echo esc_attr( $value ); ?>"
		min="1900-01-01"
		max="<?php echo esc_attr( (int) date_i18n( 'Y' ) + 100 ); ?>-12-31"
		<?php tribe_required( $required ); ?>
		<?php tribe_disabled( $disabled ); ?>
	/>
</div>

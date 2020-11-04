<?php
/**
 * View: Month View - Calendar Event Tooltip Description
 *
 * @package nightingale
 *
 * @version 4.9.10
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

if ( empty( (string) $event->excerpt ) ) {
	return;
}
?>
<div class="tribe-events-calendar-month__calendar-event-tooltip-description tribe-common-b3">
	<?php echo esc_html( (string) $event->excerpt ); ?>
</div>

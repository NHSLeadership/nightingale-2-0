<?php
/**
 * View: Month View - Single Event Tooltip Cost
 *
 * @package nightingale
 *
 * @version 4.9.9
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

if ( empty( $event->cost ) ) {
	return;
}
?>
<div class="tribe-events-c-small-cta tribe-common-b3 tribe-events-calendar-month__calendar-event-tooltip-cost">
	<span class="tribe-events-c-small-cta__price">
		<?php echo esc_html( $event->cost ); ?>
	</span>
</div>

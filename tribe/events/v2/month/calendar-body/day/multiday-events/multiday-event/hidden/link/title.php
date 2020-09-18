<?php
/**
 * View: Month View - Single Multiday Event Hidden Title
 *
 * @package nightingale
 *
 * @since 5.1.1
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 *
 * @version 5.1.1
 */

?>
<h3 class="tribe-events-calendar-month__multiday-event-hidden-title tribe-common-h8">
	<?php echo esc_html( $event->title ); ?>
</h3>

<?php
/**
 * View: Month View - More Events
 *
 * @package nightingale
 *
 * @version 4.9.8
 *
 * @var int $more_events The number of events that's not showing in the day cell or in the multi-day stack.
 * @var string $more_url A string with the URL for more events on that day
 *
 * @see tribe_get_event() For the format of the event object.
 */

// Bail if there are no more events to show.
if ( empty( $more_events ) || empty( $more_url ) ) {
	return;
}
?>

<div class="tribe-events-calendar-month__more-events">
	<a
			href="<?php echo esc_url( $more_url ); ?>"
			class="tribe-events-calendar-month__more-events-link tribe-common-h8 tribe-common-h--alt tribe-common-anchor-thin"
			data-js="tribe-events-view-link"
	>
		<?php
		echo esc_html(
			sprintf(
				/* translators: %d: Name of current month */
				_n( '+ %d More', '+ %d More', $more_events, 'nightingale' ),
				$more_events
			)
		)
		?>
	</a>
</div>

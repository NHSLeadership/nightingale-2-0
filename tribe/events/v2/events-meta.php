<?php
	$event = get_query_var( 'event');
	$event_date_attr = $event->dates->start->format( Tribe__Date_Utils::DBDATEFORMAT );
	$tribeid = get_the_id();
	$icons = nightingale_events_icons();
	$event_times = nightingale_start_end_event( 'D j M' );

?>

<div class="event-meta">

	<?php

		if( $event_times ){
			echo sprintf(
				'<div class="event-date-time">%3$s
				<time class="tribe-events-calendar-list__event-datetime" datetime="%4$s"> 
				%1$s %2$s</time>
				</div>',
				esc_html( $event_times['start-date'] ),
				esc_html( $event_times['start-time'] ),
				$icons['calendar'], // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				esc_attr( $event_date_attr )
			);
		}
	?>

	<?php if ( tribe_get_venue( $tribeid ) ) : ?>
		<dd class="venue-address">
			<?php echo $icons['marker']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<address class="tribe-events-address">
				<?php tribe_get_full_address(); ?>
				<?php  echo esc_html( tribe_get_venue( $tribeid ) ); ?><?php if( tribe_get_city( $tribeid ) ):  echo esc_html( ', ' . tribe_get_city( $tribeid ) ); endif; ?>
			</address>
		</dd>
	<?php endif; ?>
</div>

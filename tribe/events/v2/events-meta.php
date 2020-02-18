<?php
	$event = get_query_var( 'event');
	$event_date_attr = $event->dates->start->format( Tribe__Date_Utils::DBDATEFORMAT );
	$id = get_the_id();
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
				$icons['calendar'],
				esc_attr( $event_date_attr )
			);
		}
	?>

	<?php if ( tribe_get_venue( $id ) ) : ?>
		<dd class="venue-address">
			<?php echo $icons['marker']; ?>
			<address class="tribe-events-address">
				<?php tribe_get_full_address(); ?>
				<?php  echo tribe_get_venue( $id ); ?><?php if( tribe_get_city( $id ) ):  echo ', ' . tribe_get_city( $id ); endif; ?>
			</address>
		</dd>
	<?php endif; ?>
</div>
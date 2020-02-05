<?php
	$event = get_query_var( 'event');
	$event_date_attr = $event->dates->start->format( Tribe__Date_Utils::DBDATEFORMAT );
	$id = get_the_id();
	$icons = nightingale_events_icons();

?>

<div class="event-meta">
  	<div class="event-date-time">
  		<?php echo $icons['calendar']; ?>
  		<time class="tribe-events-calendar-list__event-datetime" datetime="<?php echo esc_attr( $event_date_attr ); ?>">
			<?php echo $event->schedule_details->value(); ?>
		</time>
	</div>
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
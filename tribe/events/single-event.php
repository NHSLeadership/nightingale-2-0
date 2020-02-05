<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<div id="tribe-events-content" class="tribe-events-single">

	<p class="tribe-events-back">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '&laquo; ' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
	</p>

	<!-- Notices -->
	<?php tribe_the_notices() ?>

	<?php

	/*
	 * Start end end times for the event.
	 */

	$time_format = get_option( 'time_format', Tribe__Date_Utils::TIMEFORMAT ); // get time format
	$event_date_attr =tribe_get_start_date( null, false, Tribe__Date_Utils::DBDATEFORMAT );
	$start_date = tribe_get_start_date( null, false, 'l d  F' ); // start date in correct format
	$start_time = tribe_get_start_date( null, false, $time_format ); // start time in time format
	$end_date = tribe_get_end_date( null, false, 'l d  F' ); // end date in correct format
	$end_time = tribe_get_end_date( null, false, $time_format ); // end time in time format
	$end = $end_date === $start_date ? $end_time : $end_date . ' ' . $end_time; // if start and end date are the same, just show the time

	$icons = nightingale_events_icons();

	?>

	<!-- #tribe-events-header -->

	<?php while ( have_posts() ) :  the_post(); ?>

	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

		<div class= "nhsuk-grid-row">
			<div class="nhsuk-grid-column-one-half">
				<?php 

				    if( has_post_thumbnail() ):

				    	the_post_thumbnail( 'large', ['class' => 'nhsuk-promo__img'] );

				    else:

				    	$fallback = get_theme_mod('blog_fallback');

				    	if( $fallback ){
				    		echo wp_get_attachment_image( $fallback, 'large', false, ['class' => 'nhsuk-promo__img'] );
				    	}	    	

				    endif; 

				?>


			</div>
		  	<div class="nhsuk-grid-column-one-half">
		    	<?php the_title( '<h1 class="tribe-events-single-event-title">', '</h1>' ); ?>


		    	<div class="event-meta">

		    		<?php

		    		if( $start_date ){
						echo sprintf(
							'<div class="event-date-time">%4$s
							<time class="tribe-events-calendar-list__event-datetime" datetime="%5$s"> 
							%1$s %2$s - %3$s</time>
							</div>',
							$start_date,
							$start_time,
							$end,
							$icons['calendar'],
							esc_attr( $event_date_attr )
						);
					}

			    	if( tribe_get_venue() ){

			    		echo sprintf(
			    			'<div class="venue-address">%5$s
			    			<address class="tribe-events-address"> 
			    			%1$s.  %2$s %3$s %4$s 
			    			</address></div>',
							tribe_get_venue(),
							tribe_get_address(),
							tribe_get_city(),
							tribe_get_zip(),
							$icons['marker']
						);
					}

						?>
					<?php 

					

					?>
					<?php if ( tribe_get_cost() ) : ?>
						<p class="tribe-events-cost">Price: <?php echo tribe_get_cost( null, true ) ?></p>
					<?php endif; ?>

					

				</div>

				<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

		  	</div>
		</div>

		<!-- Event content -->
		<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
		<div class="tribe-events-single-event-description tribe-events-content">
			<?php the_content(); ?>
		</div>

		

		<?php

		$organizer_ids = tribe_get_organizer_ids();
		$phone = tribe_get_organizer_phone();
		$email = tribe_get_organizer_email();
		$multiple = count( $organizer_ids ) > 1;

		if ( $organizer_ids ) { ?>

			

		<h3><?php esc_html_e('Questions about this event?', 'nightingale'); ?></h3>

		<p>Organiser<?php if($multiple): echo 's'; endif; ?>:

		<?php foreach ( $organizer_ids as $organizer ):
			echo tribe_get_organizer_link( $organizer );
			if( $multiple ): echo ', '; endif;
		endforeach; ?>
		</p>	

		<?php 

		if( $email ):

			echo sprintf(
				__( '<p><stong>Email:</stong> <a href="mailto:%1$s?subject=%2$s">%1$s</a></p>', 'nightingale' ),
				$email,
				get_the_title()
			);

		endif;

		if( $phone ):

			echo sprintf(
				__( '<p>Phone: %s</p>', 'nightingale' ),
				$phone 
			);

		endif;

		}


		$map_exists = tribe_embed_google_map();
		$map = tribe_get_embedded_map( get_the_id(), '100%', '400px', false );

		if( $map_exists ):

		?>

			<hr />

			<?php 

			echo $map; 

		endif;

		?>




	</div>

	<?php endwhile; ?>





	<!-- Event footer -->
	<?php include plugin_dir_path(__FILE__ ) . 'single-event/footer.php'; ?>
	<!-- #tribe-events-footer -->

</div><!-- #tribe-events-content -->
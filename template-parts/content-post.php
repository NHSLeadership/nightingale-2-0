<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 2.0 January 2020
 */

if( is_single() ):
	// if is single show existing template
	get_template_part('template-parts/content');

else:

$sidebar = ( 'true' === get_theme_mod('blog_sidebar') );

?>

<div class="<?php if( $sidebar ): echo 'nhsuk-grid-column-one-half'; else: echo 'nhsuk-grid-column-one-third'; endif; ?> nhsuk-promo-group__item">
	<div class="nhsuk-promo">
	  <a class="nhsuk-promo__link-wrapper" href="<?php the_permalink(); ?>">
	    
	    <?php 

	    if( has_post_thumbnail() ):

	    	the_post_thumbnail( 'thumbnail', ['class' => 'nhsuk-promo__img'] );

	    else:

	    	$fallback = get_theme_mod('blog_fallback');

	    	if( $fallback ){
	    		echo wp_get_attachment_image( $fallback, 'thumbnail', false, ['class' => 'nhsuk-promo__img'] );
	    	}	    	

	    endif; 

	    ?>
	    
	    <div class="nhsuk-promo__content">
	      <?php the_title('<h2 class="nhsuk-promo__heading">', '</h2>' ); ?>

	      	<?php if ( is_post_type_archive( 'tribe_events' ) ):      		

	      		$event = get_query_var( 'event');
	      		$event_date_attr = $event->dates->start->format( Tribe__Date_Utils::DBDATEFORMAT );
	      		$id = get_the_id();

	      	?>
	      	<div class="event-meta">
		      	<div class="event-date-time">
		      		<svg class="nhsuk-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M400 64h-48V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H160V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm-6 400H54c-3.3 0-6-2.7-6-6V160h352v298c0 3.3-2.7 6-6 6z"/></svg>
		      		<time class="tribe-events-calendar-list__event-datetime" datetime="<?php echo esc_attr( $event_date_attr ); ?>">
						<?php echo $event->schedule_details->value(); ?>
					</time>
				</div>
				<?php if ( tribe_get_venue( $id ) ) : ?>
					<dd class="venue-address">
						<svg class="nhsuk-icon map-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M192 0C85.903 0 0 86.014 0 192c0 71.117 23.991 93.341 151.271 297.424 18.785 30.119 62.694 30.083 81.457 0C360.075 285.234 384 263.103 384 192 384 85.903 297.986 0 192 0zm0 464C64.576 259.686 48 246.788 48 192c0-79.529 64.471-144 144-144s144 64.471 144 144c0 54.553-15.166 65.425-144 272zm-80-272c0-44.183 35.817-80 80-80s80 35.817 80 80-35.817 80-80 80-80-35.817-80-80z"/></svg>
						<address class="tribe-events-address">
							<?php tribe_get_full_address(); ?>
							<?php  echo tribe_get_venue( $id ); ?><?php if( tribe_get_city( $id ) ):  echo ', ' . tribe_get_city( $id ); endif; ?>
						</address>
					</dd>
				<?php endif; ?>
			</div>

	  		<?php endif; ?>
	      
	        <?php the_excerpt(); ?>
	      
	    </div>
	  </a>
	</div>
</div>

<?php endif; ?>
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
	      	?>
	      	<div class="event-date-time">
	      		<svg class="nhsuk-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M400 64h-48V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H160V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm-6 400H54c-3.3 0-6-2.7-6-6V160h352v298c0 3.3-2.7 6-6 6z"/></svg>
	      		<time class="tribe-events-calendar-list__event-datetime" datetime="<?php echo esc_attr( $event_date_attr ); ?>">
					<?php echo $event->schedule_details->value(); ?>
				</time>
			</div>
	  		<?php endif; ?>
	      
	        <?php the_excerpt(); ?>
	      
	    </div>
	  </a>
	</div>
</div>

<?php endif; ?>
<?php
/**
 * View: Top Bar
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/top-bar.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @version 4.9.10
 *
 */


$event_terms = get_terms( array(
	'taxonomy'      => 'tribe_events_cat',
    'hide_empty'    => true,
    'orderby'       => 'name',
	'order'         => 'ASC',
) );


$current_tax = get_query_var('term') ? get_query_var('term') : 0;
$base_url = esc_url_raw( trailingslashit( get_home_url() . '/' .  tribe_get_option( 'eventsSlug', 'events' )  ) );

?>
<div class="tribe-events-c-top-bar tribe-events-header__top-bar">

	<?php $this->template( 'components/top-bar/today' ); ?>

	<?php $this->template( 'list/top-bar/datepicker' ); ?>

	<?php $this->template( 'components/top-bar/actions' ); ?>

	<label class="nhsuk-label" for="select-1">
	    Events Category 
	</label>

	<select name="select-1" id="select-1" class="nhsuk-select">
		<option value="<?php echo $base_url; ?>">All Events</option>

		<?php foreach ( $event_terms as $term ): 

			$selected = $current_tax === $term->slug ? 'selected' : '';
		?>

			<option class="level-0" value="<?php echo $base_url . 'category/' . $term->slug . '/'; ?>" <?php echo $selected; ?> >
				<?php echo $term->name; ?>					
			</option>

		<?php endforeach; ?>
		
	</select>

</div>

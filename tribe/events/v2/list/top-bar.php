<?php
/**
 * View: Top Bar
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/top-bar.php
 *
 * See more documentation about our views templating system.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 18th February 2020
 *
 * @version 4.9.10
 */

$event_terms = get_terms(
	array(
		'taxonomy'   => 'tribe_events_cat',
		'hide_empty' => true,
		'orderby'    => 'name',
		'order'      => 'ASC',
	)
);


$current_tax = get_query_var( 'term' ) ? get_query_var( 'term' ) : 0;
$base_url    = esc_url_raw( trailingslashit( get_home_url() . '/' . tribe_get_option( 'eventsSlug', 'events' ) ) );

?>
<div class="tribe-events-c-top-bar tribe-events-header__top-bar">

	<?php $this->template( 'components/top-bar/today' ); ?>

	<?php $this->template( 'list/top-bar/datepicker' ); ?>

	<?php $this->template( 'components/top-bar/actions' ); ?>

	<label class="nhsuk-label events-dropdown" for="select-1">
		<?php echo esc_html__( 'Event categories', 'nightingale' ); ?>
	</label>

	<select name="select-1" id="select-1" class="nhsuk-select">
		<option value="<?php echo esc_attr( $base_url ); ?>"><?php echo esc_html__( 'All events', 'nightingale' ); ?></option>

		<?php
		foreach ( $event_terms as $tribeterm ) :

			$selected = $current_tax === $tribeterm->slug ? 'selected' : '';
			?>

			<option value="<?php echo esc_attr( $base_url . 'category/' . $tribeterm->slug . '/' ); ?>" <?php echo esc_attr( $selected ); ?> >
				<?php echo esc_html( $tribeterm->name ); ?>
			</option>

		<?php endforeach; ?>

	</select>

</div>

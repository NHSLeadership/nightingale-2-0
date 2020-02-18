<?php
/**
 * View: List View
 *
 * Override this template in your own theme by creating a file at:
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 18th February 2020
 *
 * @var array    $events               The array containing the events.
 * @var string   $rest_url             The REST URL.
 * @var string   $rest_nonce           The REST nonce.
 * @var int      $should_manage_url    int containing if it should manage the URL.
 * @var bool     $disable_event_search Boolean on whether to disable the event search.
 * @var string[] $container_classes    Classes used for the container of the view.
 * @var array    $container_data       An additional set of container `data` attributes.
 */

$header_classes = [ 'tribe-events-header' ];
if ( empty( $disable_event_search ) ) {
	$header_classes[] = 'tribe-events-header--has-event-search';
}

$sidebar = nightingale_show_sidebar();
?>
<div
	<?php tribe_classes( $container_classes ); ?>
	data-js="tribe-events-view"
	data-view-rest-nonce="<?php echo esc_attr( $rest_nonce ); ?>"
	data-view-rest-url="<?php echo esc_url( $rest_url ); ?>"
	data-view-manage-url="<?php echo esc_attr( $should_manage_url ); ?>"
	<?php foreach ( $container_data as $key => $value ) : ?>
		data-view-<?php echo esc_attr( $key ); ?>="<?php echo esc_attr( $value ); ?>"
	<?php endforeach; ?>
>

		<?php $this->template( 'components/loader', [ 'text' => __( 'Loading...', 'nightingale' ) ] ); ?>

		<?php $this->template( 'components/data' ); ?>

		<?php $this->template( 'components/before' ); ?>

		<header <?php tribe_classes( $header_classes ); ?>>
			<?php $this->template( 'components/messages' ); ?>

			<?php $this->template( 'components/events-bar' ); ?>

			<?php $this->template( 'list/top-bar' ); ?>
		</header>

		<?php $this->template( 'components/filter-bar' ); ?>

		<div class="nhsuk-grid-row">

			<div class="
			<?php
			if ( $sidebar ) :
				echo 'nhsuk-grid-column-two-thirds';
			endif;
			?>
				">

				<div class="nhsuk-grid-row nhsuk-promo-group">

					<?php foreach ( $events as $event ) : ?>
						<?php $this->setup_postdata( $event ); ?>

						<?php set_query_var( 'event', $event ); ?>

						<?php get_template_part( 'template-parts/content', 'post' ); ?>

					<?php endforeach; ?>

				</div>

			</div>

			<?php
			if ( $sidebar ) :
				get_template_part( 'tribe/events/sidebar-events' );
			endif;
			?>

		</div>

		<?php $this->template( 'list/nav' ); ?>

		<?php $this->template( 'components/after' ); ?>

	</div>


<?php $this->template( 'components/breakpoints' ); ?>

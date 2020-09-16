<?php
/**
 * View: Day View
 *
 * @package nightingale
 *
 * @version 5.0.2
 *
 * @var array $events The array containing the events.
 * @var string $rest_url The REST URL.
 * @var string $rest_nonce The REST nonce.
 * @var bool $disable_event_search Boolean on whether to disable the event search.
 * @var string[] $container_classes Classes used for the container of the view.
 * @var bool $should_manage_url Whether the view should manage the URL or not.
 * @var array $container_data An additional set of container `data` attributes.
 * @var string $breakpoint_pointer String we use as pointer to the current view we are setting up with breakpoints.
 */

$header_classes = [ 'tribe-events-header' ];
if ( empty( $disable_event_search ) ) {
	$header_classes[] = 'tribe-events-header--has-event-search';
}

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
	<?php if ( ! empty( $breakpoint_pointer ) ) : ?>
		data-view-breakpoint-pointer="<?php echo esc_attr( $breakpoint_pointer ); ?>"
	<?php endif; ?>
>
	<div class="tribe-common-l-container tribe-events-l-container">
		<?php $this->template( 'components/loader', [ 'text' => __( 'Loading...', 'nightingale' ) ] ); ?>

		<?php $this->template( 'components/json-ld-data' ); ?>

		<?php $this->template( 'components/data' ); ?>

		<?php $this->template( 'components/before' ); ?>

		<header <?php tribe_classes( $header_classes ); ?>>
			<?php $this->template( 'components/messages' ); ?>

			<?php $this->template( 'components/breadcrumbs' ); ?>

			<?php $this->template( 'components/events-bar' ); ?>

			<?php $this->template( 'day/top-bar' ); ?>
		</header>

		<?php $this->template( 'components/filter-bar' ); ?>

		<div class="tribe-events-calendar-day">

			<?php foreach ( $events as $event ) : ?>
				<?php $this->setup_postdata( $event ); ?>
				<?php $this->template( 'day/type-separator', [ 'event' => $event ] ); ?>
				<?php $this->template( 'day/time-separator', [ 'event' => $event ] ); ?>
				<?php $this->template( 'day/event', [ 'event' => $event ] ); ?>

			<?php endforeach; ?>

		</div>

		<?php $this->template( 'day/nav' ); ?>

		<?php $this->template( 'components/ical-link' ); ?>

		<?php $this->template( 'components/after' ); ?>

	</div>

</div>

<?php $this->template( 'components/breakpoints' ); ?>
<style>
	.tribe-events-calendar-day .tribe-events-calendar-day__event,
	.tribe-events-calendar-day .tribe-events-calendar-day__event {
		background: #ffffff;
		border: 2px solid #4c6272;
		padding: 16px;
		border-radius: 4px;
	}

	.tribe-events .tribe-events-calendar-day .tribe-events-calendar-day__time-separator {
		display: none;
	}

	.tribe-events .tribe-events-c-top-bar__datepicker-button {
		background-color: #ffffff;
		box-shadow: none;
		color: #000000;
		border-radius: 0;
		border: 2px solid #4c6272;
		padding: 10px 25px 10px 10px;
		appearance: menulist;
	}

	.tribe-events .tribe-events-c-top-bar__datepicker-button:after {
		content: '';
		width: 30px;
		height: 30px;
		background: linear-gradient(45deg, transparent 50%, #4c6272 50%),
		linear-gradient(135deg, #4c6272 50%, transparent 50%),
		linear-gradient(to right, white, white);
		background-position: calc(100% - 21px) calc(1em + 2px),
		calc(100% - 16px) calc(1em + 2px),
		100% 0;
		background-size: 5px 5px,
		5px 5px,
		2.5em 2.5em;
		background-repeat: no-repeat;
		position: relative;
		left: 25px;
		bottom: 5px;
	}

	.navigation .nhsuk-pagination ul.nhsuk-pagination__list li.nhsuk-pagination-item--next.disabled a:visited .nhsuk-icon,
	.navigation .nhsuk-pagination ul.nhsuk-pagination__list li.nhsuk-pagination-item--prev.disabled a:visited .nhsuk-icon,
	.navigation .nhsuk-pagination ul.nhsuk-pagination__list li.nhsuk-pagination-item--next.disabled a .nhsuk-icon,
	.navigation .nhsuk-pagination ul.nhsuk-pagination__list li.nhsuk-pagination-item--prev.disabled a .nhsuk-icon,
	.navigation .nhsuk-pagination ul.nhsuk-pagination__list .nhsuk-pagination-item--next.disabled a,
	.navigation .nhsuk-pagination ul.nhsuk-pagination__list .nhsuk-pagination-item--next.disabled a:visited {
		color: gray !important;
		fill: gray !important;
	}

	.navigation .nhsuk-pagination ul.nhsuk-pagination__list .nhsuk-pagination-item--next.disabled a:hover {
		cursor: not-allowed;
	}
</style>

<?php
/**
 * View: List View - Single Event Date
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event/date.php
 *
 * See more documentation about our views templating system.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 18th February 2020
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

use Tribe__Date_Utils as Dates;

$event_date_attr = $event->dates->start->format( Dates::DBDATEFORMAT );

?>
<div class="tribe-events-calendar-list__event-datetime-wrapper tribe-common-b2">
	<?php if ( $event->featured ) : ?>
		<em
			class="tribe-events-calendar-list__event-datetime-featured-icon tribe-common-svgicon tribe-common-svgicon--featured"
			aria-label="<?php esc_attr_e( 'Featured', 'nightingale' ); ?>"
			title="<?php esc_attr_e( 'Featured', 'nightingale' ); ?>"
		>
		</em>
		<span class="tribe-events-calendar-list__event-datetime-featured-text tribe-common-a11y-visual-hide">
			<?php esc_html_e( 'Featured', 'nightingale' ); ?>
		</span>
	<?php endif; ?>
	<time class="tribe-events-calendar-list__event-datetime" datetime="<?php echo esc_attr( $event_date_attr ); ?>">
		<?php echo esc_html( $event->schedule_details->value() ); ?>
	</time>
	<?php $this->template( 'list/event/date/meta', [ 'event' => $event ] ); ?>
</div>

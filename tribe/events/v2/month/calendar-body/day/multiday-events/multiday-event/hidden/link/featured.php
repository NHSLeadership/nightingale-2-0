<?php
/**
 * View: Month View - Single Multiday Event Hidden Featured Icon
 *
 * @package nightingale
 *
 * @since 5.1.1
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 *
 * @version 5.1.1
 */

if ( empty( $event->featured ) ) {
	return;
}
?>
<em
	class="tribe-events-calendar-month__multiday-event-hidden-featured-icon tribe-common-svgicon tribe-common-svgicon--featured"
	aria-label="<?php esc_attr_e( 'Featured', NHSUK_DOMAIN_NAME ); ?>"
	title="<?php esc_attr_e( 'Featured', NHSUK_DOMAIN_NAME ); ?>"
></em>

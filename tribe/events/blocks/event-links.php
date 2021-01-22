<?php
/**
 * Block: Event Links
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/blocks/event-links.php
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Andrew Blane
 * @version 1.0 20th January 2021
 *
 */

// don't show on password protected posts
if ( post_password_required() ) {
	return;
}

$has_google_cal = $this->attr( 'hasGoogleCalendar' );
$has_ical       = $this->attr( 'hasiCal' );

$should_render = $has_google_cal || $has_ical;

remove_filter( 'the_content', 'do_blocks', 9 );

if ( $should_render ) :
?>
	<div class="tribe-block tribe-block__events-link">
		<h3 class="nhsuk-heading-s">Calendar Links</h3>
		<p> <?php echo __('The following links allow you to add this event to your calendar. Note: You need to be logged into your Google account before you can add to your Google calendar.','nightingale') ?></p>
		<?php if ( $has_google_cal ) : ?>
			<div class="tribe-block__btn--link tribe-block__events-gcal">
				<a
					href="<?php echo Tribe__Events__Main::instance()->esc_gcal_url( tribe_get_gcal_link() ); ?>"
					title="<?php esc_attr_e( 'Add to Google Calendar', 'nightingale' ); ?>"
				>
					<img alt="Google Calendar link" src="<?php echo Tribe__Main::instance()->plugin_url  . 'src/modules/icons/link.svg'; ?>" />
					<?php echo esc_html( $this->attr( 'googleCalendarLabel' ) ) ?>
				</a>
			</div>
		<?php endif; ?>
		<?php if ( $has_ical ) : ?>
			<div class="tribe-block__btn--link tribe-block__-events-ical">
				<a
					href="<?php echo esc_url( tribe_get_single_ical_link() ); ?>"
					title="<?php esc_attr_e( 'Download .ics file', 'nightingale' ); ?>"
				>
					<img alt="iCalendar file download link" src="<?php echo Tribe__Main::instance()->plugin_url  . 'src/modules/icons/link.svg'; ?>" />
					<?php echo esc_html( $this->attr( 'iCalLabel' ) ) ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php add_filter( 'the_content', 'do_blocks', 9 );

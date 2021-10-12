<?php
/**
 * View: Month View Nav Today Button
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/mobile-events/nav/today.php
 *
 * See more documentation about our views templating system.
 *
 * @package nightingale
 *
 * @var string $today_url The URL to the today page.
 *
 * @version 5.0.1
 */

?>
<li class="tribe-events-c-nav__list-item tribe-events-c-nav__list-item--today">
	<a
		href="<?php echo esc_url( $today_url ); ?>"
		class="tribe-events-c-nav__today tribe-common-b2"
		data-js="tribe-events-view-link"
		aria-label="<?php esc_attr_e( 'Click to select today\'s date', NHSUK_DOMAIN_NAME ); ?>"
		title="<?php esc_attr_e( 'Click to select today\'s date', NHSUK_DOMAIN_NAME ); ?>"
	>
		<?php esc_html_e( 'Today', NHSUK_DOMAIN_NAME ); ?>
	</a>
</li>

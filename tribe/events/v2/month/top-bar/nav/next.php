<?php
/**
 * View: Top Bar Navigation Next Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/top-bar/nav/next.php
 *
 * See more documentation about our views templating system.
 *
 * @package nightingale
 *
 * @var string $next_url The URL to the next page, if any, or an empty string.
 *
 * @version 5.0.1
 */

?>
<li class="tribe-events-c-top-bar__nav-list-item nhsuk-pagination-item--next">
	<a
			href="<?php echo esc_url( $next_url ); ?>"
			aria-label="<?php esc_attr_e( 'Next month', 'nightingale' ); ?>"
			title="<?php esc_attr_e( 'Next month', 'nightingale' ); ?>"
			data-js="tribe-events-view-link"
			rel="next"
	>
		<span class="nhsuk-pagination__title"><?php echo esc_html( $next_label ); ?></span>
		<svg class="nhsuk-icon nhsuk-icon--arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
			<path d="m14.7 6.3 5 5c.2.2.3.4.3.7 0 .3-.1.5-.3.7l-5 5a1 1 0 0 1-1.4-1.4l3.3-3.3H5a1 1 0 0 1 0-2h11.6l-3.3-3.3a1 1 0 1 1 1.4-1.4Z"/>
		</svg>
	</a>
</li>

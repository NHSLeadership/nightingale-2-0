<?php
/**
 * View: Top Bar Navigation Previous Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/top-bar/nav/prev.php
 *
 * See more documentation about our views templating system.
 *
 * @package nightingale
 *
 * @var string $prev_url The URL to the previous page, if any, or an empty string.
 *
 * @version 5.0.1
 */

?>
<li class="tribe-events-c-top-bar__nav-list-item nhsuk-pagination-item--previous">
	<a
			href="<?php echo esc_url( $prev_url ); ?>"
			aria-label="<?php esc_attr_e( 'Previous month', 'nightingale' ); ?>"
			title="<?php esc_attr_e( 'Previous month', 'nightingale' ); ?>"
			data-js="tribe-events-view-link"
			rel="prev"
	>
		<span class="nhsuk-pagination__title"><?php echo esc_html( $prev_label ); ?></span>
		<svg class="nhsuk-icon nhsuk-icon--arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
			<path d="M10.7 6.3c.4.4.4 1 0 1.4L7.4 11H19a1 1 0 0 1 0 2H7.4l3.3 3.3c.4.4.4 1 0 1.4a1 1 0 0 1-1.4 0l-5-5A1 1 0 0 1 4 12c0-.3.1-.5.3-.7l5-5a1 1 0 0 1 1.4 0Z"/>
		</svg>
	</a>
</li>

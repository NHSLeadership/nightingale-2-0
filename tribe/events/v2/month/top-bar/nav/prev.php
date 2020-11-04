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
		<svg class="nhsuk-icon nhsuk-icon__arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
			<path d="M4.1 12.3l2.7 3c.2.2.5.2.7 0 .1-.1.1-.2.1-.3v-2h11c.6 0 1-.4 1-1s-.4-1-1-1h-11V9c0-.2-.1-.4-.3-.5h-.2c-.1 0-.3.1-.4.2l-2.7 3c0 .2 0 .4.1.6z"></path>
		</svg>
	</a>
</li>

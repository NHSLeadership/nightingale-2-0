<?php
/**
 * View: List View Nav Next Button
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/nav/next.php
 *
 * See more documentation about our views templating system.
 *
 * @var string $link The URL to the next page.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 18th February 2020
 */

?>
<li class="nhsuk-pagination-item--next">
	<a
		href="<?php echo esc_url( $link ); ?>"
		rel="next"
		class="nhsuk-pagination__link nhsuk-pagination__link--next"
		data-js="tribe-events-view-link"
	>

		<span class="nhsuk-pagination__title"><?php echo esc_html__( 'Next', 'nightingale' ); ?></span>

		<svg class="nhsuk-icon nhsuk-icon--arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
			<path d="m14.7 6.3 5 5c.2.2.3.4.3.7 0 .3-.1.5-.3.7l-5 5a1 1 0 0 1-1.4-1.4l3.3-3.3H5a1 1 0 0 1 0-2h11.6l-3.3-3.3a1 1 0 1 1 1.4-1.4Z"/>
		</svg>
	</a>
</li>

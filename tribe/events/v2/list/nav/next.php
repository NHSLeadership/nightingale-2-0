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

		<svg class="nhsuk-icon nhsuk-icon__arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
			<path d="M19.6 11.66l-2.73-3A.51.51 0 0 0 16 9v2H5a1 1 0 0 0 0 2h11v2a.5.5 0 0 0 .32.46.39.39 0 0 0 .18 0 .52.52 0 0 0 .37-.16l2.73-3a.5.5 0 0 0 0-.64z"></path>
		</svg>
	</a>
</li>

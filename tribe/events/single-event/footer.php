<?php
/**
 * Single Event Footer Template Part
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/single-event/footer.php
 *
 * See more documentation about our Blocks Editor templating system.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 18th February 2020
 */

?>

<nav class="nhsuk-pagination" role="navigation" aria-label="Pagination">
	<ul class="nhsuk-list nhsuk-pagination__list">
		<li class="nhsuk-pagination-item--next">

			<?php
			tribe_the_next_event_link(
				'
				<span class="nhsuk-pagination__title">%title%</span>
				<svg class="nhsuk-icon nhsuk-icon__arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
				  <path d="M19.6 11.66l-2.73-3A.51.51 0 0 0 16 9v2H5a1 1 0 0 0 0 2h11v2a.5.5 0 0 0 .32.46.39.39 0 0 0 .18 0 .52.52 0 0 0 .37-.16l2.73-3a.5.5 0 0 0 0-.64z"></path>
				</svg>
			'
			);
			?>
		</li>
		<li class="nhsuk-pagination-item--previous">
			<?php
			tribe_the_prev_event_link(
				'
				<span class="nhsuk-pagination__title">%title%</span>
				<svg class="nhsuk-icon nhsuk-icon__arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
				  <path d="M4.1 12.3l2.7 3c.2.2.5.2.7 0 .1-.1.1-.2.1-.3v-2h11c.6 0 1-.4 1-1s-.4-1-1-1h-11V9c0-.2-.1-.4-.3-.5h-.2c-.1 0-.3.1-.4.2l-2.7 3c0 .2 0 .4.1.6z"></path>
				</svg>
			'
			);
			?>
		</li>
	</ul>
</nav>

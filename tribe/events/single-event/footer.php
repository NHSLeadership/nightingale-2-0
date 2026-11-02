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
				<svg class="nhsuk-icon nhsuk-icon--arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
				  <path d="m14.7 6.3 5 5c.2.2.3.4.3.7 0 .3-.1.5-.3.7l-5 5a1 1 0 0 1-1.4-1.4l3.3-3.3H5a1 1 0 0 1 0-2h11.6l-3.3-3.3a1 1 0 1 1 1.4-1.4Z"/>
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
				<svg class="nhsuk-icon nhsuk-icon--arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
				  <path d="M10.7 6.3c.4.4.4 1 0 1.4L7.4 11H19a1 1 0 0 1 0 2H7.4l3.3 3.3c.4.4.4 1 0 1.4a1 1 0 0 1-1.4 0l-5-5A1 1 0 0 1 4 12c0-.3.1-.5.3-.7l5-5a1 1 0 0 1 1.4 0Z"/>
				</svg>
			'
			);
			?>
		</li>
	</ul>
</nav>

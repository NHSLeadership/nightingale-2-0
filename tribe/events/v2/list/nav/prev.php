<?php
/**
 * View: List View Nav Previous Button
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/nav/prev.php
 *
 * See more documentation about our views templating system.
 *
 * @var string $link The URL to the previous page.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 18th February 2020
 */

?>


<li class="nhsuk-pagination-item--previous">
	<a
		href="<?php echo esc_url( $link ); ?>"
		rel="prev"
		class="nhsuk-pagination__link nhsuk-pagination__link--prev"
		data-js="tribe-events-view-link"
	>

	<span class="nhsuk-pagination__title"><?php echo esc_html__( 'Previous', 'nightingale' ); ?></span>

	<svg class="nhsuk-icon nhsuk-icon--arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
		<path d="M10.7 6.3c.4.4.4 1 0 1.4L7.4 11H19a1 1 0 0 1 0 2H7.4l3.3 3.3c.4.4.4 1 0 1.4a1 1 0 0 1-1.4 0l-5-5A1 1 0 0 1 4 12c0-.3.1-.5.3-.7l5-5a1 1 0 0 1 1.4 0Z"/>
	</svg>

	</a>
</li>

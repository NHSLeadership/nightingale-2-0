<?php
/**
 * View: List View Nav Previous Button
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/nav/prev.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @var string $link The URL to the previous page.
 *
 * @version 5.0.0
 *
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

	<svg class="nhsuk-icon nhsuk-icon__arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
      <path d="M4.1 12.3l2.7 3c.2.2.5.2.7 0 .1-.1.1-.2.1-.3v-2h11c.6 0 1-.4 1-1s-.4-1-1-1h-11V9c0-.2-.1-.4-.3-.5h-.2c-.1 0-.3.1-.4.2l-2.7 3c0 .2 0 .4.1.6z"></path>
    </svg>

	</a>
</li>

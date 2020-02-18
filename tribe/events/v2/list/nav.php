<?php
/**
 * View: List View Nav Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/nav.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTCILE_LINK_HERE}
 *
 * @var string $prev_url The URL to the previous page, if any, or an empty string.
 * @var string $next_url The URL to the next page, if any, or an empty string.
 * @var string $today_url The URL to the today page, if any, or an empty string.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 18th February 2020
 */

?>
<nav class="nhsuk-pagination" role="navigation" aria-label="Pagination">
	<ul class="nhsuk-list nhsuk-pagination__list">
		<?php
		if ( ! empty( $prev_url ) ) {
			$this->template( 'list/nav/prev', [ 'link' => $prev_url ] );
		}
		?>

		<?php
		if ( ! empty( $next_url ) ) {
			$this->template( 'list/nav/next', [ 'link' => $next_url ] );
		}
		?>
	</ul>
</nav>

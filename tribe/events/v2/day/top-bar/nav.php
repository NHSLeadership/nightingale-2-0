<?php
/**
 * View: Top Bar - Navigation
 *
 * @package nightingale
 *
 * @version 5.0.1
 *
 * @var string $prev_url The URL to the previous page, if any, or an empty string.
 * @var string $next_url The URL to the next page, if any, or an empty string.
 */

?>
<nav class="tribe-events-c-top-bar__nav tribe-common-a11y-hidden">
	<ul class="tribe-events-c-top-bar__nav-list">
		<?php
		if ( ! empty( $prev_url ) ) {
			$this->template( 'day/top-bar/nav/prev' );
		} else {
			$this->template( 'day/top-bar/nav/prev-disabled' );
		}
		?>

		<?php
		if ( ! empty( $next_url ) ) {
			$this->template( 'day/top-bar/nav/next' );
		} else {
			$this->template( 'day/top-bar/nav/next-disabled' );
		}
		?>
	</ul>
</nav>

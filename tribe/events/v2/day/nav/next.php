<?php
/**
 * View: Day View Nav Next Button
 *
 * @package nightingale
 *
 * @var string $link The URL to the next page.
 *
 * @version 5.0.1
 */

?>
<li class="tribe-events-c-nav__list-item tribe-events-c-nav__list-item--next">
	<a
		href="<?php echo esc_url( $link ); ?>"
		rel="next"
		class="tribe-events-c-nav__next tribe-common-b2 tribe-common-b1--min-medium"
		data-js="tribe-events-view-link"
		aria-label="<?php esc_attr_e( 'Next Day', 'nightingale' ); ?>"
		title="<?php esc_attr_e( 'Next Day', 'nightingale' ); ?>"
	>
		<?php esc_html_e( 'Next Day', 'nightingale' ); ?>
	</a>
</li>

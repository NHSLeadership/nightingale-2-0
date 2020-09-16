<?php
/**
 * View: Day View Nav Previous Button
 *
 * @package nightingale
 *
 * @var string $link The URL to the previous page.
 *
 * @version 5.0.1
 */

?>
<li class="tribe-events-c-nav__list-item tribe-events-c-nav__list-item--prev">
	<a
		href="<?php echo esc_url( $link ); ?>"
		rel="prev"
		class="tribe-events-c-nav__prev tribe-common-b2 tribe-common-b1--min-medium"
		data-js="tribe-events-view-link"
		aria-label="<?php esc_attr_e( 'Previous Day', 'nightingale' ); ?>"
		title="<?php esc_attr_e( 'Previous Day', 'nightingale' ); ?>"
	>
		<?php esc_html_e( 'Previous Day', 'nightingale' ); ?>
	</a>
</li>

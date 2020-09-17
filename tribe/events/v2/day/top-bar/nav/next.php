<?php
/**
 * View: Top Bar Navigation Next Template
 *
 * @package nightingale
 *
 * @var string $next_url The URL to the next page, if any, or an empty string.
 *
 * @version 5.0.1
 */

?>
<li class="tribe-events-c-top-bar__nav-list-item">
	<a
		href="<?php echo esc_url( $next_url ); ?>"
		class="tribe-common-c-btn-icon tribe-common-c-btn-icon--caret-right tribe-events-c-top-bar__nav-link tribe-events-c-top-bar__nav-link--next"
		aria-label="<?php esc_attr_e( 'Next day', 'nightingale' ); ?>"
		title="<?php esc_attr_e( 'Next day', 'nightingale' ); ?>"
		data-js="tribe-events-view-link"
	>
	</a>
</li>

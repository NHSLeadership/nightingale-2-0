<?php
/**
 * View: Loader
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/tickets/v2/components/loader/loader.php
 *
 * See more documentation about our views templating system.
 *
 * @link {INSERT_ARTICLE_LINK_HERE}
 *
 * @version 4.12.3
 */

$classes = $this->get( 'classes' ) ?: [];

$spinner_classes = [
	'tribe-tickets-loader__dots',
	'tribe-common-c-loader',
	'tribe-common-a11y-hidden',
];

if ( ! empty( $classes ) ) {
	$spinner_classes = array_merge( $spinner_classes, (array) $classes );
}

?>
<div <?php tribe_classes( $spinner_classes ); ?>>
	<div class="tribe-common-c-loader__dot tribe-common-c-loader__dot--first"></div>
	<div class="tribe-common-c-loader__dot tribe-common-c-loader__dot--second"></div>
	<div class="tribe-common-c-loader__dot tribe-common-c-loader__dot--third"></div>
</div>

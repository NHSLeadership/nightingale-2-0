<?php
/**
 * Load critical path css at top of page inline, allowing lazy load of other css.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 17th September 2019
 */

/**
 * Queue up the inline CSS
 */
function nightingale_critical_styles() {
	echo '<style>';
	get_template_part( 'partials/criticalcss' );
	echo '</style>';
}

add_action( 'wp_head', 'nightingale_critical_styles', 1 );

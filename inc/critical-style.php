<?php
/**
 * Load critical path css at top of page inline, allowing lazy load of other css. Alternatively load in custom colour definition.
 *
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   1.1 13th January 2020
 */

/**
 * Queue up the inline CSS
 */
function nightingale_critical_styles() {
	echo '<style>';
	get_template_part( 'partials/criticalcss' );
	if ( is_admin_bar_showing() ) { // admin bar styling tweak to stop flicker effect.
		?>
        #wpadminbar {
            height: 32px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 99999;
            background: #1d2327;
        }
		<?php
	}
	echo '</style>';

}


$theme_colour = get_theme_mod( 'theme_colour', 'nhs_blue' );
if ( '005eb8' === $theme_colour || 'nhs_blue' === $theme_colour || '' === $theme_colour ) { // Default NHS Blue - load up the critical CSS inline, Boom.
	add_action( 'wp_head', 'nightingale_critical_styles', 1 );
}

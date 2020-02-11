<?php
/**
 * Load critical path css at top of page inline, allowing lazy load of other css. Alternatively load in custom colour definition.
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 13th January 2020
 */

/**
 * Queue up the inline CSS
 */
function nightingale_critical_styles() {
	echo '<style>';
	get_template_part( 'partials/criticalcss' );
	echo '</style>';
}
function nightingale_custom_colour_theme() {
	$theme_colour = get_theme_mod( 'theme_colour', 'nhs_blue' );
	?>
	<style type="text/css">
		.nhsuk-header, .nhsuk-header--white .nhsuk-search__submit, .nhsuk-header__navigation, #secondary section h2.widget-title, .nhsuk-panel-with-label__label, #secondary section #wp-calendar caption {
			background-color: #<?php echo $theme_colour; ?>;
			background: #<?php echo $theme_colour; ?>;
		}

		a {
			color: #<?php echo $theme_colour; ?>
		}

		.nhsuk-footer,
		#secondary section {
			border-top-color: #<?php echo $theme_colour; ?>
		}
	</style>
	<?php
}

$theme_colour = get_theme_mod( 'theme_colour', 'nhs_blue' );
if ( 'nhs_blue' === $theme_colour ) { // Default NHS Blue - load up the critical CSS inline, Boom.
	add_action( 'wp_head', 'nightingale_critical_styles', 1 );
} else { // lets put some inline css into the header to take control of the main colour.
	add_action( 'wp_head', 'nightingale_custom_colour_theme', 99 );
}

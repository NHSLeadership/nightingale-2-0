<?php
/**
 * Inject Google Tag Manager into the rendered output
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 18th February 2020
 **/

/**
 * Add gtm to a page
 */
function nightingale_gtm() {

	gtm4wp_the_gtm_tag();

}

add_action( 'nightingale_after_body', 'nightingale_gtm' );

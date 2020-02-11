<?php


function nightingale_gtm(){

	gtm4wp_the_gtm_tag();

}

add_action( 'nightingale_after_body', 'nightingale_gtm' );
<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}

if ( ! nightingale_show_sidebar() ) {
	return;
}
?>
<div class="nhsuk-grid__item nhsuk-grid-column-one-third">
	<aside id="secondary" class="widget-area nhsuk-width-container">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</aside><!-- #secondary -->
</div>

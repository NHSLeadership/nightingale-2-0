<?php
/**
 * The Top Navigation Menu for our theme
 *
 * This is the template that displays the top navigation region.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 13th January 2020
 */

$menu_locations     = get_nav_menu_locations(); // Get our nav locations (set in our theme, usually functions.php).
$mobile_toggle_menu = '<li class="nhsuk-header__menu" hidden><button class="nhsuk-header__menu-toggle nhsuk-header__navigation-link" id="toggle-menu" type="button" aria-expanded="false"><span class="nhsuk-u-visually-hidden">' . esc_html__( 'Browse', 'nightingale' ) . ' </span>' . esc_html__( 'More', 'nightingale' ) . '</button></li>';
$topmenu_args       = array(
	'menu'            => 'main-menu',
	'menu_class'      => 'nhsuk-header__navigation-list',
	'menu_id'         => 'menu-menu-top-menu',
	'container'       => false,
	'container_class' => '',
	'container_id'    => '',
	'fallback_cb'     => 'nightingale_page_menu_fallback',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'echo'            => false,
	'depth'           => 1,
	'walker'          => '',
	'theme_location'  => 'main-menu',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s' . $mobile_toggle_menu . '</ul>',
	'item_spacing'    => 'preserve',
	'add_li_class'    => 'nhsuk-header__navigation-item',
	'link_class'      => 'nhsuk-header__navigation-link',
);
$top_menu           = wp_nav_menu( $topmenu_args );

// The NHS.UK header script fails if the navigation has no items, so leave it out.
if ( ! $top_menu || false === strpos( $top_menu, 'nhsuk-header__navigation-item' ) ) {
	return;
}
?>
<nav class="nhsuk-header__navigation" id="header-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'nightingale' ); ?>">
	<div class="nhsuk-header__navigation-container nhsuk-width-container">
		<?php
		echo $top_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped by wp_nav_menu() or nightingale_page_menu_fallback().
		?>
	</div>
</nav>

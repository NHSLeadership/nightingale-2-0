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
$mobile_toggle_menu = '<li class="nhsuk-mobile-menu-container"><button class="nhsuk-header__menu-toggle nhsuk-header__navigation-link" id="toggle-menu" aria-expanded="false">
            <span class="nhsuk-u-visually-hidden">Browse</span>
            More
            <svg class="nhsuk-icon nhsuk-icon__chevron-down" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
              <path d="M15.5 12a1 1 0 0 1-.29.71l-5 5a1 1 0 0 1-1.42-1.42l4.3-4.29-4.3-4.29a1 1 0 0 1 1.42-1.42l5 5a1 1 0 0 1 .29.71z"></path>
            </svg>
          </button> <ul class="nhsuk-header__drop-down nhsuk-header__drop-down--hidden"></ul></li>';
$topmenu_args       = array(
	'menu'            => 'main-menu',
	'menu_class'      => 'nhsuk-header__navigation-list',
	'menu_id'         => 'menu-menu-top-menu',
	'container'       => false,
	'container_class' => '',
	'container_id'    => '',
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'echo'            => true,
	'depth'           => 1,
	'walker'          => '',
	'theme_location'  => 'main-menu',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s' . $mobile_toggle_menu . '</ul>',
	'item_spacing'    => 'preserve',
	'add_li_class'    => 'nhsuk-header__navigation-item',
	'link_class'      => 'nhsuk-header__navigation-link',
);
?>
<div class="nhsuk-navigation-container">
	<nav class="nhsuk-navigation" id="header-navigation" role="navigation" aria-label="Primary navigation">
	<?php
	wp_nav_menu( $topmenu_args );
	?>

	</nav>
</div>

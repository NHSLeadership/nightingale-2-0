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

$menu_locations = get_nav_menu_locations(); // Get our nav locations (set in our theme, usually functions.php).

$topmenu_args = array(
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
	'link_after'      => '<svg class="nhsuk-icon nhsuk-icon__chevron-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M15.5 12a1 1 0 0 1-.29.71l-5 5a1 1 0 0 1-1.42-1.42l4.3-4.29-4.3-4.29a1 1 0 0 1 1.42-1.42l5 5a1 1 0 0 1 .29.71z"></path>
        </svg>',
	'echo'            => true,
	'depth'           => 1,
	'walker'          => '',
	'theme_location'  => 'main-menu',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'item_spacing'    => 'preserve',
);
?>
<nav class="nhsuk-header__navigation" id="header-navigation" role="navigation" aria-label="Primary navigation" aria-labelledby="label-navigation">
	<div class="nhsuk-width-container">
		<p class="nhsuk-header__navigation-title"><span id="label-navigation"><?php echo esc_html__( 'Menu', 'nightingale' ); ?></span>
			<button class="nhsuk-header__navigation-close" id="close-menu">
				<svg class="nhsuk-icon nhsuk-icon__close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
					<path d="M13.41 12l5.3-5.29a1 1 0 1 0-1.42-1.42L12 10.59l-5.29-5.3a1 1 0 0 0-1.42 1.42l5.3 5.29-5.3 5.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l5.29-5.3 5.29 5.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z"></path>
				</svg>
				<span class="nhsuk-u-visually-hidden"><?php echo esc_html__( 'Close Menu', 'nightingale' ); ?></span>
			</button>
		</p>
		<?php
		wp_nav_menu( $topmenu_args );
		?>
	</div>
</nav>

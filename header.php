<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nightingale_2.0
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">


	<?php wp_head(); ?>
</head>
<body <?php body_class( 'js-enabled' ); ?>>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nightingale-2-0' ); ?></a>
<?php
if ( get_theme_mod( 'emergency_on' ) === 'yes' ) {
	get_template_part( 'partials/emergency-alert' );
}
?>
<header class="nhsuk-header nhsuk-header--transactional">
	<?php
	$header_layout = get_theme_mod( 'header_styles', 'normal' );
	get_template_part( 'partials/header-' . $header_layout );
	?>

	<?php
	$menu_locations = get_nav_menu_locations(); // Get our nav locations (set in our theme, usually functions.php)
	// This returns an array of menu locations ([LOCATION_NAME] = MENU_ID);.

	$menu_id    = $menu_locations['main-menu']; // Get the *footer-menu* menu ID.
	$header_nav = wp_get_nav_menu_items( $menu_id );
	if ( $header_nav ) { // Get the array of wp objects, the nav items for our queried location.
		?>
		<nav class="nhsuk-header__navigation" id="header-navigation" aria-label="Primary navigation" aria-labelledby="label-navigation">
			<p class="nhsuk-header__navigation-title"><span id="label-navigation">Menu</span>
				<button class="nhsuk-header__navigation-close" id="close-menu">
					<svg class="nhsuk-icon nhsuk-icon__close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
						<path d="M13.41 12l5.3-5.29a1 1 0 1 0-1.42-1.42L12 10.59l-5.29-5.3a1 1 0 0 0-1.42 1.42l5.3 5.29-5.3 5.29a1 1 0 0 0 0 1.42 1 1 0 0 0 1.42 0l5.29-5.3 5.29 5.3a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42z"></path>
					</svg>
					<span class="nhsuk-u-visually-hidden">Close menu</span>
				</button>
			</p>
			<ul id="menu-menu-top-menu" class="nhsuk-header__navigation-list">
				<?php

				foreach ( $header_nav as $nav_item ) {

					echo '<li class="nhsuk-header__navigation-item"><a class="nhsuk-header__navigation-link" href="' . esc_url( $nav_item->url ) . '" title="' . esc_html( $nav_item->title ) . '">' . esc_html( $nav_item->title ) . '</a></li>';

				}

				?>
			</ul>
		</nav>
		<?php
	} // end header nav check
	?>

</header>

<div id="content" class="nhsuk-width-container nhsuk-width-container--full">
	<main class="nhsuk-main-wrapper nhsuk-main-wrapper--no-padding" id="maincontent">
		<div id="contentinner" class="nhsuk-width-container">

<?php
/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link      https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   1.1 21st August 2019
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="theme" content="NHS-nightingale-2.2.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php
	wp_enqueue_script( 'jquery' );
	wp_head();
	flush();
	?>
</head>
<body <?php body_class(); ?>>
<?php
if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Open the body tag, pull in any hooked triggers.
	 **/
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}
wp_body_open();
?>
<?php do_action( 'nightingale_after_body' ); ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'nightingale' ); ?></a>
<?php

$header_layout = get_theme_mod( 'logo_type', 'transactional' );
$header_colour = get_theme_mod( 'header_styles', 'normal' );

if ( 'normal' !== $header_colour ) {
	$header_colour_text = ' nhsuk-header--white';
} else {
	$header_colour_text = '';
}
echo '<header class="nhsuk-header nhsuk-header--' . esc_attr( $header_layout . $header_colour_text ) . '" role="banner" data-module="nhsuk-header">';
?>
<div class="nhsuk-header__container nhsuk-width-container">
	<div class="nhsuk-header__service">
		<?php
		get_template_part( 'partials/logo' );
		?>
	</div>	
	<?php
	$header_search = get_theme_mod( 'show_search', 'yes' );
	if ( 'no' === $header_search ) {
		$headersearchextra = 'nhsuk-header__menu--only';
	} else {
		$headersearchextra = '';
	}
	?>

	<?php
	$account_class = '';
	if ( 'yes' === $header_search ) {
		$account_class = 'nhsuk-header__account--break';
		?>
		<search class="nhsuk-header__search">
			<?php get_search_form(); ?>
		</search>
		<?php
	}
	
	if ( is_user_logged_in() && get_theme_mod( 'show_account_info', true )) {
		$user = wp_get_current_user();
	?>
		<nav class="nhsuk-header__account <?php echo esc_attr( $account_class ); ?>" aria-label="Account">
			<ul class="nhsuk-header__account-list">
				<li class="nhsuk-header__account-item">
					<svg class="nhsuk-icon nhsuk-icon--user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32" height="32" focusable="false" aria-hidden="true">
						<path d="M12 1a11 11 0 1 1 0 22 11 11 0 0 1 0-22Zm0 2a9 9 0 0 0-5 16.5V18a4 4 0 0 1 4-4h2a4 4 0 0 1 4 4v1.5A9 9 0 0 0 12 3Zm0 3a3.5 3.5 0 1 1-3.5 3.5A3.4 3.4 0 0 1 12 6Z" />
					</svg>
					<?php echo esc_html( get_user_full_name() ); ?>
				</li>
				<li class="nhsuk-header__account-item">
					<a class="nhsuk-header__account-link" href="<?php echo esc_url( wp_logout_url() ); ?>">
						Log out
					</a>
				</li>
			</ul>
		</nav>
	<?php
	}
	?>	
</div>

<!-- Navigation container -->
<?php
get_template_part( 'partials/topnav' );
?>


</header>
<?php
$thispage = get_post_meta(
	get_the_id(),
	'tabbed-page',
	true
);

if ( $thispage ) {
	get_template_part( 'partials/tabs' );
} else {
	echo nightingale_breadcrumb(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

$page_color = get_post_meta( get_the_id(), 'page-color', true );

$extra_styles = $page_color ? 'page-style--' . $page_color : '';


?>

<div id="content" class="nhsuk-width-container-full">
	<main class="nhsuk-main-wrapper nhsuk-main-wrapper--no-padding <?php echo esc_attr( $extra_styles ); ?>" id="maincontent">
		<div id="contentinner" class="nhsuk-width-container">
		<?php
		flush();

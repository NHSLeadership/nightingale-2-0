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

	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
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
<script>document.body.className += ' js-enabled' + ('noModule' in HTMLScriptElement.prototype ? ' nhsuk-frontend-supported' : '');</script>
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
<a class="nhsuk-skip-link" data-module="nhsuk-skip-link" href="#maincontent"><?php esc_html_e( 'Skip to main content', 'nightingale' ); ?></a>
<?php

$header_layout = get_theme_mod( 'logo_type', 'transactional' );
$header_colour = get_theme_mod( 'header_styles', 'normal' );
$header_search = get_theme_mod( 'show_search', 'yes' );

$header_classes = 'nhsuk-header nhsuk-header--' . $header_layout;
if ( 'normal' !== $header_colour ) {
	$header_classes .= ' nhsuk-header--white';
}
?>
<header class="<?php echo esc_attr( $header_classes ); ?>" data-module="nhsuk-header" role="banner">
	<div class="nhsuk-header__container nhsuk-width-container">
		<?php
		get_template_part( 'partials/logo' );

		if ( 'yes' === $header_search ) {
			get_search_form();
		}

		get_template_part( 'partials/header-account' );
		?>
	</div>
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

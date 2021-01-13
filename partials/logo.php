<?php
/**
 * The logo for our theme
 *
 * This is the template that displays the logo
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 13th January 2020
 */

$nhs_logo          = get_theme_mod( 'nhs_logo', 'no' );
$header_layout     = get_theme_mod( 'logo_type', 'transactional' );
$org_name_checkbox = get_theme_mod( 'org_name_checkbox', 'no' );
$org_name_field    = get_theme_mod( 'org_name_field' );

/* Check if Organisation name should be different from the site name */

$logo_line_1 = 'no' === $org_name_checkbox ? get_bloginfo( 'name' ) : get_theme_mod( 'org_name_field' );
$logo_line_2 = 'no' === $org_name_checkbox ? get_bloginfo( 'description' ) : get_bloginfo( 'name' );

?>
<a href="<?php echo esc_url_raw( get_home_url() ); ?>" class="nhsuk-header__link nhsuk-header__link--service" aria-label="<?php bloginfo( 'name' ); ?> homepage">
<?php
if ( has_custom_logo() ) {
	?>
	<div class="nhsuk-header__logo">

		<?php if ( get_theme_mod( 'show_sitename' ) === 'yes' ) { ?>
			<div class="nhsuk-header__transactional-service-name">
			<?php the_custom_logo(); ?>
				<span class="nhsuk-header__transactional-service-name--link" ><?php echo esc_html( $logo_line_1 ); ?></span>
			</div>
			<?php
		} else {
			the_custom_logo();
		}
		?>
	</div>
	<?php
} elseif ( 'yes' === $nhs_logo ) {
	?>

	<?php
	if ( 'transactional' === $header_layout ) { // Transactional style display.
		?>
		<div class="nhsuk-header__logo nhsuk-header__logo--only">
			<span class="nhsuk-header__link" >
				<?php
				get_template_part( 'partials/nhslogo' );
				?>
			</span>
		</div>
		<div class="nhsuk-header__transactional-service-name">
			<span class="nhsuk-header__transactional-service-name--link"><?php echo esc_html( $logo_line_1 ); ?></span>
		</div>
		<?php
	} else { // Organisational style display.
		?>
		<div class="nhsuk-header__logo">
			<span class="nhsuk-header__link" >
				<?php
				get_template_part( 'partials/nhslogo' );
				?>
				<span class="nhsuk-organisation-name"><?php echo esc_html( $logo_line_1 ); ?></span>
				<span class="nhsuk-organisation-descriptor"><?php echo esc_html( $logo_line_2 ); ?></span>
			</span>
		</div>
		<?php
	}
	?>


	<?php
} else {
	?>
	<div class="nhsuk-header__logo">
		<span class="nhsuk-header__link">
			<span class="nhsuk-organisation-name"><?php echo esc_html( $logo_line_1 ); ?></span>
			<span class="nhsuk-organisation-descriptor"><?php echo esc_html( $logo_line_2 ); ?></span>
		</span>
	</div>
	<?php
}
?>
</a>

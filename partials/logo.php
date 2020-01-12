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

$nhs_logo      = get_theme_mod( 'nhs_logo', 'yes' );
$header_layout = get_theme_mod( 'logo_type', 'transactional' );

if ( has_custom_logo() ) {
	?>
    <div class="nhsuk-header__logo">
		<?php the_custom_logo(); ?>
		<?php if ( get_theme_mod( 'show_sitename' ) === 'yes' ) { ?>
            <div class="fdgfhnhsuk-header__transactional-service-name">
                <a class="nhsuk-header__transactional-service-name--link" href="<?php echo esc_url_raw( get_home_url() ); ?>"><?php bloginfo( 'name' ); ?></a>
            </div>
			<?php
		}
		?>
    </div>
	<?php
} else if ( 'yes' === $nhs_logo ) {
	?>

	<?php
	if ( 'transactional' === $header_layout ) { // Transactional style display.
		?>
        <div class="nhsuk-header__logo nhsuk-header__logo--only">
            <a class="nhsuk-header__link" href="<?php echo esc_url_raw( get_home_url() ); ?>" aria-label="<?php bloginfo( 'name' ); ?> homepage">
				<?php
				get_template_part( 'partials/nhslogo' );
				?>
            </a>
        </div>
        <div class="nhsuk-header__transactional-service-name">
            <a class="nhsuk-header__transactional-service-name--link" href="<?php echo esc_url_raw( get_home_url() ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
        </div>
		<?php
	} else { // Organisational style display.
		?>
        <div class="nhsuk-header__logo">
            <a class="nhsuk-header__link" href="<?php echo esc_url_raw( get_home_url() ); ?>" aria-label="<?php bloginfo( 'name' ); ?> homepage">
				<?php
				get_template_part( 'partials/nhslogo' );
				?>
                <span class="nhsuk-organisation-name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
                <span class="nhsuk-organisation-descriptor"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></span>
            </a>
        </div>
		<?php
	}
	?>


	<?php
} else {
	?>
    <div class="nhsuk-header__logo">
        <a class="nhsuk-header__link" href="<?php echo esc_url_raw( get_home_url() ); ?>" aria-label="<?php bloginfo( 'name' ); ?> homepage">
            <span class="nhsuk-organisation-name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
            <span class="nhsuk-organisation-descriptor"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></span>
        </a>
    </div>
	<?php
}

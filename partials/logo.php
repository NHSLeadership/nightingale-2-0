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

<?php
if ( has_custom_logo() ) {
	if ( get_theme_mod( 'show_sitename' ) === 'yes' ) {
		?>
		<div class="nhsuk-header__logo">
			<a href="<?php echo esc_url_raw( get_home_url() ); ?>" class="nhsuk-header__link nhsuk-header__link--service" aria-label="<?php bloginfo( 'name' ); ?> homepage">
				<?php the_custom_logo(); ?>
			</a>
		</div>
		<div class="nhsuk-header__transactional-service-name">
			<a href="<?php echo esc_url_raw( get_home_url() ); ?>" class="nhsuk-header__transactional-service-name--link" aria-label="<?php bloginfo( 'name' ); ?> homepage">
				<?php echo esc_html( $logo_line_1 ); ?>
			</a>
		</div>
		<?php
	} else {
		?>
		<div class="nhsuk-header__logo">
			<a href="<?php echo esc_url_raw( get_home_url() ); ?>" class="nhsuk-header__link nhsuk-header__link--service" aria-label="<?php bloginfo( 'name' ); ?> homepage">
				<?php
				the_custom_logo();
				?>
			</a>
		</div>
		<?php
	}
} elseif ( 'yes' === $nhs_logo ) {
	if ( 'transactional' === $header_layout ) { // Transactional style display.
		?>
		<div class="nhsuk-header__logo nhsuk-header__logo--only">
			<a href="<?php echo esc_url_raw( get_home_url() ); ?>" class="nhsuk-header__link" aria-label="<?php bloginfo( 'name' ); ?> homepage">
				<span class="nhsuk-header__link">
					<?php
					get_template_part( 'partials/nhslogo' );
					?>
				</span>
			</a>
		</div>
		<div class="nhsuk-header__transactional-service-name">
			<a href="<?php echo esc_url_raw( get_home_url() ); ?>" tabindex="-1" class="nhsuk-header__transactional-service-name--link" aria-label="<?php bloginfo( 'name' ); ?> homepage">
				<?php echo esc_html( $logo_line_1 ); ?>
			</a>
		</div>
		<?php
	} else { // Organisational style display.
		?>
		<div class="nhsuk-header__logo">
            <a href="<?php echo esc_url_raw(get_home_url()); ?>" class="nhsuk-header__link" aria-label="<?php bloginfo('name'); ?> homepage">
				<?php
				get_template_part('partials/nhslogo');
				$logo_lines = split_text($logo_line_1);
				?>
				<span class="nhsuk-organisation-name">
				<?php echo esc_html($logo_lines['line_1']);
				if (!empty($logo_lines['line_2'])) {
					?>
					<span class="nhsuk-organisation-name-split"><?php echo esc_html($logo_lines['line_2']); ?></span>
					<?php
				}
				?>      
				</span>
				<span class="nhsuk-organisation-descriptor"><?php echo esc_html($logo_line_2); ?></span>
            </a>
        </div>
		<?php
	}
} else {
	if ( 'transactional' === $header_layout ) { // Transactional style display.
		?>
		<div class="nhsuk-header__transactional-service-name">
			<a href="<?php echo esc_url_raw( get_home_url() ); ?>" class="nhsuk-header__transactional-service-name--link" aria-label="<?php bloginfo( 'name' ); ?> homepage">
				<?php echo esc_html( $logo_line_1 ); ?>
			</a>
		</div>
		<?php
	} else { // Organisational style display.
		?>
		<a href="<?php echo esc_url_raw( get_home_url() ); ?>" class="nhsuk-header__link nhsuk-header__link--service" aria-label="<?php bloginfo( 'name' ); ?> homepage">
			<span class="nhsuk-header__link">
				<?php
				$logo_lines = split_text($logo_line_1);
				?>
				<span class="nhsuk-organisation-name">
				<?php echo esc_html($logo_lines['line_1']);
				if (!empty($logo_lines['line_2'])) {
				?>
					<span class="nhsuk-organisation-name-split"><?php echo esc_html($logo_lines['line_2']); ?></span>
				<?php
				}
				?>      
				</span>
				<span class="nhsuk-organisation-descriptor"><?php echo esc_html( $logo_line_2 ); ?></span>
			</span>
		</a>
		<?php
	}
}
?>

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
if ( has_custom_logo() && 'yes' !== $nhs_logo) {
	the_custom_logo();
} elseif ( 'yes' === $nhs_logo ) {
	if ( 'transactional' === $header_layout ) { // Transactional style display.
		?>

		<a class="nhsuk-header__service-logo" href="<?php echo esc_url_raw( get_home_url() ); ?>" aria-label="<?php bloginfo( 'name' ); ?> homepage">
			<?php
				get_template_part( 'partials/nhslogo' );
			?>
			<span class="nhsuk-header__service-name"><?php echo esc_html( $logo_line_1 ); ?></span>
		</a>
		<?php
	} else { // Organisational style display.
		?>
		<a href="<?php echo esc_url_raw( get_home_url() ); ?>" class="nhsuk-header__service-logo" aria-label="<?php bloginfo('name'); ?> homepage">
			<?php
			get_template_part( 'partials/nhslogo' );
			$logo_lines = split_text( $logo_line_1 );
			?>
			<span class="nhsuk-header__organisation-name"><?php echo esc_html( array_shift( $logo_lines ) );?>
				<?php
				foreach ( $logo_lines as $logo_line ) :
				?>
					<span class="nhsuk-header__organisation-name-split"><?php echo esc_html( $logo_line ); ?></span>
				<?php
				endforeach
				?>      
			</span>
			<span class="nhsuk-header__organisation-name-descriptor"><?php echo esc_html($logo_line_2); ?></span>
		</a>
		<?php
	}
} else {
	if ( 'transactional' === $header_layout ) { // Transactional style display.
		?>
		<a href="<?php echo esc_url_raw( get_home_url() ); ?>" class="nhsuk-header__service-logo" aria-label="<?php bloginfo( 'name' ); ?> homepage">
			<span class="nhsuk-header__service-name">
				<?php echo esc_html( $logo_line_1 ); ?>
			</span>
		</a>
		<?php
	} else { // Organisational style display.
		?>
		
		<a href="<?php echo esc_url_raw( get_home_url() ); ?>" class="nhsuk-header__service-logo" aria-label="<?php bloginfo( 'name' ); ?> homepage">
			<?php
			$logo_lines = split_text( $logo_line_1 );
			?>
			<span class="nhsuk-organisation-name"><?php echo esc_html( array_shift( $logo_lines ) ); ?>
				<?php	
				foreach ( $logo_lines as $logo_line ) :
				?>
					<span class="nhsuk-organisation-name-split"><?php echo esc_html( $logo_line ); ?></span>
				<?php
				endforeach
				?>      
			</span>
			<span class="nhsuk-organisation-descriptor"><?php echo esc_html( $logo_line_2 ); ?></span>
		</a>
		
		<?php
	}
}
?>

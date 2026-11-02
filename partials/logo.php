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
$home_url   = get_home_url();
$home_label = get_bloginfo( 'name' ) . ' homepage';

/**
 * Output the organisation name, split across lines, and its descriptor.
 */
$nightingale_organisation_name = function () use ( $logo_line_1, $logo_line_2 ) {
	$logo_lines = split_text( $logo_line_1 );
	?>
	<span class="nhsuk-header__organisation-name"><?php echo esc_html( array_shift( $logo_lines ) ); ?>
		<?php foreach ( $logo_lines as $logo_line ) : ?>
			<span class="nhsuk-header__organisation-name-split"><?php echo esc_html( $logo_line ); ?></span>
		<?php endforeach; ?>
	</span>
	<span class="nhsuk-header__organisation-name-descriptor"><?php echo esc_html( $logo_line_2 ); ?></span>
	<?php
};
?>
<div class="nhsuk-header__service">
<?php
if ( has_custom_logo() ) {
	?>
	<a class="nhsuk-header__service-logo" href="<?php echo esc_url( $home_url ); ?>" aria-label="<?php echo esc_attr( $home_label ); ?>">
		<?php
		echo wp_get_attachment_image(
			get_theme_mod( 'custom_logo' ),
			'full',
			false,
			array(
				'class' => 'nhsuk-header__organisation-logo custom-logo',
				'alt'   => get_bloginfo( 'name' ),
			)
		);
		if ( get_theme_mod( 'show_sitename' ) === 'yes' ) {
			?>
			<span class="nhsuk-header__service-name"><?php echo esc_html( $logo_line_1 ); ?></span>
			<?php
		}
		?>
	</a>
	<?php
} elseif ( 'yes' === $nhs_logo ) {
	?>
	<a class="nhsuk-header__service-logo" href="<?php echo esc_url( $home_url ); ?>" aria-label="<?php echo esc_attr( $home_label ); ?>">
		<?php
		get_template_part( 'partials/nhslogo' );
		if ( 'transactional' === $header_layout ) { // Transactional style display.
			?>
			<span class="nhsuk-header__service-name"><?php echo esc_html( $logo_line_1 ); ?></span>
			<?php
		} else { // Organisational style display.
			$nightingale_organisation_name();
		}
		?>
	</a>
	<?php
} elseif ( 'transactional' === $header_layout ) { // Transactional style display.
	?>
	<a class="nhsuk-header__service-name" href="<?php echo esc_url( $home_url ); ?>" aria-label="<?php echo esc_attr( $home_label ); ?>"><?php echo esc_html( $logo_line_1 ); ?></a>
	<?php
} else { // Organisational style display.
	?>
	<a class="nhsuk-header__service-logo" href="<?php echo esc_url( $home_url ); ?>" aria-label="<?php echo esc_attr( $home_label ); ?>">
		<?php $nightingale_organisation_name(); ?>
	</a>
	<?php
}
?>
</div>

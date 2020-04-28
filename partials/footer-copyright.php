<?php
/**
 * The copyright message for our theme
 * This is the template that displays the copyright in the footer
 *
 * @link      https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   1.0 13th January 2020
 */

$organisation_name = get_theme_mod( 'org_name_field', '' );

?>
<p class="nhsuk-footer__copyright">
	<?php echo esc_html__( '&copy; Copyright', 'nightingale' ); ?>,
	<?php
	if ( '' !== $organisation_name ) {
		echo esc_html( $organisation_name );
	} else {
		bloginfo( 'name' );
	}
	?>
	<?php echo esc_html( date_i18n( __( 'Y', 'nightingale' ) ) ); ?>
</p>

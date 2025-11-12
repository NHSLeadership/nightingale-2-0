<?php
/**
 * The copyright message for our theme
 * This is the template that displays the copyright in the footer
 *
 * @link      https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Mahesh Murali P and Tony Blacker
 * @version   1.1 12th November 2025
 */

$organisation_name          = get_theme_mod( 'org_name_field', '' );
$show_org_name_in_copyright = get_theme_mod( 'org_name_checkbox', 'no' );
$custom_copyright_text      = get_theme_mod( 'copyright_text', '' );
?>
<p class="nhsuk-footer__copyright">
	<?php
	if ( '' !== $custom_copyright_text ) {
		echo esc_html__( '&copy;', 'nightingale' ) . ' ';
		echo esc_html( $custom_copyright_text );
	} else {
		echo esc_html__( '&copy; Copyright', 'nightingale' ) . ', ';

		if ( '' !== $organisation_name && 'yes' === $show_org_name_in_copyright ) {
			echo esc_html( $organisation_name );
		} else {
			bloginfo( 'name' );
		}
		echo esc_html( date_i18n( __( 'Y', 'nightingale' ) ) );
	}
	?>
</p>

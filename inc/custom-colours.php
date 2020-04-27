<?php
/**
 * Set the theme colors
 *
 * @package   Nightingale-2-0
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   1.1 21st August 2019
 */

/**
 * Setup the colours for our theme.
 */
function nightingale_get_theme_colours() {
	return array(
		''       => esc_html__( 'Inherit site wide colour settings', 'nightingale' ),
		'005eb8' => esc_html__( 'NHS Blue', 'nightingale' ),
		'003087' => esc_html__( 'Dark Blue', 'nightingale' ),
		'0072ce' => esc_html__( 'Bright Blue', 'nightingale' ),
		'768692' => esc_html__( 'Mid Grey', 'nightingale' ),
		'425563' => esc_html__( 'Dark Grey', 'nightingale' ),
		'231f20' => esc_html__( 'Black', 'nightingale' ),
		'330072' => esc_html__( 'Purple', 'nightingale' ),
		'ae2573' => esc_html__( 'Pink', 'nightingale' ),
		'704c9c' => esc_html__( 'Light Purple', 'nightingale' ),
		'da291c' => esc_html__( 'Emergency Services Red', 'nightingale' ),
		'006747' => esc_html__( 'Dark Green', 'nightingale' ),
		'78be20' => esc_html__( 'Light Green', 'nightingale' ),
		'00a499' => esc_html__( 'Aqua Green', 'nightingale' ),
		'0b0c0c' => esc_html__( 'GDS Black', 'nightingale' ),
	);
}


// -- Disable Custom Colors
add_action( 'after_setup_theme', 'nightingale_prefix_register_colors' );
/**
 * Make an array of colours we want to show.
 */
function nightingale_prefix_register_colors() {

	add_theme_support( 'disable-custom-colors' );
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'NHS Blue', 'nightingale' ),
				'slug'  => 'nhs_blue',
				'color' => '#005eb8',
			),
			array(
				'name'  => esc_html__( 'NHS Dark Blue', 'nightingale' ),
				'slug'  => 'nhs_dark_blue',
				'color' => '#003087',
			),
			array(
				'name'  => esc_html__( 'NHS Bright Blue', 'nightingale' ),
				'slug'  => 'nhs_bright_blue',
				'color' => '#0072ce',
			),
			array(
				'name'  => esc_html__( 'NHS Light Blue', 'nightingale' ),
				'slug'  => 'nhs_light_blue',
				'color' => '#41b6e6',
			),
			array(
				'name'  => esc_html__( 'NHS Mid Grey', 'nightingale' ),
				'slug'  => 'nhs_mid_grey',
				'color' => '#768692',
			),
			array(
				'name'  => esc_html__( 'NHS Light Grey', 'nightingale' ),
				'slug'  => 'nhs_light_grey',
				'color' => '#e8edee',
			),
			array(
				'name'  => esc_html__( 'NHS Purple', 'nightingale' ),
				'slug'  => 'nhs_purple',
				'color' => '#330072',
			),
			array(
				'name'  => esc_html__( 'NHS Pink', 'nightingale' ),
				'slug'  => 'nhs_pink',
				'color' => '#ae2573',
			),
			array(
				'name'  => esc_html__( 'NHS Light Purple', 'nightingale' ),
				'slug'  => 'nhs_light_purple',
				'color' => '#704c9c',
			),
			array(
				'name'  => esc_html__( 'NHS Light Green', 'nightingale' ),
				'slug'  => 'nhs_light_green',
				'color' => '#78be20',
			),
			array(
				'name'  => esc_html__( 'NHS Dark Green', 'nightingale' ),
				'slug'  => 'nhs_dark_green',
				'color' => '#006747',
			),
			array(
				'name'  => esc_html__( 'NHS Aqua Green', 'nightingale' ),
				'slug'  => 'nhs_aqua_green',
				'color' => '#00a499',
			),
			array(
				'name'  => esc_html__( 'NHS Black', 'nightingale' ),
				'slug'  => 'nhs_black',
				'color' => '#231f20',
			),
			array(
				'name'  => esc_html__( 'Emergency Services Red', 'nightingale' ),
				'slug'  => 'emergency_red',
				'color' => '#da291c',
			),
			array(
				'name'  => esc_html__( 'NHS Yellow', 'nightingale' ),
				'slug'  => 'nhs_yellow',
				'color' => '#fae100',
			),
			array(
				'name'  => esc_html__( 'NHS Warm Yellow', 'nightingale' ),
				'slug'  => 'nhs_warm_yellow',
				'color' => '#ffb81c',
			),
			array(
				'name'  => esc_html__( 'NHS Dark Grey', 'nightingale' ),
				'slug'  => 'nhs_grey_dark',
				'color' => '#425563',
			),
			array(
				'name'  => esc_html__( 'White', 'nightingale' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
		)
	);
}

/**
 * Get the colors formatted for use with Iris, Automattic's color picker.
 */
function nightingale_output_the_colors() {

	// get the colors.
	$color_palette = current( (array) get_theme_support( 'editor-color-palette' ) );

	// bail if there aren't any colors found.
	if ( ! $color_palette ) {
		return;
	}

	// output begins.
	ob_start();

	// output the names in a string.
	echo '[';
	foreach ( $color_palette as $color ) {
		echo "'" . esc_attr( $color['color'] ) . "', ";
	}
	echo ']';

	return ob_get_clean();

}

/**
 * Get the colors formatted for use with TinyMCE.
 */
function nightingale_output_tinymce_colors() {

	// get the colors.
	$color_palette = current( (array) get_theme_support( 'editor-color-palette' ) );

	// bail if there aren't any colors found.
	if ( ! $color_palette ) {
		return;
	}

	// output begins.
	ob_start();

	// output the names in a string.
	echo '
';
	foreach ( $color_palette as $color ) {
		$str = ltrim( $color['color'], '#' );
		echo "'" . esc_attr( $str ) . "', '" . esc_attr( $color['slug'] ) . "',
		";
	}
	echo '
';

	return ob_get_clean();

}

/**
 * Put the array of colours into the TinyMCE editor.
 *
 * @param array $init the array of colours coming in.
 *
 * @return array $init the formatted array returned back.
 */
function nightingale_mce4_options( $init ) {

	$custom_colours = nightingale_output_tinymce_colors();

	// build colour grid default+custom colors.
	$init['textcolor_map'] = '[' . $custom_colours . ']';

	// change the number of rows in the grid if the number of colors changes.
	// 8 swatches per row.
	$init['textcolor_rows'] = 3;

	return $init;
}

add_filter( 'tiny_mce_before_init', 'nightingale_mce4_options' );

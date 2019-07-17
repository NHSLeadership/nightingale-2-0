<?php
/**
 * Set the theme colors
 */
// -- Disable Custom Colors
add_action( 'after_setup_theme', 'prefix_register_colors' );
function prefix_register_colors() {

    add_theme_support( 'disable-custom-colors' );
    add_theme_support(
        'editor-color-palette', array(
            array(
                'name'  => esc_html__( 'NHS Blue', 'prefix_textdomain' ),
                'slug' => 'nhs_blue',
                'color' => '#005eb8',
            ),
            array(
                'name'  => esc_html__( 'NHS Dark Blue', 'prefix_textdomain' ),
                'slug' => 'nhs_dark_blue',
                'color' => '#003087',
            ),
            array(
                'name'  => esc_html__( 'NHS Bright Blue', 'prefix_textdomain' ),
                'slug' => 'nhs_bright_blue',
                'color' => '#0072ce',
            ),
            array(
                'name'  => esc_html__( 'NHS Light Blue', 'prefix_textdomain' ),
                'slug' => 'nhs_light_blue',
                'color' => '#41b6e6',
            ),
            array(
                'name'  => esc_html__( 'NHS Mid Grey', 'prefix_textdomain' ),
                'slug' => 'nhs_mid_grey',
                'color' => '#768692',
            ),
            array(
                'name'  => esc_html__( 'NHS Light Grey', 'prefix_textdomain' ),
                'slug' => 'nhs_light_grey',
                'color' => '#e8edee',
            ),
            array(
                'name'  => esc_html__( 'NHS Purple', 'prefix_textdomain' ),
                'slug' => 'nhs_purple',
                'color' => '#330072',
            ),
            array(
                'name'  => esc_html__( 'NHS Pink', 'prefix_textdomain' ),
                'slug' => 'nhs_pink',
                'color' => '#ae2573',
            ),
            array(
                'name'  => esc_html__( 'NHS Light Purple', 'prefix_textdomain' ),
                'slug' => 'nhs_light_purple',
                'color' => '#704c9c',
            ),
            array(
                'name'  => esc_html__( 'NHS Light Green', 'prefix_textdomain' ),
                'slug' => 'nhs_light_green',
                'color' => '#78be20',
            ),
            array(
                'name'  => esc_html__( 'NHS Dark Green', 'prefix_textdomain' ),
                'slug' => 'nhs_dark_green',
                'color' => '#006747',
            ),
            array(
                'name'  => esc_html__( 'NHS Aqua Green', 'prefix_textdomain' ),
                'slug' => 'nhs_aqua_green',
                'color' => '#00a499',
            ),
            array(
                'name'  => esc_html__( 'NHS Black', 'prefix_textdomain' ),
                'slug' => 'nhs_black',
                'color' => '#231f20',
            ),
            array(
                'name'  => esc_html__( 'Emergency Services Red', 'prefix_textdomain' ),
                'slug' => 'emergency_red',
                'color' => '#da291c',
            ),
            array(
                'name'  => esc_html__( 'NHS Yellow', 'prefix_textdomain' ),
                'slug' => 'nhs_yellow',
                'color' => '#fae100',
            ),
            array(
                'name'  => esc_html__( 'NHS Warm Yellow', 'prefix_textdomain' ),
                'slug' => 'nhs_warm_yellow',
                'color' => '#ffb81c',
            ),
            array(
                'name'  => esc_html__( 'NHS Dark Grey', 'prefix_textdomain' ),
                'slug' => 'nhs_grey_dark',
                'color' => '#425563',
            ),
            array(
                'name'  => esc_html__( 'White', 'prefix_textdomain' ),
                'slug' => 'white',
                'color' => '#ffffff',
            ),
        )
    );
}

/**
 * Get the colors formatted for use with Iris, Automattic's color picker
 */
function output_the_colors() {

    // get the colors
    $color_palette = current( (array) get_theme_support( 'editor-color-palette' ) );

    // bail if there aren't any colors found
    if ( !$color_palette )
        return;

    // output begins
    ob_start();

    // output the names in a string
    echo '[';
    foreach ( $color_palette as $color ) {
        echo "'" . $color['color'] . "', ";
    }
    echo ']';

    return ob_get_clean();

}

/**
 * Get the colors formatted for use with TinyMCE
 */
function output_tinymce_colors() {

    // get the colors
    $color_palette = current( (array) get_theme_support( 'editor-color-palette' ) );

    // bail if there aren't any colors found
    if ( !$color_palette )
        return;

    // output begins
    ob_start();

    // output the names in a string
echo '
';
    foreach ( $color_palette as $color ) {
        $str = ltrim($color['color'], '#');
        echo "'" . $str . "', '". $color['slug'] . "',
        ";
    }
echo '
';

    return ob_get_clean();

}

/**
 * Add the colors into Iris
 */
add_action( 'acf/input/admin_footer', 'gutenberg_sections_register_acf_color_palette' );
function gutenberg_sections_register_acf_color_palette() {

    $color_palette = output_the_colors();
    if ( !$color_palette )
        return;

    ?>
    <script>
        (function( $ ) {
            acf.add_filter( 'color_picker_args', function( args, $field ){
                // add the hexadecimal codes here for the colors you want to appear as swatches
                args.palettes = <?php echo $color_palette; ?>
                // return colors
                    console.log(args);
                return args;
            });
        })(jQuery);
    </script>
    <?php
}


function gutenberg_sections_acf_collor_pallete_css() {
    ?>
    <style>
        .acf-color_picker .iris-picker.iris-border{
            width: 200px !important;
            height: 10px !important;
        }
        .acf-color_picker .wp-picker-input-wrap,
        .acf-color_picker .iris-picker .iris-slider,
        .acf-color_picker .iris-picker .iris-square{
            display:none !important;
        }
    </style>
    <?php
}

add_action('acf/input/admin_head', 'gutenberg_sections_acf_collor_pallete_css');

function nightingale_2_0_mce4_options($init) {

    $custom_colours = output_tinymce_colors();

    // build colour grid default+custom colors
    $init['textcolor_map'] = '['.$custom_colours.']';

    // change the number of rows in the grid if the number of colors changes
    // 8 swatches per row
    $init['textcolor_rows'] = 3;

    return $init;
}
add_filter('tiny_mce_before_init', 'nightingale_2_0_mce4_options');

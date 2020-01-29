<?php
/**
 * Nightingale Theme Customizer
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nightingale_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'nightingale_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'nightingale_customize_partial_blogdescription',
			)
		);
	}


	/*
	 * ------------------------------------------------------------
	 * SECTION: Header
	 * ------------------------------------------------------------
	 */
	$wp_customize->add_section(
		'section_header',
		array(
			'title'       => esc_html__( 'Header', 'nightingale' ),
			'description' => esc_attr__( 'Customise your header display', 'nightingale' ),
			'priority'    => 10,
		)
	);


	/*
	 * -----------------------------------------------------------
	 * SHOW / HIDE Search
	 * -----------------------------------------------------------
	 */
	$wp_customize->add_setting(
		'show_search',
		array(
			'default'           => 'yes',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'show_search',
		array(
			'label'       => esc_html__( 'Show Search Box?', 'nightingale' ),
			'description' => esc_html__( 'Would you like to show a search box in the top right of your site?', 'nightingale' ),
			'section'     => 'section_header',
			'type'        => 'radio',
			'choices'     => array(
				'yes' => esc_html__( 'Yes', 'nightingale' ),
				'no'  => esc_html__( 'No', 'nightingale' ),
			),
		)
	);

	/*
	 * Header Styles
	 */
	$wp_customize->add_setting(
		'header_styles',
		array(
			'default'           => 'normal',
			'sanitize_callback' => 'esc_attr',
		)
	);

	$wp_customize->add_control(
		'header_styles',
		array(
			'label'       => esc_html__( 'Header Colour', 'nightingale' ),
			'description' => esc_html__( 'What background would you like for your header region?', 'nightingale' ),
			'section'     => 'section_header',
			'type'        => 'radio',
			'choices'     => array(
				'normal'   => esc_html__( 'Solid Blue', 'nightingale' ),
				'inverted' => esc_html__( 'White Logo Bar', 'nightingale' ),
			),
		)
	);

	/*
	 * Show NHS Logo?
	 */
	$wp_customize->add_setting(
		'nhs_logo',
		array(
			'default'           => 'yes',
			'sanitize_callback' => 'esc_attr',
		)
	);

	$wp_customize->add_control(
		'nhs_logo',
		array(
			'label'       => esc_html__( 'Do you wish to use the NHS logo?', 'nightingale' ),
			'description' => esc_html__( 'this setting is ignored if you have uploaded a custom logo above. Please note the NHS logo is a trademark and should only be used by organisations that have permission to use it as part of their branding.', 'nightingale' ),
			'section'     => 'title_tagline',
			'type'        => 'radio',
			'choices'     => array(
				'yes' => esc_html__( 'Yes', 'nightingale' ),
				'no'  => esc_html__( 'No', 'nightingale' ),
			),
		)
	);

	/*
	 * -----------------------------------------------------------
	 * LOGO Generation
	 * -----------------------------------------------------------
	 */
	$wp_customize->add_setting(
		'logo_type',
		array(
			'default'           => 'transactional',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'logo_type',
		array(
			'label'       => esc_html__( 'Logo Builder', 'nightingale' ),
			'description' => esc_html__( 'You can create your own site logo. It is strongly recommened to use the NHS logo if you are able to. This only takes effect if you have not uploaded a site logo. Both options are accepted NHS design patterns.', 'nightingale' ),
			'section'     => 'title_tagline',
			'type'        => 'radio',
			'choices'     => array(
				'transactional' => esc_html__( 'Inline (shows just site name to the right of logo)', 'nightingale' ),
				'organisation'  => esc_html__( 'Block (shows both site name and tagline beneath logo)', 'nightingale' ),
			),
		)
	);

	/*
	 * -----------------------------------------------------------
	 * Colour chooser
	 * -----------------------------------------------------------
	 */
	$wp_customize->add_setting(
		'theme_colour',
		array(
			'default'           => 'nhs_blue',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'theme_colour',
		array(
			'label'       => esc_html__( 'Theme Colour', 'nightingale' ),
			'description' => esc_html__( 'If you wish to change the default colour of the theme, this is where you do it. Please note, this will disable the inline critical-css and may have a slight performance impact on your visible loadtimes. It may also affect the accessability of your site.', 'nightingale' ),
			'section'     => 'title_tagline',
			'type'        => 'select',
			'choices'     => array(
				'nhs_blue' => esc_html__( 'Standard NHS Blue (Default)', 'nightingale' ),
				'003087'   => esc_html__( 'Dark Blue', 'nightingale' ),
				'0072ce'   => esc_html__( 'Bright Blue', 'nightingale' ),
				'768692'   => esc_html__( 'Mid Grey', 'nightingale' ),
				'425563'   => esc_html__( 'Dark Grey', 'nightingale' ),
				'231f20'   => esc_html__( 'Black', 'nightingale' ),
				'330072'   => esc_html__( 'Purple', 'nightingale' ),
				'ae2573'   => esc_html__( 'Pink', 'nightingale' ),
				'704c9c'   => esc_html__( 'Light Purple', 'nightingale' ),
				'da291c'   => esc_html__( 'Emergency Services Red', 'nightingale' ),
				'006747'   => esc_html__( 'Dark Green', 'nightingale' ),
				'78be20'   => esc_html__( 'Light Green', 'nightingale' ),
				'00a499'   => esc_html__( 'Aqua Green', 'nightingale' ),
			),
		)
	);

}

add_action( 'customize_register', 'nightingale_customize_register' );

function nightingale_add_blog_settings( $wp_customize ) {

	$wp_customize->add_section( 'blog_panel',
		array(
			'title'				=> esc_html__( 'Blog Settings', 'nightingale' ),
			'description'		=> esc_html__( 'Extra settings for the Blog page', 'nightingale' ),
			'capability'		=> 'edit_theme_options',
			'theme-supports'	=> '',
			'priority'			=> '150',
		)
	);


	$wp_customize->add_setting(
		// $id
		'blog_sidebar',
		// $args
		array(
			'default'			=> 'true',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'esc_attr'
		)
	);

	$wp_customize->add_control(
		// $id
		'blog_sidebar',
		// $args
		array(
			'settings'		=> 'blog_sidebar',
			'section'		=> 'blog_panel',
			'type'			=> 'radio',
			'label'			=>  esc_html__( 'Display Sidebar', 'nightingale' ),
			'description'	=>  esc_html__( 'Choose whether or not to display the sidebar on the blog page', 'nightingale' ),
			'choices'		=> array(
				'true' => esc_html__( 'Sidebar', 'nightingale' ),
				'false' => esc_html__( 'No Sidebar', 'nightingale' )
			)
		)
	);

	$wp_customize->add_setting(
		// $id
		'blog_fallback',
		// $args
		array(
			'default'			=> '',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'nightingale_sanitize_image'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Media_Control( 			
			$wp_customize,
			'blog_fallback',
			array(
				'settings'		=> 'blog_fallback',
				'mime_type'     => 'image',
				'section'		=> 'blog_panel',
				'label'			=> esc_html__( 'Blog Fallback Image', 'nightingale' ),
				'description'	=> esc_html__( 'Select a fallback image if the blog post does not have a featured image. Leave blank if no fallback wanted', 'nightingale' )
			)
		)
	);
}

add_action( 'customize_register', 'nightingale_add_blog_settings' );

/**
 * Image sanitization callback 
 *
 * Checks the image's file extension and mime type against a whitelist. If they're allowed,
 * send back the filename, otherwise, return the setting default.
 *
 * @param string               $image   Image ID.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int of the image ID.
 */



function nightingale_sanitize_image( $image, $setting ) {

	$image = intval( $image );

	// Check if is a number
    $file = is_numeric( $image );

	// If $file is a number, return the number.
    return ( $file ? $image : $setting->default );
}

/**
 * Clean the date output up.
 *
 * @param datetime $input raw date.
 *
 * @return string.
 */
function nightingale_sanitize_date( $input ) {
	$date = new DateTime( $input );

	return $date->format( 'd-m-Y' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function nightingale_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function nightingale_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nightingale_customize_preview_js() {
	wp_enqueue_script( 'nightingale-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'nightingale_customize_preview_js' );

/**
 * Check to see which kind of header should be rendered.
 */
function nightingale_header_customiser_dependency_check() {
	?>
    <script>
        ;(function () {
            /**
             * Run function only when customizer changes
             */
            wp.customize.bind('ready', function () {
                wp.customize.control('logo_type', function (control) {
                    control.setting.bind(function (value) {
                        switch (value) {
                            /**
                             * Transactional types
                             */
                            case 'transactional':
                                wp.customize.control('loqo_qualifier').deactivate();
                                break;
                            /**
                             *  Organisational types
                             */
                            case 'organisation':
                                wp.customize.control('loqo_qualifier').activate();
                                break;

                        }
                    })
                })
            })
        })();
    </script>
	<?php
}

add_action( 'customize_controls_enqueue_scripts', 'nightingale_header_customiser_dependency_check', 10, 1 );

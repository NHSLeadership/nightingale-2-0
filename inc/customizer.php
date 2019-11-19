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
			'description' => esc_attr__( 'Choose a Header Style', 'nightingale' ),
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
			'label'   => esc_html__( 'Show Search Box?', 'nightingale' ),
			'section' => 'section_header',
			'type'    => 'radio',
			'choices' => array(
				'yes' => esc_html__( 'Yes', 'nightingale' ),
				'no'  => esc_html__( 'No', 'nightingale' ),
			),
		)
	);

	/*
	 * -----------------------------------------------------------
	 * SHOW / HIDE Site Name
	 * -----------------------------------------------------------
	 */
	$wp_customize->add_setting(
		'show_sitename',
		array(
			'default'           => 'yes',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'show_sitename',
		array(
			'label'       => esc_html__( 'Show site Name as text?', 'nightingale' ),
			'description' => esc_html__( 'you may wish to hide this if your organisational logo includes your organisation name. Your site name is edited / created in the "Site Identity" section of the theme customiser', 'nightingale' ),
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
			'default'           => 'transaction',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'logo_type',
		array(
			'label'       => esc_html__( 'Site identifier', 'nightingale' ),
			'description' => esc_html__( 'You can create your own site identity. This only takes effect if you have not uploaded a site logo. The options are transactional (NHS logo, your org name to the right) or organisational (NHS logo, your org name underneath and a department or qualifier under that). Both are accepted NHS design patterns.', 'nightingale' ),
			'section'     => 'section_header',
			'type'        => 'radio',
			'choices'     => array(
				'transactional' => esc_html__( 'Transactional', 'nightingale' ),
				'organisation'  => esc_html__( 'Organisational', 'nightingale' ),
			),
		)
	);

	$wp_customize->add_setting(
		'logo_title',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'logo_title',
		array(
			'label'   => esc_html__( 'Title to show in generated logo', 'nightingale' ),
			'section' => 'section_header',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'logo_qualifier',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'logo_qualifier',
		array(
			'label'       => esc_html__( 'Qualifier to show in generated logo', 'nightingale' ),
			'description' => esc_html__( 'this will only show in transactional logos and is either your department or local qualifier', 'nightingale' ),
			'section'     => 'section_header',
			'type'        => 'text',
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
			'label'   => esc_html__( 'Header Styles', 'nightingale' ),
			'section' => 'section_header',
			'type'    => 'radio',
			'choices' => array(
				'normal'   => esc_html__( 'Standard (Solid Blue)', 'nightingale' ),
				'inverted' => esc_html__( 'Non Standard (White Logo Bar)', 'nightingale' ),
			),
		)
	);

	/*
	 * ------------------------------------------------------------
	 * SECTION: Emergency Alert Field
	 * ------------------------------------------------------------
	 */
	$wp_customize->add_section(
		'section_emergency',
		array(
			'title'       => esc_html__( 'Emergency Alert', 'nightingale' ),
			'description' => esc_attr__( 'Adds a site wide alert to the top of your site. Use sparingly!', 'nightingale' ),
			'priority'    => 75,
		)
	);

	/*
	 * Emergency Options
	 */
	$wp_customize->add_setting(
		'emergency_on',
		array(
			'default'           => 'no',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'emergency_on',
		array(
			'label'   => esc_html__( 'Show an emergency alert?', 'nightingale' ),
			'section' => 'section_emergency',
			'type'    => 'radio',
			'choices' => array(
				'no'  => esc_html__( 'No', 'nightingale' ),
				'yes' => esc_html__( 'Yes', 'nightingale' ),
			),
		)
	);
	$wp_customize->add_setting(
		'emergency_heading',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'emergency_heading',
		array(
			'label'   => esc_html__( 'Emergency Alert Title', 'nightingale' ),
			'section' => 'section_emergency',
			'type'    => 'text',
		)
	);
	$wp_customize->add_setting(
		'emergency_content',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'emergency_content',
		array(
			'label'   => esc_html__( 'Emergency Alert Content', 'nightingale' ),
			'section' => 'section_emergency',
			'type'    => 'textarea',
		)
	);
	$wp_customize->add_setting(
		'emergency_link',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'emergency_link',
		array(
			'label'   => esc_html__( 'Emergency Alert Link (url) to Further Info', 'nightingale' ),
			'section' => 'section_emergency',
			'type'    => 'url',
		)
	);
	$wp_customize->add_setting(
		'emergency_link_title',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'emergency_link_title',
		array(
			'label'   => esc_html__( 'Emergency Alert Text to Link', 'nightingale' ),
			'section' => 'section_emergency',
			'type'    => 'text',
		)
	);
	$wp_customize->add_setting(
		'emergency_date',
		array(
			'default'           => false,
			'sanitize_callback' => 'nightingale_sanitize_date',
		)
	);
	$wp_customize->add_control(
		'emergency_date',
		array(
			'label'       => esc_html__( 'Date Last Updated', 'nightingale' ),
			'section'     => 'section_emergency',
			'type'        => 'date',
			'input_attrs' => array(
				'placeholder' => __( 'mm/dd/yyyy', 'nightingale' ),
			),
		)
	);

	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'header_image' );

	/*
	 * ------------------------------------------------------------
	 * SECTION: Feedback Banner Fields
	 * ------------------------------------------------------------
	 */
	$wp_customize->add_section(
		'section_feedback',
		array(
			'title'       => esc_html__( 'Feedback Alert', 'nightingale' ),
			'description' => esc_attr__( 'Adds a site wide feedback alert. Use sparingly!', 'nightingale' ),
			'priority'    => 80,
		)
	);

	/*
	 * Feedback Options
	 */
	$wp_customize->add_setting(
		'feedback_on',
		array(
			'default'           => 'no',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'feedback_on',
		array(
			'label'   => esc_html__( 'Show a feedback banner?', 'nightingale' ),
			'section' => 'section_feedback',
			'type'    => 'radio',
			'choices' => array(
				'no'  => esc_html__( 'No', 'nightingale' ),
				'yes' => esc_html__( 'Yes', 'nightingale' ),
			),
		)
	);
	$wp_customize->add_setting(
		'feedback_banner_heading',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'feedback_banner_heading',
		array(
			'label'   => esc_html__( 'Feedback Title', 'nightingale' ),
			'section' => 'section_feedback',
			'type'    => 'text',
		)
	);
	$wp_customize->add_setting(
		'feedback_banner_content',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'feedback_banner_content',
		array(
			'label'   => esc_html__( 'Feedback Message', 'nightingale' ),
			'section' => 'section_feedback',
			'type'    => 'textarea',
		)
	);
	$wp_customize->add_setting(
		'feedback_banner_link',
		array(
			'default'           => 'https://',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'feedback_banner_link',
		array(
			'label'   => esc_html__( 'Feedback Link (url) to Feedback form', 'nightingale' ),
			'section' => 'section_feedback',
			'type'    => 'url',
		)
	);
	$wp_customize->add_setting(
		'feedback_banner_link_title',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'feedback_banner_link_title',
		array(
			'label'   => esc_html__( 'Feedback Text to Link', 'nightingale' ),
			'section' => 'section_feedback',
			'type'    => 'text',
		)
	);

	/*
	 * ------------------------------------------------------------
	 * SECTION: GA Tracking
	 * ------------------------------------------------------------
	 */
	$wp_customize->add_section(
		'section_google',
		array(
			'title'       => esc_html__( 'Google Tracking', 'nightingale' ),
			'description' => esc_attr__( 'Do you wish to add Google Analytics Tracking?', 'nightingale' ),
			'priority'    => 70,
		)
	);

	$wp_customize->add_setting(
		'google-utm',
		array(
			'default'           => 'GA-',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		'google-utm',
		array(
			'label'       => esc_html__( 'Google Analytics Tracking ID', 'nightingale' ),
			'description' => esc_html__( 'Enter your Google tracking ID (everything after UA-)', 'nightingale' ),
			'section'     => 'section_google',
			'type'        => 'text',
		)
	);

}

add_action( 'customize_register', 'nightingale_customize_register' );

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

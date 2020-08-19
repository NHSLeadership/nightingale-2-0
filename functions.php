<?php
/**
 * Nightingale  functions and definitions
 *
 * @link      https://developer.wordpress.org/themes/basics/theme-functions/
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   2.2.0 28th July 2020
 */

/**
 * Auto deploy subpages widget.
 * Moved to top of file to allow template to initialise widget in sidebar
 */
require get_template_directory() . '/inc/class-nightingale-subpages-widget.php';


/**
 * Add in customizer sanitizer functions
 */
require get_template_directory() . '/inc/sanitization-callbacks.php';


/**
 * Sets up theme defaults and registers support for various WordPress features.
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nightingale_setup() {
	load_theme_textdomain( 'nightingale' );
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menus() in two location.
	$locations = array(
		'main-menu'   => __( 'The menu to show at the top of your site (does not show child options, only top level navigation)', 'nightingale' ),
		'footer-menu' => __( 'The footer navigation area - this is great for showing more detailed links and deeper navigation.', 'nightingale' ),
	);
	register_nav_menus( $locations );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'nightingale_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support(
		'customize-selective-refresh-widgets'
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );
	// Load default block styles.
	add_theme_support( 'wp-block-styles' );
	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );
	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets'    => array(
			// Place pre-defined widget in the sidebar area.
			'sidebar-1' => array(
				'search',
				'subpages-widget',
			),
			'404-error' => array(
				'archives',
				'tag_cloud',
				'recent_posts',
			),
		),
		'posts'      => array(
			'home',
			'blog',
		),
		// Default to a static front page and assign the front and posts pages.
		'options'    => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{blog}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus'  => array(
			// Assign a menu to the "main-menu" location.
			'main-menu'   => array(
				'name'  => __( 'Main Menu', 'nightingale' ),
				'items' => array(
					'link_home',
					// Note that the core "home" page is actually a link in case a static front page is not used.
					'page_blog',
				),
			),
			// Assign a menu to the "footer-menu" location.
			'footer-menu' => array(
				'name'  => __( 'Footer Links', 'nightingale' ),
				'items' => array(
					'link_home',
					'page-blog',
				),
			),
		),
	);
	add_theme_support( 'starter-content', $starter_content );

	remove_theme_support( 'custom-header' );
	remove_theme_support( 'custom-background' );

}

add_action( 'after_setup_theme', 'nightingale_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nightingale_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'nightingale_content_width', 640 );
}

add_action( 'after_setup_theme', 'nightingale_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nightingale_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'nightingale' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Elements to show in the sidebar. Each widget will show as a panel. If empty you will have a blank right hand panel.', 'nightingale' ),
			'before_widget' => '<section id="%1$s" class="nhsuk-related-nav %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="nhsuk-related-nav__heading">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Post Sidebar', 'nightingale' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Elements to show in the post sidebar. Each widget will show as a panel. If empty you will have a blank right hand panel.', 'nightingale' ),
			'before_widget' => '<section id="%1$s" class="nhsuk-related-nav %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="nhsuk-related-nav__heading">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Region', 'nightingale' ),
			'id'            => 'footer-region',
			'description'   => esc_html__( 'Widgets to show in the footer zone. By default the footer will have a copyright notice and the footer menu (if configured) only.', 'nightingale' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
		)
	);
	register_sidebar(
		array(
			'name'          => '404 Page',
			'id'            => '404-error',
			'description'   => esc_html__( 'Content for your 404 error page goes here.', 'nightingale' ),
			'before_widget' => '<div id="%1$s" class="%2$s nhsuk-related-nav">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="nhsuk-related-nav__heading">',
			'after_title'   => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'nightingale_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function nightingale_scripts() {
	wp_enqueue_style( 'nightingale-style', get_template_directory_uri() . '/style.min.css', array(), '20202704' );
	wp_enqueue_style( 'nightingale-page-colours', get_template_directory_uri() . '/page-colours.min.css', array(), '20202704' );
	wp_enqueue_script( 'nightingale-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', '', '20190828', true );
	wp_enqueue_script( 'nightingale-nhs-library', get_template_directory_uri() . '/js/nhsuk.min.js', '', '20190828', true );
	wp_enqueue_script( 'nightingale-navigation', get_template_directory_uri() . '/js/navigation.js', '', '20190828', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'nightingale_scripts' );

/**
 * Encourage download of dependancy plugins
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'nightingale_register_required_plugins' );
/**
 *  Set which plugins we need to setup with the theme
 */
function nightingale_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// Load in NHSBlocks plugin directly from WP repo.
		array(
			'name'         => 'NHS Blocks',
			'slug'         => 'nhsblocks',
			'source'       => '',
			'required'     => false,
			'version'      => '1.1.6',
			'external_url' => '',
			'is_callable'  => '',
		),
		array(
			'name'         => 'Nightingale Companion',
			'slug'         => 'nightingale-companion',
			'source'       => '',
			'required'     => false,
			'version'      => '1.0.2',
			'external_url' => '',
			'is_callable'  => '',
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 */
	$config = array(
		'id'           => 'nightingale',
		// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',
		// Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins',
		// Menu slug.
		'has_notices'  => true,
		// Show admin notices or not.
		'dismissable'  => true,
		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',

		//
		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,
		// Automatically activate plugins after installation or not.
		'message'      => '',
		// Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
/**
 * Add in a limitation to only NHS colour blocks.
 */
require get_template_directory() . '/inc/custom-colours.php';
/**
 * Add in custom Gutenberg modifications.
 */
require get_template_directory() . '/inc/custom-gutenberg.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Pagination
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Breadcrumb element.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Color Picker.
 */
require get_template_directory() . '/inc/color-picker.php';

/**
 * Color Picker.
 */
require get_template_directory() . '/inc/last-reviewed.php';

/**
 * Create an array of active plugins.
 */

$active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );


/**
 * Gravity Forms style over-ride.
 * N.B. This is not a plugin, nor does it provide any plugin-like changes. This is a theme file for
 * the Gravity Forms plugin so any content generated by Gravity Forms fits in to this theme.
 * The check around the require is to see if the plugin is active on this install
 */
if ( in_array( 'gravityforms/gravityforms.php', $active_plugins, true ) ) {
	if ( ! is_admin() ) {
		require get_template_directory() . '/inc/gravity-forms.php';
	}
}


/**
 * Formidable Forms style over-ride.
 * N.B. This is not a plugin, nor does it provide any plugin-like changes. This is a theme file for
 * the Formidable Forms plugin so any content generated by Formidable Forms fits in to this theme.
 * The check around the require is to see if the plugin is active on this install
 * N.B - You must set formidaable forms to 'Do not use formidable styles' for it to kick in
 */
if ( in_array( 'formidable/formidable.php', $active_plugins, true ) ) {
	if ( ! is_admin() ) {
		require get_template_directory() . '/inc/formidable.php';
	}
}

/**
 * LearnDash style over-ride.
 * N.B. This is not a plugin, nor does it provide any plugin-like changes. This is a theme file for
 * the LearnDash plugin so any content generated by LearnDash fits in to this theme.
 * The check around the require is to see if the plugin is active on this install
 */
if ( in_array( 'sfwd-lms/sfwd-lms.php', $active_plugins, true ) ) {
	if ( ! is_admin() ) {
		require get_template_directory() . '/inc/learndash.php';
	}
}

/**
 * Events Calendar style over-ride.
 * N.B. This is not a plugin, nor does it provide any plugin-like changes. This is a theme file for
 * the Events Calendar plugin so any content generated by Events Calendar fits in to this theme.
 * The check around the require is to see if the plugin is active on this install
 */
if ( in_array( 'the-events-calendar/the-events-calendar.php', $active_plugins, true ) ) {
	if ( ! is_admin() ) {
		require get_template_directory() . '/inc/events-calendar.php';
	}
}

/*
 * Google Tag Manager.
 * N.B. This is not a plugin, nor does it provide any plugin-like changes. This is a file for
 * the Google Tag Manager to fit it into the theme.
 */

if ( function_exists( 'gtm4wp_the_gtm_tag' ) ) {
	if ( ! is_admin() ) {
		require get_template_directory() . '/inc/google-tag-manager.php';
	}
}

/**
 * Shove the critical path css directly into the header.
 */
require get_template_directory() . '/inc/critical-style.php';

/**
 * Add a pill next to comment author name showing their user role.
 */
require get_template_directory() . '/inc/class-comment-author-role-label.php';

/**
 * Hijack core/posts block and force own output
 */
if ( ! is_admin() ) {
	require get_template_directory() . '/inc/dynamic-blocks.php';
}

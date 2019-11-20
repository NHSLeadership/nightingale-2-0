<?php
/**
 * Nightingale 2.0 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 2.0.5 19th November 2019
 */

/**
 * Auto deploy subpages widget.
 * Moved to top of file to allow template to initialise widget in sidebar
 */
require get_template_directory() . '/inc/class-nightingale-subpages-widget.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nightingale_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Nightingale 2.0, use a find and replace
	 * to change 'nightingale' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'nightingale', get_template_directory() . '/languages' );

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
				'Nightingale_Subpages_Widget',
			),
			'404-error' => array(
				'WP_Widget_Archives',
				'WP_Widget_Tag_Cloud',
				'WP_Widget_Recent_Posts',
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
	unregister_widget( 'WP_Widget_Search' ); // taking out search widget as included in header by default.

}

add_action( 'after_setup_theme', 'nightingale_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
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
			'description'   => esc_html__( 'Elements to show in the sidebar. each widget will show as a panel.', 'nightingale' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Region', 'nightingale' ),
			'id'            => 'footer-region',
			'description'   => esc_html__( 'Widgets to show in the footer zone.', 'nightingale' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
		)
	);
	register_sidebar(
		array(
			'name'          => '404 Page',
			'id'            => '404-error',
			'description'   => esc_html__( 'Content for your 404 error page goes here.', 'nightingale' ),
			'before_widget' => '<div id="%1$s" class="%2$s nhsuk-panel-with-label">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="nhsuk-panel-with-label__label">',
			'after_title'   => '</h3>',
		)
	);
}

add_action( 'widgets_init', 'nightingale_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nightingale_scripts() {
	wp_enqueue_style( 'nightingale-style', get_template_directory_uri() . '/style.min.css', array(), '20191012' );

	wp_enqueue_script( 'nightingale-navigation', get_template_directory_uri() . '/js/navigation.js', '', '20190828', true );

	wp_enqueue_script( 'nightingale-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', '', '20190828', true );

	wp_enqueue_script( 'nightingale-nhs-library', get_template_directory_uri() . '/js/nhsuk.min.js', '', '20190828', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'nightingale_scripts' );

/**
 * Force download of dependancy plugins
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
		// Load in Gutenberg plugin directly from WP repo.
		array(
			'name'               => 'Gutenberg',
			// The plugin name.
			'slug'               => 'gutenberg',
			// The plugin slug (typically the folder name).
			'source'             => '',
			// The plugin source.
			'required'           => false,
			// If false, the plugin is only 'recommended' instead of required.
			'version'            => '6.3.0',
			// E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => true,
			// If true, plugin is activated upon theme activation and cannot be
			// deactivated until theme switch.
			'force_deactivation' => false,
			// If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '',
			// If set, overrides default API URL and points to an external URL.
			'is_callable'        => '',
			// If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		// Load in NHSBlocks plugin directly from WP repo.
		array(
			'name'               => 'NHS Blocks',
			'slug'               => 'nhsblocks',
			'source'             => '',
			'required'           => false,
			'version'            => '1.0.1',
			'force_activation'   => true,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),
		// Optional activate Cookie Notice plugin.
		array(
			'name'               => 'Cookie Notice for GDPR',
			'slug'               => 'cookie-notice',
			'source'             => '',
			'required'           => false,
			'version'            => '1.2.46',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
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
		'dismissable'  => false,
		// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => 'We recommend you install these plugin to add the full NHS Frontend library range of components to your wordpress editor. ',

		//
		// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,
		// Automatically activate plugins after installation or not.
		'message'      => '',
		// Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}

add_action( 'admin_notices', 'nightingale_admin_notice_demo_data' );
/**
 * Function to add in nag notice and welcome message on theme activation.
 */
function nightingale_admin_notice_demo_data() {

	// Hide bizberg admin message.
	if ( ! empty( $_GET['status'] ) && 'nightingale_hide_msg' === $_GET['status'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		update_option( 'nightingale_hide_msg', true );
	}

	$status = get_option( 'nightingale_hide_msg' );
	if ( true === $status ) {
		return;
	}

	if ( ! is_plugin_active( 'gutenberg/gutenberg.php' ) ) {
		$my_theme   = wp_get_theme();
		$theme_name = $my_theme->get( 'Name' );
		echo '<div id="message" class="notice-info settings-error notice is-dismissible"><p>';
		echo '<svg class="nhsuk-logo nhsuk-logo--white" style="width: 80px; height: 32px;"
				 xmlns="http://www.w3.org/2000/svg" role="presentation" focusable="false" viewBox="0 0 40 16">
				<path fill="#fff" d="M0 0h40v16H0z"></path>
				<path fill="#fff" d="M0 0h40v16H0z"></path>
				<path fill="#005eb8"
					  d="M3.9 1.5h4.4l2.6 9h.1l1.8-9h3.3l-2.8 13H9l-2.7-9h-.1l-1.8 9H1.1M17.3 1.5h3.6l-1 4.9h4L25 1.5h3.5l-2.7 13h-3.5l1.1-5.6h-4.1l-1.2 5.6h-3.4M37.7 4.4c-.7-.3-1.6-.6-2.9-.6-1.4 0-2.5.2-2.5 1.3 0 1.8 5.1 1.2 5.1 5.1 0 3.6-3.3 4.5-6.4 4.5-1.3 0-2.9-.3-4-.7l.8-2.7c.7.4 2.1.7 3.2.7s2.8-.2 2.8-1.5c0-2.1-5.1-1.3-5.1-5 0-3.4 2.9-4.4 5.8-4.4 1.6 0 3.1.2 4 .6"></path>
				<image src="https://assets.nhs.uk/images/nhs-logo.png" xlink:href=""></image>
			</svg>';
		echo '<strong style="font-size: 20px; padding-bottom: 10px; display: block;">';
		printf(
			/* translators: 1: theme name. */
			esc_html__(
				'Thank you for installing %1$s',
				'nightingale'
			),
			esc_html( $theme_name )
		);
		echo '</strong>';
		echo '<p>' . esc_html__( 'This will give your website a professional NHS themed template, with all NHS Frontend components available to you. The theme is developed and maintained by the digital team at NHS Leadership Academy, and is intended for use solely on sites within the NHS in the UK', 'nightingale' ) . '</p>';
		echo '<p><b>' . esc_html__( 'Install all recommended plugins below to get started.', 'nightingale' ) . '</b></p>';
		echo '</p></div>';
	}
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
 * Login Screen
 */
require get_template_directory() . '/inc/login.php';

/**
 * Pagination
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Breadcrumb element.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Create an array of active plugins.
 */

$active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );

/**
 * Gravity Forms style over-ride.
 */
if ( in_array( 'gravityforms/gravityforms.php', $active_plugins, true ) ) {
	if ( ! is_admin() ) {
		require get_template_directory() . '/inc/gravity-forms.php';
	}
}

/**
 * LearnDash style over-ride.
 */
if ( in_array( 'sfwd-lms/sfwd-lms.php', $active_plugins, true ) ) {
	if ( ! is_admin() ) {
		require get_template_directory() . '/inc/learndash.php';
	}
}
/**
 * Retina Ready Image code.
 */
require get_template_directory() . '/inc/retina-images.php';

/**
 * Performance Boosters - should be loaded as last element of functions file.
 */
require get_template_directory() . '/inc/performance-optimisations.php';

/**
 * Shove the critical path css directly into the header.
 */
require get_template_directory() . '/inc/critical-style.php';

/**
 * Add a pill next to comment author name showing their user role.
 */
require get_template_directory() . '/inc/class-comment-author-role-label.php';

add_filter( 'render_block', 'nightingale_latest_posts_block_filter', 10, 3 );

/**
 * Amend the markup in the latest news block to bring in to NHSUK styling.
 *
 * @param string $block_content - the generated html from core block.
 * @param string $block - the name of the block.
 *
 * @return string $output - the amended html markup.
 */
function nightingale_latest_posts_block_filter( $block_content, $block ) {

	if ( 'core/latest-posts' !== $block['blockName'] ) {
		return $block_content;
	}
	$output = '<div class="nhsuk-grid-row nightingale-latest-news"><div class="nhsuk-panel-group">';
	$dom    = new DOMDocument();
	libxml_use_internal_errors( true );
	$dom->loadHTML( $block_content );
	$lis = $dom->getElementsByTagName( 'li' );
	foreach ( $lis as $li ) {
		$output  .= '<div class="nhsuk-grid-column-one-third nhsuk-panel-group__item"><div class="nhsuk-panel">';
		$titles   = $li->getElementsByTagName( 'a' );
		$title    = $titles->item( 0 )->nodeValue;
		$link     = $titles->item( 0 )->getAttribute( 'href' );
		$contents = $li->getElementsByTagName( 'div' );
		$excerpt  = $contents->item( 0 )->nodeValue;
		$output  .= '<h3><a href="' . $link . '"> ' . $title . '</a></h3>';
		$output  .= '<p>' . substr( $excerpt, 0, - 13 ) . '</p>';
		$output  .= nightingale_read_more_posts( $title, $link );
		$output  .= '</div></div>';
	}
	$output .= '</div></div>';

	return $output;
}

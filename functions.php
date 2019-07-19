<?php
/**
 * Nightingale 2.0 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Nightingale_2.0
 */

if ( ! function_exists( 'nightingale_2_0_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function nightingale_2_0_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Nightingale 2.0, use a find and replace
         * to change 'nightingale-2-0' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'nightingale-2-0', get_template_directory() . '/languages' );

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

        // This theme uses wp_nav_menu() in one location.
        //function register_my_menus() {
            register_nav_menus(
                array(
                    'main-menu' => __( 'Main Menu' ),
                    'footer-menu' => __( 'Footer Links' )
                )
            );
        //}
        //add_action( 'init', 'register_my_menus' );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'nightingale_2_0_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
        // Load regular editor styles into the new block-based editor.
        add_theme_support( 'editor-styles' );
        // Load default block styles.
        add_theme_support( 'wp-block-styles' );
        // Add support for responsive embeds.
        add_theme_support( 'responsive-embeds' );
        // Define and register starter content to showcase the theme on new sites.
        $starter_content = array(
            'widgets'     => array(
                // Place three core-defined widgets in the sidebar area.
                'sidebar-1' => array(
                    'subpages-widget',
                ),
            ),
            'posts'       => array(
                'home',
                'blog',
            ),
            // Default to a static front page and assign the front and posts pages.
            'options'     => array(
                'show_on_front'  => 'page',
                'page_on_front'  => '{{home}}',
                'page_for_posts' => '{{blog}}',
            ),
            'theme_mods'  => array(
                'panel_1' => '{{homepage-section}}',
                'panel_2' => '{{blog}}',
            ),

            // Set up nav menus for each of the two areas registered in the theme.
            'nav_menus'   => array(
                // Assign a menu to the "main-menu" location.
                'main-menu'    => array(
                    'name'  => __( 'Main Menu', 'nightingale_2_0' ),
                    'items' => array(
                        'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
                        'page_blog',
                    ),
                ),
                // Assign a menu to the "footer-menu" location.
                'footer-menu' => array(
                    'name'  => __( 'Footer Links', 'nightingale_2_0' ),
                    'items' => array(
                        'link_home',
                        'page-blog',
                    ),
                ),
            ),
        );

        $starter_content = apply_filters( 'nightingale_2_0_starter_content', $starter_content );
        add_theme_support( 'starter-content', $starter_content );
        unregister_widget('WP_Widget_Search'); // taking out search widget as included in header by default

        /**
         * Disable XML RPC by default
         */
        add_filter( 'xmlrpc_enabled', '__return_false' );

    }
endif;
add_action( 'after_setup_theme', 'nightingale_2_0_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nightingale_2_0_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'nightingale_2_0_content_width', 640 );
}
add_action( 'after_setup_theme', 'nightingale_2_0_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nightingale_2_0_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'nightingale-2-0' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Elements to show int he sidebar. each widget will show as a panel.', 'nightingale-2-0' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Region', 'nightingale-2-0' ),
        'id'            => 'footer-region',
        'description'   => esc_html__( 'Widgets to show in the footer zone.', 'nightingale-2-0' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
    ) );
}
add_action( 'widgets_init', 'nightingale_2_0_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function nightingale_2_0_scripts() {
    wp_enqueue_style( 'nightingale-2-0-style', get_stylesheet_uri() );

    wp_enqueue_script( 'nightingale-2-0-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

    wp_enqueue_script( 'nightingale-2-0-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'nightingale_2_0_scripts' );





/**
 * Force download of dependancy plugins
 */
require_once get_template_directory() . '/lib/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'nightingale_2_0_register_required_plugins' );
function nightingale_2_0_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin bundled with a theme.
        array(
            'name'               => 'NHS Leadership Academy Blocks for Gutenberg', // The plugin name.
            'slug'               => 'nhsl-blocks', // The plugin slug (typically the folder name).
            'source'             => 'https://github.com/NHSLeadership/nhsl-wp-blocks/blob/master/nhsl-blocks.zip', // The plugin source.
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be
            // deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
            'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),



    );

    /*
     * Array of configuration settings. Amend each line as needed.
     */
    $config = array(
        'id'           => 'NHS',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => 'We recommend you install this plugin to add the full NHS Frontend library range of components to your wordpress editor. This plugin will only work if you already have ACF Pro installed (if you are an NHS organisation, you can get this for free with an NHS wide license, available by emailing tony.blacker@leadershipacademy.nhs.uk)',

        //
        // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa( $plugins, $config );
}

function nightingale_2_0_blacklist_blocks() {
    wp_enqueue_script(
        'nightingale_2_0_blacklist_blocks',
        get_template_directory() . '/assets/editor.js',
        array( 'wp-blocks', 'wp-dom-ready', 'wp-edit-post' )
    );
}
add_action( 'enqueue_block_editor_assets', 'nightingale_2_0_blacklist_blocks' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Gravity Forms style over-ride.
 */
require get_template_directory() . '/inc/gravity-forms.php';



/**
 * Auto deploy subpages widget.
 */
require get_template_directory() . '/inc/nightingale_subpages_widget.php';


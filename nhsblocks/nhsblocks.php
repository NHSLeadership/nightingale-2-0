<?php

/**
 * Plugin Name: nhsblocks
 * Plugin URI: to follow
 * Description: Gutenberg native custom blocks for the NHS Nightingale 2.0 theme.
 * Version: 1.0.0
 * Author: Tony Blacker, NHS Leadership Academy
 *
 * @package nhsblocks
 */

defined('ABSPATH') || exit;

/**
 * Load translations (if any) for the plugin from the /languages/ folder.
 *
 * @link https://developer.wordpress.org/reference/functions/load_plugin_textdomain/
 */
add_action('init', 'nhsblocks_load_textdomain');

function nhsblocks_load_textdomain()
{
    load_plugin_textdomain('nhsblocks', false, basename(__DIR__) . '/languages');
}

/**
 * Add custom "nhsblocks" block category
 *
 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/filters/block-filters/#managing-block-categories
 */
add_filter('block_categories', 'nhsblocks_block_categories', 10, 2);

function nhsblocks_block_categories($categories, $post)
{

    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'nhsblocks',
                'title' => __('NHS Frontend Blocks', 'nhsblocks'),
                'icon' => 'screen',
            ),
        )
    );
}

/**
 * Registers all block assets so that they can be enqueued through the Block Editor in
 * the corresponding context.
 *
 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/block-api/block-registration/
 */
add_action('init', 'nhsblocks_register_blocks');

function nhsblocks_register_blocks()
{

    // If Block Editor is not active, bail.
    if (!function_exists('register_block_type')) {
        return;
    }

    // Retister the block editor script.
    wp_register_script(
        'nhsblocks-editor-script',                                            // label
        get_template_directory_uri() . '/nhsblocks/build/index.js',                        // script file
        array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', "wp-data"),        // dependencies
        false
    );

    // Array of block created in this plugin.
    $blocks = [
        'nhsblocks/dodont',
        'nhsblocks/button',
        'nhsblocks/reveal1',
        'nhsblocks/promo1',
        'nhsblocks/quote1',
        'nhsblocks/card',

    ];

    // Loop through $blocks and register each block with the same script and styles.
    foreach ($blocks as $block) {
        register_block_type($block, array(
            'editor_script' => 'nhsblocks-editor-script',                    // Calls registered script above
        ));
    }

    if (function_exists('wp_set_script_translations')) {
        /**
         * Adds internationalization support.
         *
         * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/internationalization/
         * @link https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
         */
        wp_set_script_translations('nhsblocks-editor-script', 'nhsblocks', get_template_directory_uri() . '/languages');
    }

}

/**
 * Build classes based on block attributes.
 * Returns string of classes.
 *
 * $attributes - array - Block attributes.
 */
function nhsblocks_block_classes($attributes)
{
    $classes = null;
    if ($attributes['align']) {
        $classes = 'align' . $attributes['align'] . ' ';
    }

    if ($attributes['className']) {
        $classes .= $attributes['className'];
    }

    return $classes;
}

// latest news front end rendering
function nhsblocks_render_block_latest_news($attributes)
{
    $total = 6;
    $columns = 3;
    $category = '';
    if ($columns == 2) {
        $width = 'half';
    } else {
        $width = 'third';
    }
    $args = array(
        'posts_per_page' => $total,
        'post_status' => 'publish',
        'post_type' => 'post',
        'order' => 'DESC',
        'orderby' => 'date',
    );
    $news_query = new WP_Query($args);
    $newsout = '<div class="nhsuk-grid-row">
                  <div class="nhsuk-panel-group">';
    $i = 1;
    if ($news_query->have_posts()) :
        while ($news_query->have_posts()) :
            $news_query->the_post();
            $newsout .= '<div class="nhsuk-grid-column-one-' . $width . ' nhsuk-panel-group__item">
                         <div class="nhsuk-panel"><h3>';
            the_title();
            $newsout .= '</h3>';
            $newsout .= the_post_thumbnail();
            $newsout .= the_excerpt();
            $newsout .= nightingale_2_0_read_more();
            $newsout .= '   </div>
                      </div>';
            if ($i == $columns) {
                $newsout .= '</div><div class="nhsuk-panel-group">';
                $i = 0;
            }

            $i++;
        endwhile;
        wp_reset_postdata();
    else:
        $newsout .= '<p>' . __('No News') . '</p>';
    endif;
    $newsout .= '</div></div>';
    return $newsout;
    /*$post = $recent_posts[ 0 ];
    $post_id = $post['ID'];
    return sprintf(
        '<a class="wp-block-riad-latest-post" href="%1$s">%2$s</a>',
        esc_url( get_permalink( $post_id ) ),
        esc_html( get_the_title( $post_id ) )
    );*/
}

register_block_type('nhsblocks/latestnews', array(
    'render_callback' => 'nhsblocks_render_block_latest_news',
));


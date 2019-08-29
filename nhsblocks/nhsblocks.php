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

defined( 'ABSPATH' ) || exit;

/**
 * Load translations (if any) for the plugin from the /languages/ folder.
 *
 * @link https://developer.wordpress.org/reference/functions/load_plugin_textdomain/
 */
add_action( 'init', 'nightingale_2_0_blocks_load_textdomain' );

/**
 * Set the domain to be used for translations
 */
function nightingale_2_0_blocks_load_textdomain() {
	load_plugin_textdomain( 'nhsblocks', false, basename( __DIR__ ) . '/languages' );
}

/**
 * Add custom "nhsblocks" block category
 *
 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/filters/block-filters/#managing-block-categories
 */
add_filter( 'block_categories', 'nightingale_2_0_blocks_block_categories', 10, 2 );

/**
 * Create the category.
 *
 * @param array   $categories the details of added categories (in this case an array of 1 item).
 * @param integer $post Unused variable, intended for future expansion of function.
 *
 * @return array
 */
function nightingale_2_0_blocks_block_categories( $categories, $post ) {

	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'nhsblocks',
				'title' => __( 'NHS Frontend Blocks', 'nightingale-2-0' ),
				'icon'  => 'screen',
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
add_action( 'init', 'nightingale_2_0_blocks_register_blocks' );

/**
 * Function to initiate the Gutenberg blocks in this theme.
 */
function nightingale_2_0_blocks_register_blocks() {

	// If Block Editor is not active, bail.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	// Retister the block editor script.
	wp_register_script(
		'nhsblocks-editor-script',                                            // label.
		get_template_directory_uri() . '/nhsblocks/build/index.js',                        // script file.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-data' ),        // dependencies.
		'20190828'
	);

	register_block_type(
		'nhsblocks/panel1',
		array(
			'editor_script' => 'nhsblocks-editor-script',                    // Calls registered script above.
		)
	);

	if ( function_exists( 'wp_set_script_translations' ) ) {
		/**
		 * Adds internationalization support.
		 *
		 * @link https://wordpress.org/gutenberg/handbook/designers-developers/developers/internationalization/
		 * @link https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
		 */
		wp_set_script_translations( 'nhsblocks-editor-script', 'nightingale-2-0', get_template_directory_uri() . '/languages' );
	}

}

/**
 * Build classes based on block attributes.
 * Returns string of classes.
 *
 * @param array $attributes - Block attributes.
 *
 * @return array $classes - the finished array of classes to attach to blocks.
 */
function nightingale_2_0_blocks_block_classes( $attributes ) {
	$classes = null;
	if ( $attributes['align'] ) {
		$classes = 'align' . $attributes['align'] . ' ';
	}

	if ( $attributes['className'] ) {
		$classes .= $attributes['className'];
	}

	return $classes;
}

/**
 * Latest news front end rendering
 *
 * @param array $attributes The raw data to be processed.
 *
 * @return array $newsout The cleaned data to match NHSUK styling and markup.
 */
function nightingale_2_0_blocks_render_block_latest_news( $attributes ) {
	$total    = 6;
	$columns  = 3;
	$category = '';
	if ( 2 == $columns ) {
		$width = 'half';
	} else {
		$width = 'third';
	}
	$args       = array(
		'posts_per_page' => $total,
		'post_status'    => 'publish',
		'post_type'      => 'post',
		'order'          => 'DESC',
		'orderby'        => 'date',
	);
	$news_query = new WP_Query( $args );
	$newsout    = '<div class="nhsuk-grid-row">
				  <div class="nhsuk-panel-group">';
	$i          = 1;
	if ( $news_query->have_posts() ) :
		while ( $news_query->have_posts() ) :
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
			if ( $i == $columns ) {
				$newsout .= '</div><div class="nhsuk-panel-group">';
				$i       = 0;
			}

			$i ++;
		endwhile;
		wp_reset_postdata();
		else :
			$newsout .= '<p>' . __( 'No News', 'nightingale-2-0' ) . '</p>';
	endif;
		$newsout .= '</div></div>';

		return $newsout;

}

register_block_type(
	'nhsblocks/latestnews',
	array(
		'render_callback' => 'nightingale_2_0_blocks_render_block_latest_news',
	)
);


<?php
/**
 * Enqueue Gutenberg block editor style
 *
 * @package Nightingale-2-0
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

/**
 * Line up the admin editor css
 */
function nhsl_gutenberg_editor_styles() {
	wp_enqueue_style( 'nhsl-block-editor-styles', get_theme_file_uri( '/style-gutenburg.css' ), false, '1.0', 'all' );
}

add_action( 'enqueue_block_editor_assets', 'nhsl_gutenberg_editor_styles' );

/**
 * Gutenberg scripts and styles
 */
function be_gutenberg_scripts() {

	wp_enqueue_script(
		'be-editor',
		get_stylesheet_directory_uri() . '/assets/js/editor.js',
		array( 'wp-blocks', 'wp-dom' ),
		filemtime( get_stylesheet_directory() . '/assets/js/editor.js' ),
		true
	);
}

add_action( 'enqueue_block_editor_assets', 'be_gutenberg_scripts' );
if ( ! function_exists( 'button_block_output' ) ) :
	/**
	 * Change the standard button to an NHSUK button
	 *
	 * @param string $output - block output.
	 * @param array  $attributes - block attributes.
	 */
	function button_block_output( $output, $attributes ) {
		ob_start();
		?>
		<a href="<?php echo esc_url( $attributes['buttonLink'] ); ?>" class="nhsuk-button"><?php echo esc_html( $attributes['buttonLabel'] ); ?></a>
		<?php
		return ob_get_clean();
	}
endif;

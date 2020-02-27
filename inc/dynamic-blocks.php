<?php
/**
 * Style core blocks in the Nightingale Way
 *
 * @package   Nightingale-2-0
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   1.0 27th February 2020
 */

add_filter( 'render_block', 'nightingale_filter_blocks', 10, 2 );


/**
 * Filter the blocks through our own method.
 *
 * @param array $block_content the contents of the block itself.
 * @param array $block         information about block being modified.
 *
 * @return function nightingale_block_renderer to send back the modified block content.
 */
function nightingale_filter_blocks( $block_content, $block ) {

	if ( is_admin() ) {
		return;
	}

	if ( 'core/latest-posts' !== $block['blockName'] ) {
		return $block_content;
	}

	return nightingale_block_renderer( $block['blockName'], $block['attrs'] );

}

/**
 * Render the modified block with our own method.
 *
 * @param string $name       the name of the block itself.
 * @param array  $attributes information about block being modified.
 *
 * @return string $object.
 */
function nightingale_block_renderer( $name, $attributes ) {

	// change template name slash to scores.
	$template_name = str_replace( '/', '-', $name );

	// Set query vars so they are accessible to the template part.
	foreach ( $attributes as $attribute_name => $attribute_value ) {
		set_query_var( $name . '/' . $attribute_name, $attribute_value );
	}

	$output = '';

	// Load the template part in an output buffer.
	ob_start();
	get_template_part( "template-parts/{$template_name}" );
	$output .= ob_get_clean();

	// Clear the query vars so they don't bleed into subsequent instances of the same block type.
	foreach ( $attributes as $attribute_name => $attribute_value ) {
		set_query_var( $name . '/' . $attribute_name, null );
	}

	return $output;
}

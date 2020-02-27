<?php


add_filter( 'render_block', 'nightingale_filter_blocks', 10, 2 );


function nightingale_filter_blocks( $block_content, $block ) {

	if ( is_admin() ) {
		return;
	}

	if( $block['blockName'] !== 'core/latest-posts' ) {
		return $block_content;
	}

	return nightingale_block_renderer( $block['blockName'],  $block['attrs'] );

}


function nightingale_block_renderer( string $name, array $attributes ) : string {

	// change template name slash to scores
	$template_name = str_replace( '/', '-', $name );

	// Set query vars so they are accessible to the template part:
	foreach ( $attributes as $attribute_name => $attribute_value ) {
		set_query_var( $name . '/' . $attribute_name, $attribute_value );
	}


	$output='';

	// Load the template part in an output buffer:
	ob_start();
	get_template_part( "template-parts/{$template_name}" );
	$output .= ob_get_clean();

	// Clear the query vars so they don't bleed into subsequent instances of the same block type
	foreach ( $attributes as $attribute_name => $attribute_value ) {
		set_query_var( $name . '/' . $attribute_name, null );
	}

	return $output;
}
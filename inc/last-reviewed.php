<?php
/**
 * Meta Box for choosing the page colour on a page
 *
 * @package Nightingale-2-0
 * @copyright NHS Leadership Academy, Very Twisty
 * @version Feburary 2020
 */

// Tutorial found here:
// https://code.tutsplus.com/tutorials/creating-upcoming-events-plugin-in-wordpress-custom-post-type-and-the-dashboard--wp-35404.

/*
* $id is that id of the metabox. It is also the id attribute for the rendered metabox on the screen.
* $title is the title of the metabox.
* $callback is the name of the function which will be used to render the contents of the metabox.
* $post_type is the name of the post type to which we want to add this metabox.
* $context is the area of the page to which we want to add the metabox. There are three contexts: normal, advance and side.
* $priority of the metabox within the given context which can be any of high, core, default or low.
* $callback_args is an array of arguments that can be passed to the callback function.
*/

/**
 * Create the colour picker in a metabox.
 */
function nightingale_lastreviewed_metabox() {
	add_meta_box(
		'nightingale-last-reviewed-metabox',
		__( 'Toggle Page Reviewd', 'nightingale' ),
		'nightingale_render_lastreviewed',
		'page',
		'side',
		'core'
	);
}

add_action( 'add_meta_boxes', 'nightingale_lastreviewed_metabox' );

/**
 * Render the colour picker.
 *
 * @param array $post the post variables.
 */
function nightingale_render_lastreviewed( $post ) {

	// generate a nonce field.
	wp_nonce_field( basename( __FILE__ ), 'nightingale-last-reviewed-nonce' );

	// get previously saved meta values (if any).
	$sidebar = esc_attr( get_post_meta( $post->ID, 'last-reviewed', true ) );

	$checked = $sidebar === 'on' ? true : false;

	?>

	<p><?php esc_html_e( 'Toggle last reviewed', 'nightingale' ); ?></p>
	<input type="radio" id="review-on" name="lastReviwed" value="on" <?php if( $checked ): echo 'checked'; endif; ?> >
	<label for="review-on">On</label><br>
	<input type="radio" id="review-off" name="lastReviwed" value="" <?php if( ! $checked ): echo 'checked'; endif; ?> >
	<label for="review-off">Off</label><br>

	<?php

}

/**
 * Gets the start and end dates and turns them into human readable format.
 *
 * @param int $post_id the unique post identifier.
 */
function nightingale_save_lastreviewed( $post_id ) {
	// checking if the post being saved is a 'page',
	// if not, then return.
	global $pagenow;

	if ( 'post.php' !== $pagenow && 'post-new.php' !== $pagenow ) {
		return;
	}

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	if ( isset( $_POST['nightingale-last-reviewed-nonce'] ) ) {
		$nightingale_colour_picker_nonce = sanitize_text_field( wp_unslash( $_POST['nightingale-last-reviewed-nonce'] ) );
	} else {
		$nightingale_colour_picker_nonce = '';
	}
	$is_valid_nonce = ( isset( $_POST['nightingale-last-reviewed-nonce'] ) && ( wp_verify_nonce( $nightingale_colour_picker_nonce, basename( __FILE__ ) ) ) ) ? true : false;

	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}

	if ( isset( $_POST['lastReviwed'] ) ) {
		$last_reviewed = sanitize_text_field( wp_unslash( $_POST['lastReviwed'] ) );
		update_post_meta( $post_id, 'last-reviewed', esc_attr( wp_unslash( $last_reviewed ) ) );
	}

}

add_action( 'save_post', 'nightingale_save_lastreviewed' );







add_action('page-after-content', 'page_last_reviewed' );

function page_last_reviewed(){

	$display = get_post_meta( get_the_id(), 'last-reviewed', true );

	if( $display !== 'on' ){
		return;
	}

	$updated_date = get_the_modified_time('j F, Y'); 
?>

	<div class="nhsuk-review-date">
	  <p class="nhsuk-body-s">
	    Page last reviewed: <?php echo $updated_date; ?>
	  </p>
	</div>
	
<?php }



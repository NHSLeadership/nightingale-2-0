<?php
/**
 * Meta Box for choosing the page colour on a page
 *
 * @package   Nightingale-2-0
 * @copyright NHS Leadership Academy, Very Twisty
 * @version   1.1 21st August 2019
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
function nightingale_colourpicker_metabox() {
	add_meta_box(
		'nightingale-page-color-metabox',
		__( 'Colour Picker', 'nightingale' ),
		'nightingale_render_colourpicker',
		'page',
		'side',
		'core'
	);
}

add_action( 'add_meta_boxes', 'nightingale_colourpicker_metabox' );

/**
 * Render the colour picker.
 *
 * @param array $post the post variables.
 */
function nightingale_render_colourpicker( $post ) {

	// generate a nonce field.
	wp_nonce_field( basename( __FILE__ ), 'nightingale-colour-picker-nonce' );

	// get previously saved meta values (if any).
	$sidebar = esc_attr( get_post_meta( $post->ID, 'page-color', true ) );

	$theme_colours = nightingale_get_theme_colours();


	?>

	<label for="color-picker"><?php esc_html_e( 'Choose colour for the page. (Refresh the page for changes to take effect.)', 'nightingale' ); ?></label>
	<select id="color-picker" name="color-picker" class="widefat">
		<?php foreach ( $theme_colours as $name => $colour ) : ?>

			<?php $select = esc_attr( sanitize_title( $colour ) ) === $sidebar ? 'selected' : ''; ?>

			<option value="<?php echo esc_attr( sanitize_title( $colour ) ); ?>" <?php echo esc_html( $select ); ?> ><?php echo esc_html( $colour ); ?></option>

		<?php endforeach; ?>
	</select>
	<?php

}

/**
 * Gets the start and end dates and turns them into human readable format.
 *
 * @param int $post_id the unique post identifier.
 */
function nightingale_save_colourpicker( $post_id ) {
	// checking if the post being saved is a 'page',
	// if not, then return.
	global $pagenow;

	if ( 'post.php' !== $pagenow && 'post-new.php' !== $pagenow ) {
		return;
	}

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	if ( isset( $_POST['nightingale-colour-picker-nonce'] ) ) {
		$nightingale_colour_picker_nonce = sanitize_text_field( wp_unslash( $_POST['nightingale-colour-picker-nonce'] ) );
	} else {
		$nightingale_colour_picker_nonce = '';
	}
	$is_valid_nonce = ( isset( $_POST['nightingale-colour-picker-nonce'] ) && ( wp_verify_nonce( $nightingale_colour_picker_nonce, basename( __FILE__ ) ) ) ) ? true : false;

	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}

	if ( isset( $_POST['color-picker'] ) ) {
		$colorpicker = sanitize_text_field( wp_unslash( $_POST['color-picker'] ) );
		update_post_meta( $post_id, 'page-color', esc_attr( wp_unslash( $colorpicker ) ) );
	}

}

add_action( 'save_post', 'nightingale_save_colourpicker' );


add_filter( 'admin_body_class', 'nightingale_admin_body_class' );

/**
 * Adds one or more classes to the body tag in the dashboard.
 *
 * @link https://wordpress.stackexchange.com/a/154951/17187
 *
 * @param String $classes Current body classes.
 *
 * @return String          Altered body classes.
 */
function nightingale_admin_body_class( $classes ) {

	global $pagenow;

	if ( 'post.php' !== $pagenow && 'post-new.php' !== $pagenow ) {
		return;
	}

	$page_color = esc_attr( get_post_meta( get_the_id(), 'page-color', true ) );

	if ( $page_color ) {

		$extra_styles = $page_color ? 'page-style--' . $page_color : '';

		return "$classes $extra_styles";

	} else {
		return "$classes";
	}

}






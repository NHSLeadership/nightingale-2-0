<?php
/**
 * Meta Box for adding tab navigation to a page
 *
 * @package   Nightingale-2-0
 * @copyright NHS Leadership Academy, Very Twisty
 * @version   1.0
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
 * Create the last reviewed option in a metabox.
 */
function nightingale_tabbed_pages_metabox() {
	add_meta_box(
		'nightingale-tabbed-page-metabox',
		__( 'Display Tabbed Navigation for this section?', 'nightingale' ),
		'nightingale_render_tabbed_pages',
		'page',
		'side',
		'core'
	);
}

add_action( 'add_meta_boxes', 'nightingale_tabbed_pages_metabox' );

/**
 * Render the last reviewed.
 *
 * @param array $post the post variables.
 */
function nightingale_render_tabbed_pages( $post ) {

	// generate a nonce field.
	wp_nonce_field( basename( __FILE__ ), 'nightingale-tabbed-page-nonce' );

	// get previously saved meta values (if any).
	$sidebar = get_post_meta( $post->ID, 'tabbed-page', true );
	$tabname = get_post_meta( $post->ID, 'tabname', true );

	$checked = 'on' === $sidebar ? true : false;
	?>

	<p><b><?php esc_html_e( 'Show this section as tabs?', 'nightingale' ); ?></b></p>
	<p><i>This will show a tab navigation component at the top of this page. You will need to also toggle this to "on" for any sub pages to ensure consistency. If you have tabs set to active for multiple levels, the tab will show current
			and parent level pages only.</i></p>
	<input type="radio" id="tab-on" name="tabPage" value="on"
		<?php
		if ( $checked ) :
			echo 'checked';
		endif;
		?>
	>
	<label for="tab-on"><?php esc_html_e( 'On', 'nightingale' ); ?></label><br>
	<input type="radio" id="tab-off" name="tabPage" value=""
		<?php
		if ( ! $checked ) :
			echo 'checked';
		endif;
		?>
	>
	<label for="tab-off"><?php esc_html_e( 'Off', 'nightingale' ); ?></label><br>
	<br/>
	<label for="tabName"><b><?php esc_html_e( 'Text to show in Tab for this page', 'nightingale' ); ?></b></label>
	<p>If you leave this blank, the page name will be used. If your page name is too long and causing ugly tabs, you can use this text to show a shorter title.</p>
	<?php
	echo '<input name="tabName" id="tabName" value="' . esc_html( $tabname ) . '" />';
}

/**
 * Gets the value of tabbed page toggle and saves it to postmeta.
 *
 * @param int $post_id the unique post identifier.
 */
function nightingale_save_tabbed_pages( $post_id ) {
	// checking if the post being saved is a 'page',
	// if not, then return.
	global $pagenow;

	if ( 'post.php' !== $pagenow && 'post-new.php' !== $pagenow ) {
		return;
	}

	$is_autosave = wp_is_post_autosave( $post_id );
	if ( isset( $_POST['nightingale-tabbed-page-nonce'] ) ) {
		$nightingale_tab_nonce = sanitize_text_field( wp_unslash( $_POST['nightingale-tabbed-page-nonce'] ) );
	} else {
		$nightingale_tab_nonce = '';
	}
	$is_valid_nonce = ( isset( $_POST['nightingale-tabbed-page-nonce'] ) && ( wp_verify_nonce( $nightingale_tab_nonce, basename( __FILE__ ) ) ) ) ? true : false;

	if ( $is_autosave || ! $is_valid_nonce ) {
		return;
	}

	if ( isset( $_POST['tabPage'] ) ) {
		$tabbed_page = sanitize_text_field( wp_unslash( $_POST['tabPage'] ) );
		if ( isset( $_POST['tabName'] ) ) {
			$tabname = sanitize_text_field( wp_unslash( $_POST['tabName'] ) );
		}
		update_post_meta( $post_id, 'tabbed-page', wp_unslash( $tabbed_page ) );
		update_post_meta( $post_id, 'tabname', wp_unslash( $tabname ) );
	}

}

add_action( 'save_post', 'nightingale_save_tabbed_pages' );

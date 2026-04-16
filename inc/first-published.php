<?php
/**
 * First published meta box and front-end display.
 *
 * @package   Nightingale-2-0
 * @copyright NHS Leadership Academy, Mahesh Murali P
 * @version   April 2024
 */

/**
 * Register the first published toggle meta box.
 */
function nightingale_firstpublished_metabox() {
	add_meta_box(
		'nightingale-first-published-metabox',
		__( 'Toggle First Published', 'nightingale' ),
		'nightingale_render_firstpublished',
		'page',
		'side',
		'core'
	);
}
add_action( 'add_meta_boxes', 'nightingale_firstpublished_metabox' );

/**
 * Renders the first published meta box controls.
 *
 * @param WP_Post $post The current post object.
 */
function nightingale_render_firstpublished( $post ) {

	wp_nonce_field( basename( __FILE__ ), 'nightingale-first-published-nonce' );

	$sidebar = get_post_meta( $post->ID, 'first-published', true );
	$checked = ( 'on' === $sidebar );
	echo '<p>' . esc_html__( 'Toggle first published', 'nightingale' ) . '</p>';
	echo '<input type="radio" id="first-published-on" name="firstPublished" value="on" ' . checked( $checked, true, false ) . '>';
	echo '<label for="first-published-on">' . esc_html__( 'On', 'nightingale' ) . '</label><br>';
	echo '<input type="radio" id="first-published-off" name="firstPublished" value="" ' . checked( $checked, false, false ) . '>';
	echo '<label for="first-published-off">' . esc_html__( 'Off', 'nightingale' ) . '</label><br>';
}

/**
 * Saves the first published meta box value.
 *
 * @param int $post_id The post ID.
 */
function nightingale_save_firstpublished( $post_id ) {
	global $pagenow;

	if ( 'post.php' !== $pagenow && 'post-new.php' !== $pagenow ) {
		return;
	}

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );

	$nonce = '';
	if ( isset( $_POST['nightingale-first-published-nonce'] ) ) {
		$nonce = sanitize_text_field( wp_unslash( $_POST['nightingale-first-published-nonce'] ) );
	}

	$is_valid_nonce = ( ! empty( $nonce ) && wp_verify_nonce( $nonce, basename( __FILE__ ) ) );

	if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
		return;
	}

	if ( isset( $_POST['firstPublished'] ) ) {
		$first_published = sanitize_text_field( wp_unslash( $_POST['firstPublished'] ) );
		update_post_meta( $post_id, 'first-published', $first_published );
	}
}
add_action( 'save_post', 'nightingale_save_firstpublished' );

add_action( 'page_after_content', 'nightingale_page_first_published', 10 );
/**
 * Displays the first published date on the page.
 */
function nightingale_page_first_published() {
	$display = get_post_meta( get_the_id(), 'first-published', true );

	if ( 'on' !== $display ) {
		return;
	}

	$published_date = get_the_time( 'j F Y' );
	echo '<div class="nhsuk-review-date nhsuk-first-published-date">';
	echo '<p class="nhsuk-body-s">' . esc_html__( 'First published', 'nightingale' ) . ': ' . esc_html( $published_date ) . '</p>';
	echo '</div>';
}

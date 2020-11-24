<?php
/**
 * Template part for displaying buddypress content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( ! bp_is_user() && ! bp_is_group_single() && ! bp_is_group_create()
	           && ( ! function_exists( 'bbp_is_topic_archive' ) || ! bbp_is_topic_archive() ) ) : ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            <?php
            if ( function_exists( 'bp_is_register_page' ) ) {
            	if ( !is_user_logged_in() && bp_is_register_page() && 'request-details' === bp_get_current_signup_step() ) { ?>
                    <span><?php _e( 'or', 'nightingale'); ?> <a href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Sign in', 'nightingale'); ?></a></span>
                <?php }
            } ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<?php
	if( function_exists( 'buddyboss_bp' ) ) {
		$vue_components = buddyboss_bp()->get_vue_components();
		if ( function_exists( 'bp_is_user_notifications' ) && bp_is_user_notifications() && isset( $vue_components['buddyboss_vue_bp_notifications'] ) && ! $vue_components['buddyboss_vue_bp_notifications'] ) {
			?>
			<h1 class="title"><?php _e( 'Notifications', 'nightingale'); ?></h1><?php
		}
	}
	?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nightingale'),
			'after'	 => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
			sprintf(
			wp_kses(
			/* translators: %s: Name of current post. Only visible to screen readers */
			__( 'Edit <span class="screen-reader-text">%s</span>', 'nightingale'), array(
				'span' => array(
					'class' => array(),
				),
			)
			), get_the_title()
			), '<span class="edit-link">', '</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article>

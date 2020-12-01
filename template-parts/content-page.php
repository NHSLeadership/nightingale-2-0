<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link      https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   1.1 21st August 2019
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php do_action( 'nightingale_before_single_content' ); ?>

	<div class="entry-content">
		<?php
		if ( ! post_password_required() ) {
			if ( function_exists( 'nightingale_clean_bad_content' ) ) {
				nightingale_clean_bad_content( true );
			}
		} else {
			echo get_the_password_form( $post->ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		?>

		<?php do_action( 'page_after_content' ); ?>
	</div><!-- .entry-content -->
	<div class="nhsuk-content__clearfix"></div>

	<?php do_action( 'nightingale_after_single_content' ); ?>

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'nightingale' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->

<?php
/**
 * Template part for displaying posts
 *
 * @link      https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package   Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version   1.1 21st August 2019
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="nhsuk-heading-xl">', '</h1>' );
		else :
			the_title( '<h2 class="nhsuk-heading-l"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="nhsuk-review-date">
				<?php
				nightingale_posted_by();
				nightingale_posted_on();
				$readmorelink  = esc_url( get_permalink() );
				$readmoretitle = esc_html( get_the_title() );
				if ( strlen( $readmoretitle ) < 1 ) {
					$readmoretitle = esc_html__( 'this post', 'nightingale' );
					echo '<div class="nhsuk-readmore">' . nightingale_read_more_posts( $readmoretitle, $readmorelink ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
				</p>
			</div><!-- .article-meta -->
		<?php endif; ?>
	</header><!-- .article-header -->

	<?php
	if ( has_post_thumbnail() ) {
		$featured_img_display = get_theme_mod( 'featured_img_display', 'true' );
		if ( 'true' === $featured_img_display ) {
			$blog_fimage_display = get_theme_mod( 'blog_fimage_display', 'top' );
			echo '<span class="featured-' . $blog_fimage_display . '">';
			nightingale_post_thumbnail();
			echo '</span>';
		}
	}
	?>

	<?php do_action( 'nightingale_before_single_content' ); ?>

	<article>
		<?php
		if ( function_exists( 'nightingale_clean_bad_content' ) ) {
			nightingale_clean_bad_content( true );
		}

		$defaults = array(
			'before'           => '<p>' . __( 'Pages:', 'nightingale' ),
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'separator'        => ' ',
			'nextpagelink'     => __( 'Next page', 'nightingale' ),
			'previouspagelink' => __( 'Previous page', 'nightingale' ),
			'pagelink'         => '%',
			'echo'             => 1,
		);

		wp_link_pages( $defaults );
		?>
	</article><!-- .article-content -->
	<div class="nhsuk-content__clearfix"></div>

	<?php do_action( 'nightingale_after_single_content' ); ?>

	<footer class="article-footer">

		<?php nightingale_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

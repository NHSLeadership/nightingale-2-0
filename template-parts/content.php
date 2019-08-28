<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nightingale_2.0
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="article-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="nhsuk-heading-xl">', '</h1>' );
		else :
			the_title( '<h2 class="nhsuk-heading-l"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="nhsuk-review-date">
				<p class="nhsuk-body-s">
					<?php
					nightingale_2_0_posted_by();
					nightingale_2_0_posted_on();
					?>
				</p>
			</div><!-- .article-meta -->
		<?php endif; ?>
	</header><!-- .article-header -->

	<?php nightingale_2_0_post_thumbnail(); ?>

	<article>
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'nightingale-2-0' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nightingale-2-0' ),
				'after'  => '</div>',
			)
		);
		?>
	</article><!-- .article-content -->

	<footer class="article-footer">
		<details class="nhsuk-details nhsuk-expander">
			<summary class="nhsuk-details__summary">
	<span class="nhsuk-details__summary-text">
	  Meta information
	</span>
			</summary>
			<div class="nhsuk-details__text">
				<?php nightingale_2_0_entry_footer(); ?>
			</div>
		</details>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->

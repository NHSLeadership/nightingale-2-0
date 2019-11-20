<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

get_header();
?>

	<div id="primary" class=" nhsuk-grid-row 123">
		<div class="nhsuk-grid-column-full">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );
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
				nightingale_get_prev_next();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</div>

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

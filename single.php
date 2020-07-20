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

	<div id="primary" class=" nhsuk-grid-row nhsuk-width-restrict">
		<div class="
		<?php
		if ( nightingale_show_sidebar() ) :
			echo 'nhsuk-grid-column-two-thirds ';
			echo nightingale_sidebar_location( 'sidebar-2' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		endif;
		?>
		single">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', get_post_type() );
				nightingale_get_prev_next();

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</div>
		<?php
		if ( nightingale_show_sidebar() ) :
			get_sidebar( 'blog' );
		endif;
		?>

	</div><!-- #primary -->

<?php
get_footer();

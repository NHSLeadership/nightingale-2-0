<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

get_header();

$sidebar = nightingale_show_sidebar();

?>
	<div id="primary" class=" nhsuk-grid-row">
		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->

		<div class="
		<?php
		if ( $sidebar ) :
			echo 'nhsuk-grid-column-two-thirds ';
			echo nightingale_sidebar_location( 'sidebar-2' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		endif;
		?>
		archive">

			<?php
			if ( have_posts() ) :
				?>

				<div class="nhsuk-grid-row nhsuk-promo-group">

					<?php
					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;
					?>

				</div>

				<?php

				nightingale_archive_pagination();

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>


		</div>

		<?php
		if ( $sidebar ) :
			get_sidebar( 'blog' );
		endif;
		?>
	</div><!-- #primary -->

<?php

get_footer();

<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

	<div id="primary" class="clear">

		<?php

		if ( is_home() && ! is_front_page() ) :
			?>
			<header>
				<h1 class="nhsuk-heading-xl"><?php single_post_title(); ?></h1>
			</header>
			<?php
		endif;
		?>

		<div class="
		<?php
		if ( $sidebar ) :
			echo 'nhsuk-grid-column-two-thirds ';
			echo nightingale_sidebar_location( 'sidebar-2' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		endif;
		?>
		index">

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

				</div><!-- #nhsuk-panel-group nhsuk-grid-column-full -->

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

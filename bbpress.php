<?php
/**
 * The template for displaying bbPress pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */

get_header();

$is_buddyboss_bbpress = function_exists( 'buddyboss_bbpress' );

if ( ! $is_buddyboss_bbpress && ! bbp_is_single_user() ) {
	get_template_part( 'template-parts/bbpress-banner' );
} ?>

		<?php if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'bbpress' );

			endwhile;
			?>

			<?php
		//buddyboss_pagination();

		else :
			get_template_part( 'template-parts/content', 'none' );
			?>

		<?php endif; ?>


<?php
get_footer();

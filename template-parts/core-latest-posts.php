<?php
/**
 * Template part for displaying latest posts block
 *
 * @link      https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package   Nightingale
 * @copyright NHS Leadership Academy, VeryTwisty
 * @version   1.0 27th february 2020
 */

$namespace = 'core/latest-posts/';

/*
Set up all the arguments that can be defined in the blocks management for latest posts
so we can then pass them down to the display elements correctly
*/
$parent_template_part   = 'latest-posts';
$posts_to_show          = get_query_var( $namespace . 'postsToShow' ) ? get_query_var( $namespace . 'postsToShow' ) : 5; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
$categories             = get_query_var( $namespace . 'categories' );
$display_post_content   = get_query_var( $namespace . 'displayPostContent' ) ? get_query_var( $namespace . 'displayPostContent' ) : 0; // Default to not show post content.
$excerpt_length         = get_query_var( $namespace . 'excerptLength' ) ? get_query_var( $namespace . 'excerptLength' ) : 20; // Default excerpt length of 20 words.
$display_full_post      = get_query_var( $namespace . 'displayPostContentRadio' ) ? get_query_var( $namespace . 'displayPostContentRadio' ) : 'excerpt'; // Default to show excerpt not full post.
$display_author         = get_query_var( $namespace . 'displayAuthor' ) ? get_query_var( $namespace . 'displayAuthor' ) : 0; // Default to not show author.
$display_post_date      = get_query_var( $namespace . 'displayPostDate' ) ? get_query_var( $namespace . 'displayPostDate' ) : 0; // Default to not show post date.
$display_featured_image = get_query_var( $namespace . 'displayFeaturedImage' ) ? get_query_var( $namespace . 'displayFeaturedImage' ) : 0; // Default to not show Featured Image.
$post_layout            = get_query_var( $namespace . 'postLayout' ) ? get_query_var( $namespace . 'postLayout' ) : 'row'; // Default to show as rows.
$columns                = get_query_var( $namespace . 'columns' ) ? get_query_var( $namespace . 'columns' ) : 3; // Default to 3 column display.

$args = array(
	'posts_per_page'      => $posts_to_show,
	'post_status'         => 'publish',
	'order'               => get_query_var( $namespace . 'order' ) ? get_query_var( $namespace . 'order' ) : 'desc',
	'orderby'             => get_query_var( $namespace . 'orderBy' ) ? get_query_var( $namespace . 'orderBy' ) : 'date',
	'ignore_sticky_posts' => 1,
	'suppress_filters'    => false,
);

if ( ( isset( $categories ) ) && ( ! empty( $categories ) ) ) {
	$catsout = array();
	foreach ( $categories as $cattemp ) {
		$catsout[] = $cattemp['id'];
	}
	$args['cat'] = $catsout;
}


$sidebar = nightingale_show_sidebar();

$the_query = new WP_Query( $args );

// The Loop.
if ( $the_query->have_posts() ) : ?>
	<div class="nhsuk-grid-row nhsuk-promo-group">

		<?php
		while ( $the_query->have_posts() ) :
			$the_query->the_post();
			?>

			<?php
			// get_template_part( 'template-parts/content', 'post' );
			// use include and locate_template functions to be able to pass variables of the block down into the content.
			// we are deliberately NOT using get_template_part as we need to pass variables in to the component.
			include locate_template( 'template-parts/content-post.php', false, false ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			?>

		<?php endwhile; ?>

	</div>

	<?php

endif;

/* Restore original Post Data */
wp_reset_postdata();

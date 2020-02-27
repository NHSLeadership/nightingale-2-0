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


$posts_to_show = get_query_var( $namespace . 'postsToShow' ) ? get_query_var( $namespace . 'postsToShow' ) : 5; // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
$categories    = get_query_var( $namespace . 'categories' );


$args = array(
	'posts_per_page'      => $posts_to_show,
	'post_status'         => 'publish',
	'order'               => get_query_var( $namespace . 'order' ) ? get_query_var( $namespace . 'order' ) : 'desc',
	'orderby'             => get_query_var( $namespace . 'orderBy' ) ? get_query_var( $namespace . 'orderBy' ) : 'date',
	'ignore_sticky_posts' => 1,
	'suppress_filters'    => false,
);

if ( isset( $categories ) ) {
	$args['cat'] = $categories;
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

			<?php get_template_part( 'template-parts/content', 'post' ); ?>

		<?php endwhile; ?>

	</div>

	<?php

endif;

/* Restore original Post Data */
wp_reset_postdata();

?>

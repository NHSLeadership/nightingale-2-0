<?php

$namespace = 'core/latest-posts/';

$postsToShow = get_query_var( $namespace . 'postsToShow' ) ? get_query_var( $namespace . 'postsToShow' ) : 5;
$categories = get_query_var( $namespace . 'categories' );
$order = get_query_var( $namespace . 'order' ) ? get_query_var( $namespace . 'order' ) : 'desc';


$displayPostContent = get_query_var( $namespace . 'displayPostContent' );
$excerptLength = get_query_var( $namespace . 'excerptLength' );
$displayPostDate = get_query_var( $namespace . 'displayPostDate' );
$displayPostContentRadio = get_query_var( $namespace . 'displayPostContentRadio' );


$args = array(
		'posts_per_page'   => $postsToShow,
		'post_status'      => 'publish',
		'order'            => $attributes['order'],
		'orderby'          => $order,
		'suppress_filters' => false,
	);

if ( isset( $categories ) ) {
	$args['category'] = $categories;
}

$sidebar = nightingale_show_sidebar();

$the_query = new WP_Query( $args );
 
// The Loop
if ( $the_query->have_posts() ) : ?>



			<div class="nhsuk-grid-row nhsuk-promo-group">

			    <?php while ( $the_query->have_posts() ) :
			        $the_query->the_post(); ?>

			        <?php get_template_part( 'template-parts/content', 'post' ) ?>

				<?php endwhile; ?>

			</div>


 <?php 

endif;

/* Restore original Post Data */
wp_reset_postdata();

?>

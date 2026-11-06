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
$parent_template_part = 'latest-posts';
if ( is_front_page() ) {
	$archive_paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
} else {
	$archive_paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
}
$posts_to_show = get_query_var( $namespace . 'postsToShow' ); // phpcs:ignore WordPress.NamingConventions.ValidVariableName.VariableNotSnakeCase
if ( isset( $_POST['cat_filter'] ) && ( ! empty( $_POST['cat_filter'] ) ) ) {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$cat_filter   = sanitize_text_field( wp_unslash( $_POST['cat_filter'] ) );                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$categories[] = array(
		'id'    => $cat_filter,
		'value' => get_cat_name( $cat_filter ),
	);
} else {
	$categories = get_query_var( $namespace . 'categories' );
}
$display_post_content   = get_query_var( $namespace . 'displayPostContent' ) ? get_query_var( $namespace . 'displayPostContent' ) : 0;                   // Default to not show post content.
$excerpt_length         = get_query_var( $namespace . 'excerptLength' ) ? get_query_var( $namespace . 'excerptLength' ) : 20;          // Default excerpt length of 20 words.
$display_full_post      = get_query_var( $namespace . 'displayPostContentRadio' ) ? get_query_var( $namespace . 'displayPostContentRadio' ) : 'excerpt'; // Default to show excerpt not full post.
$display_author         = get_query_var( $namespace . 'displayAuthor' ) ? get_query_var( $namespace . 'displayAuthor' ) : 0;                             // Default to not show author.
$display_post_date      = get_query_var( $namespace . 'displayPostDate' ) ? get_query_var( $namespace . 'displayPostDate' ) : 0;                         // Default to not show post date.
$display_featured_image = get_query_var( $namespace . 'displayFeaturedImage' ) ? get_query_var( $namespace . 'displayFeaturedImage' ) : 0;               // Default to not show Featured Image.
$post_layout            = get_query_var( $namespace . 'postLayout' ) ? get_query_var( $namespace . 'postLayout' ) : 'row';                               // Default to show as rows.
$columns                = get_query_var( $namespace . 'columns' ) ? get_query_var( $namespace . 'columns' ) : 3;                                         // Default to 3 column display.

$args     = array(
	'posts_per_page'      => $posts_to_show,
	'post_status'         => 'publish',
	'order'               => get_query_var( $namespace . 'order' ) ? get_query_var( $namespace . 'order' ) : 'desc',
	'orderby'             => get_query_var( $namespace . 'orderBy' ) ? get_query_var( $namespace . 'orderBy' ) : 'date',
	'ignore_sticky_posts' => 1,
	'suppress_filters'    => false,
	'paged'               => $archive_paged,
);
$catcount = 0;
$catout   = array();
if ( ( isset( $categories ) ) && ( ! empty( $categories ) ) ) {
	foreach ( $categories as $cattmp ) {
		$catout[] = $cattmp['id'];
		$catcount ++;
	}
	$args['category__in'] = $catout;
}

$sidebar = nightingale_show_sidebar();

$the_query = new WP_Query( $args );

// The Loop.
if ( $the_query->have_posts() ) :
	// set up the category dropdown filter.
	nightingale_latest_posts_category_filter( $catcount, $categories, $catout );
	?>
	<div class="nhsuk-grid-row nhsuk-card-group">

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
	<nav class="nhsuk-pagination" role="navigation" aria-label="Pagination">
		<ul class="nhsuk-list nhsuk-pagination__list">
			<?php
			$postsorder = get_query_var( $namespace . 'order' ) ? get_query_var( $namespace . 'order' ) : 'desc';
			$newer      = __( 'View more recent posts', 'nightingale' );
			$older      = __( 'View older posts', 'nightingale' );
			if ( 'desc' === $postsorder ) {
				$prevtext = $newer;
				$nexttext = $older;
			} elseif ( 'asc' === $postsorder ) {
				$prevtext = $older;
				$nexttext = $newer;
			} else {
				$prevtext = '';
				$nexttext = '';
			}
			echo esc_html( get_query_var( $namespace . 'order' ) );
			$prevpage = (int) $archive_paged - 1;
			if ( ! is_single() && $the_query->max_num_pages > 1 && $prevpage > 0 ) {
				?>
				<li class="nhsuk-pagination-item--previous">
					<a class="nhsuk-pagination__link nhsuk-pagination__link--prev" href="<?php echo esc_html( previous_posts( false ) ); ?>">
						<span class="nhsuk-pagination__title"><?php esc_html_e( 'Previous', 'nightingale' ); ?></span>
						<span class="nhsuk-u-visually-hidden">:</span>
						<span class="nhsuk-pagination__page"><?php echo esc_html( $prevtext ); ?></span>
						<svg class="nhsuk-icon nhsuk-icon--arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
							<path d="M10.7 6.3c.4.4.4 1 0 1.4L7.4 11H19a1 1 0 0 1 0 2H7.4l3.3 3.3c.4.4.4 1 0 1.4a1 1 0 0 1-1.4 0l-5-5A1 1 0 0 1 4 12c0-.3.1-.5.3-.7l5-5a1 1 0 0 1 1.4 0Z"/>
						</svg>

					</a>
				</li>
				<?php
			}

			$nextpage = (int) $archive_paged + 1;
			if ( ! is_single() && ( $nextpage <= $the_query->max_num_pages ) && ( 1 !== $the_query->max_num_pages ) ) {
				?>
				<li class="nhsuk-pagination-item--next">
					<a class="nhsuk-pagination__link nhsuk-pagination__link--next" href="<?php echo esc_html( next_posts( $the_query->max_num_pages, false ) ); ?>">
						<span class="nhsuk-pagination__title"><?php esc_html_e( 'Next', 'nightingale' ); ?></span>
						<span class="nhsuk-u-visually-hidden">:</span>
						<span class="nhsuk-pagination__page"><?php echo esc_html( $nexttext ); ?></span>
						<svg class="nhsuk-icon nhsuk-icon--arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" focusable="false" aria-hidden="true">
							<path d="m14.7 6.3 5 5c.2.2.3.4.3.7 0 .3-.1.5-.3.7l-5 5a1 1 0 0 1-1.4-1.4l3.3-3.3H5a1 1 0 0 1 0-2h11.6l-3.3-3.3a1 1 0 1 1 1.4-1.4Z"/>
						</svg>
					</a>
				</li>
				<?php
			}
			?>
		</ul>
	</nav>
	<?php
endif;

/* Restore original Post Data */
wp_reset_postdata();

<?php
/**
 * Template part for displaying HTML sitemap
 *
 * @link      https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package   Nightingale
 * @copyright NHS Leadership Academy
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html
 * @author    Chris Witham <chris.witham@leadershipacademy.nhs.uk>
 * @since     2.2.0
 * @uses      template-parts/sitemap
 */

?>

	<h2>Sections</h2>
	<nav class="nhsuk-contents-list" role="navigation" aria-label="Sections in this sitemap">
		<h2 class="nhsuk-u-visually-hidden">Contents</h2>
		<ol class="nhsuk-contents-list__list">
			<li class="nhsuk-contents-list__item">
				<a class="nhsuk-contents-list__link" href="#pages">Pages</a>
			</li>
			<li class="nhsuk-contents-list__item">
				<a class="nhsuk-contents-list__link" href="#authors">Authors</a>
			</li>
			<li class="nhsuk-contents-list__item">
				<a class="nhsuk-contents-list__link" href="#posts">Posts</a>
			</li>
		</ol>
	</nav>

	<h2 id="pages">Pages</h2>
	<ul>
		<?php
		wp_list_pages(
			array(
				'exclude'  => '',
				'title_li' => '',
			)
		);
		?>
	</ul>

	<h2 id="authors">Authors</h2>
	<ul>
		<?php
		wp_list_authors(
			array(
				'exclude_admin' => false,
			)
		);
		?>
	</ul>

	<h2 id="posts">Posts by category</h2>
<?php
$catargs = array(
	'exclude'    => '',
	'hide_empty' => 'true',
);
$cats    = get_categories( $catargs );
foreach ( $cats as $catsingle ) {
	echo '<h3>' . esc_html( $catsingle->cat_name ) . '</h3>';
	echo '<ul>';
	$args  = array(
		'category'       => $catsingle->cat_ID,
		'posts_per_page' => - 1,
	);
	$query = new WP_Query( $args );
	while ( $query->have_posts() ) {
		$query->the_post();
		$category = get_the_category();
		if ( $category[0]->cat_ID === $catsingle->cat_ID ) {
			echo '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
		}
	}
	echo '</ul>';
}

<?php
/**
 * Template part for displaying HTML sitemap
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy
 * @license https://www.gnu.org/licenses/gpl-3.0.en.html
 * @author Chris Witham <chris.witham@leadershipacademy.nhs.uk>
 * @since 2.2.0
 * @uses template-parts/sitemap
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
wp_list_pages( array( 
  'exclude' => '',
  'title_li' => '',
) ); ?>
</ul>

<h2 id="authors">Authors</h2>
<ul>
<?php wp_list_authors( array(
  'exclude_admin' => false
) ); ?>
</ul>

<h2 id="posts">Posts by category</h2>
<?php 
$cats = get_categories('exclude=');
foreach ($cats as $cat) {
  echo '<h3>' . $cat->cat_name . '</h3>';
  echo '<ul>';
  query_posts('posts_per_page=-1&cat=' . $cat->cat_ID);
  while(have_posts()) {
    the_post();
    $category = get_the_category();
    if ($category[0]->cat_ID == $cat->cat_ID) {
      echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>'; 
    }
  }
  echo '</ul>';
}

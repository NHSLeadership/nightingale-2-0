<?php
/**
* Generate breadcrumbs
*/
function nightingale_breadcrumb() {


    // Check current page is NOT the home page
    if (!is_front_page()) {
      ?>
      <nav class="nhsuk-breadcrumb" aria-label="Breadcrumb">
          <div class="nhsuk-width-container">
        <ol class="nhsuk-breadcrumb__list">

          <!-- Start breadcrumb with link to home page -->
          <li class="nhsuk-breadcrumb__item"><a href="\"  class="nhsuk-breadcrumb__link">Home</a></li>

          <!-- Check if the current page is a category, an archive or a single page. If so link to category or archive -->
          <?php
          if (is_category() ){
            echo '<li class="nhsuk-breadcrumb__item"><a href="';
            $perma_cat = get_post_meta(get_the_ID(), '_category_permalink', true);
            if ( $perma_cat != null ) {
              $cat_id = $perma_cat['category'];
              $category = get_category($cat_id);
            }
            else {
              $categories = get_the_category();
              $category = $categories[0];
            }
            $category_link = get_category_link($category);
            $category_name = $category->name;
            echo $category_link.'" class="nhsuk-breadcrumb__link">'.$category_name.'</a></li>';
          }

					// If this is a child page, add links to its ancestors
					if( is_page() && get_post_field( 'post_parent' ) ) {
						$parents = get_post_ancestors( get_the_id() );
						foreach ( array_reverse($parents) as $parent ) {
							echo '<li class="nhsuk-breadcrumb__item"><a class="nhsuk-breadcrumb__link" href =' . get_permalink( $parent ) . '>' . get_the_title( $parent ) . '</a></li>';
						}
					}

					// If this is search results page, show search term
					if ( is_search() ) {
						echo '<li class="nhsuk-breadcrumb__item">Search Results</li>';
						echo '<li class="nhsuk-breadcrumb__item">' . get_search_query() . '</li>';
					}
					elseif( is_archive() ) {
                        echo '<li class="nhsuk-breadcrumb__item">' . get_the_archive_title() . '</li>';
                    }
					else {
						if (($post_type = get_post_type()) && $post_type !== 'page') {
							$type = get_post_type_object($post_type);
							echo '<li class="nhsuk-breadcrumb__item">';
							echo $type->has_archive ? '<a class="nhsuk-breadcrumb__link" href =' . get_post_type_archive_link($post_type) . '>' : '';
                            echo $type->label;
                            echo $type->has_archive ? '</a>' : '';
                            echo '</li>';
						}
					?>
	          <!-- Display title current post/page as last item in breadcrumb -->
	          <li class="nhsuk-breadcrumb__item"><?php echo the_title(); ?></li>
					<?php
					}
					?>
        </ol>
          </div>
      </nav>
      <?php
    }
  }



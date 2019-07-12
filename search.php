<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Nightingale_2.0
 */

get_header();
?>

    <div id="primary" class=" nhsuk-grid-row">
        <div class="nhsuk-grid-column-full">

                            <?php if (have_posts()) : ?>

                                <header class="entry-header">
                                    <h1 class="entry-title">
                                        <?php
                                        /* translators: %s: search query. */
                                        printf(esc_html__('Search Results for: %s', 'nightingale-2-0'), '<span>' . get_search_query() . '</span>');
                                        ?>
                                    </h1>
                                </header><!-- .page-header -->

                                <?php
                                /* Start the Loop */
                                while (have_posts()) :
                                    the_post();

                                    /**
                                     * Run the loop for the search to output the results.
                                     * If you want to overload this in a child theme then include a file
                                     * called content-search.php and that will be used instead.
                                     */
                                    get_template_part('template-parts/content', 'search');

                                endwhile;

                                the_posts_navigation();

                            else :

                                get_template_part('template-parts/content', 'none');

                            endif;
                            ?>

            </div>
    </div><!-- #primary -->

<?php
get_footer();

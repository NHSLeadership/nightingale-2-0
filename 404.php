<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Nightingale_2.0
 */

get_header();
?>
    <section class="nhsuk-hero nhsuk-hero--image nhsuk-hero--image-description"
             style="background-image: url('<?php echo get_theme_file_uri('/assets/404.png'); ?>')">
        <div class="nhsuk-hero__overlay">
            <div class="nhsuk-width-container nhsuk-hero--border">
                <div class="nhsuk-grid-row">
                    <div class="nhsuk-grid-column-two-thirds">
                        <div class="nhsuk-hero-content">
                            <h1 class="nhsuk-u-margin-bottom-3">Page not found</h1>
                            <p class="nhsuk-body-l nhsuk-u-margin-bottom-0"><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'nightingale-2-0'); ?></p>
                            <span class="nhsuk-hero__arrow" aria-hidden="true"></span></div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <p></p>
    <div id="primary" class="nhsuk-width-container">
        <main id="maincontent" class="nhsuk-main-wrapper">
            <div class="nhsuk-grid-row">
                <div class="nhsuk-grid-row">
                    <div class="nhsuk-grid-column-full-width">
                        <?php
                                $raw_search = $_SERVER['REQUEST_URI'];

                                $replacement = str_replace( '-', ' ', $raw_search );

                                if( $replacement ) {
                                    $query = $replacement;
                                }

                        ?>

                        <section class="error-404 not-found">

                            <div class="page-content">
                                <?php
                                get_search_form();

                                the_widget('WP_Widget_Recent_Posts');
                                ?>

                                <div class="widget widget_categories">
                                    <h2 class="widget-title"><?php esc_html_e('Most Used Categories', 'nightingale-2-0'); ?></h2>
                                    <ul>
                                        <?php
                                        wp_list_categories(array(
                                            'orderby' => 'count',
                                            'order' => 'DESC',
                                            'show_count' => 1,
                                            'title_li' => '',
                                            'number' => 10,
                                        ));
                                        ?>
                                    </ul>
                                </div><!-- .widget -->

                                <?php
                                /* translators: %1$s: smiley */
                                $nightingale_2_0_archive_content = '<p>' . sprintf(esc_html__('Try looking in the monthly archives. %1$s', 'nightingale-2-0'), convert_smilies(':)')) . '</p>';
                                the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$nightingale_2_0_archive_content");

                                the_widget('WP_Widget_Tag_Cloud');
                                ?>

                            </div><!-- .page-content -->
                        </section><!-- .error-404 -->


                    </div>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();

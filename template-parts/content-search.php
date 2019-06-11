<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nightingale_2.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="nhsuk-panel-with-label">

        <?php the_title(sprintf('<h3 class="nhsuk-panel-with-label__label"><a href="%s" rel="bookmark">', esc_url(get_permalink())
        ), '</a></h3>'); ?>
        <?php if ('post' === get_post_type()) : ?>
            <div class="entry-meta">
                <?php
                nightingale_2_0_posted_on();
                nightingale_2_0_posted_by();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
        <div class="nhsuk-grid-row">
            <div class="nhsuk-grid-column-one-third">
                <?php nightingale_2_0_post_thumbnail(); ?>
            </div>
            <div class="nhsuk-grid-column-two-thirds">


                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
                <footer class="entry-footer">
                    <?php nightingale_2_0_entry_footer(); ?>
                </footer><!-- .entry-footer -->
            </div>

        </div>
</article><!-- #post-<?php the_ID(); ?> -->

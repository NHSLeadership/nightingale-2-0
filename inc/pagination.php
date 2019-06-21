<?php
/**
* Replace css classes in standard navigation with Nightingale classes
*/
/*function nightingale_pagination()
{
$pagination = get_the_posts_pagination( array(
  'type'               => 'list',
  'screen_reader_text' => 'Other Posts'
));
    $pagination = str_replace("<nav class=\"navigation pagination\" role=\"navigation\">","<nav
    class=\"nhsuk-pagination\" role=\"navigation\" aria-label=\"Pagination\">",
        $pagination);

    $pagination = str_replace("<div class=\"nav-links\">","",$pagination);
    $pagination = str_replace("</div>","",$pagination);
$pagination = str_replace("<ul class='page-numbers'>","<ul class=\"nhsuk-list nhsuk-pagination__list\">",$pagination);
$pagination = str_replace("<li>","<li class=\"nhsuk-pagination-item\">",$pagination);
$pagination = str_replace("<a class='page-numbers'","<a class='nhsuk-pagination__link nhsuk-pagination__link'",$pagination);
$pagination = str_replace('<a class="prev page-numbers"','<a class="nhsuk-pagination__link nhsuk-pagination__link--prev"',$pagination);
$pagination = str_replace('<a class="next page-numbers"','<a class="nhsuk-pagination__link nhsuk-pagination__link--next"',$pagination);
echo $pagination;
}*/


if ( ! function_exists( 'nightingale_pagination' ) ) :
    /**
     * Display navigation to next/previous set of posts when applicable.
     *
     * Unashamedly borrowed from the twentyfouteen theme
     * @since Twenty Fourteen 1.0
     *
     * @global WP_Query   $wp_query   WordPress Query object.
     * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
     */
    function nightingale_pagination() {
        global $wp_query, $wp_rewrite;

        // Don't print empty markup if there's only one page.
        if ( $wp_query->max_num_pages < 2 ) {
            return;
        }

        $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
        $pagenum_link = html_entity_decode( get_pagenum_link() );
        $query_args   = array();
        $url_parts    = explode( '?', $pagenum_link );

        if ( isset( $url_parts[1] ) ) {
            wp_parse_str( $url_parts[1], $query_args );
        }

        $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
        $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

        $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
        $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

        // Set up paginated links.
        $links = nightingale_paginate_links(
            array(
                'base'      => $pagenum_link,
                'format'    => $format,
                'total'     => $wp_query->max_num_pages,
                'current'   => $paged,
                'mid_size'  => 1,
                'add_args'  => array_map( 'urlencode', $query_args ),
                'prev_text' => __( 'Previous', 'nightingale-2-0' ),
                'next_text' => __( 'Next', 'nightingale-2-0' ),
            )
        );

        if ( $links ) :

            ?>
            <nav class="nhsuk-pagination" role="navigation" aria-label="Pagination">
                <ul class="nhsuk-list nhsuk-pagination__list">
                    <?php echo $links; ?>

                </ul>
            </nav>
        <?php
        endif;
    }
endif;


function nightingale_paginate_links( $args = '' ) {
    global $wp_query, $wp_rewrite;

    // Setting up default values based on the current URL.
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $url_parts    = explode( '?', $pagenum_link );

    // Get max pages and current page out of the current query, if available.
    $total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
    $current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

    // Append the format placeholder to the base URL.
    $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

    // URL base depends on permalink settings.
    $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

    $defaults = array(
        'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
        'format'             => $format, // ?page=%#% : %#% is replaced by the page number
        'total'              => $total,
        'current'            => $current,
        'aria_current'       => 'page',
        'show_all'           => false,
        'prev_next'          => true,
        'prev_text'          => __( 'Previous' ),
        'next_text'          => __( 'Next' ),
        'end_size'           => 1,
        'mid_size'           => 2,
        'type'               => 'plain',
        'add_args'           => array(), // array of query args to add
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => '',
    );

    $args = wp_parse_args( $args, $defaults );

    if ( ! is_array( $args['add_args'] ) ) {
        $args['add_args'] = array();
    }

    // Merge additional query vars found in the original URL into 'add_args' array.
    if ( isset( $url_parts[1] ) ) {
        // Find the format argument.
        $format       = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
        $format_query = isset( $format[1] ) ? $format[1] : '';
        wp_parse_str( $format_query, $format_args );

        // Find the query args of the requested URL.
        wp_parse_str( $url_parts[1], $url_query_args );

        // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
        foreach ( $format_args as $format_arg => $format_arg_value ) {
            unset( $url_query_args[ $format_arg ] );
        }

        $args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
    }

    // Who knows what else people pass in $args
    $total = (int) $args['total'];
    if ( $total < 2 ) {
        return;
    }
    $current  = (int) $args['current'];
    $end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.
    if ( $end_size < 1 ) {
        $end_size = 1;
    }
    $mid_size = (int) $args['mid_size'];
    if ( $mid_size < 0 ) {
        $mid_size = 2;
    }
    $add_args   = $args['add_args'];
    $r          = '';
    $page_links = array();
    $dots       = false;

    if ( $args['prev_next'] && $current && 1 < $current ) :
        $link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
        $link = str_replace( '%#%', $current - 1, $link );
        if ( $add_args ) {
            $link = add_query_arg( $add_args, $link );
        }
        $link .= $args['add_fragment'];

        /**
         * Filters the paginated links for the given archive pages.
         *
         * @since 3.0.0
         *
         * @param string $link The paginated link URL.
         */
        $page_links[] = '<li class="nhsuk-pagination-item--previous">
      <a class="nhsuk-pagination__link nhsuk-pagination__link--prev" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '"><span class="nhsuk-pagination__title">' . $args['prev_text'] . '</span><svg class="nhsuk-icon nhsuk-icon__arrow-left" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M4.1 12.3l2.7 3c.2.2.5.2.7 0 .1-.1.1-.2.1-.3v-2h11c.6 0 1-.4 1-1s-.4-1-1-1h-11V9c0-.2-.1-.4-.3-.5h-.2c-.1 0-.3.1-.4.2l-2.7 3c0 .2 0 .4.1.6z"></path>
        </svg>
      </a>
    </li>';
    endif;
    for ( $n = 1; $n <= $total; $n++ ) :
        if ( $n == $current ) :
            $page_links[] = "<li class=\"nhsuk-pagination-item\"><span aria-current='" . esc_attr( $args['aria_current'] ) . "' class='nhsuk-pagination__title current'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . '</span></li>';
            $dots         = true;
        else :
            if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                $link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
                $link = str_replace( '%#%', $n, $link );
                if ( $add_args ) {
                    $link = add_query_arg( $add_args, $link );
                }
                $link .= $args['add_fragment'];

                /** This filter is documented in wp-includes/general-template.php */
                $page_links[] = "<li class=\"nhsuk-pagination-item\">
      <a class=\"nhsuk-pagination__link nhsuk-pagination__link\" href=" . esc_url( apply_filters( 'paginate_links', $link ) ) . "><span class=\"nhsuk-pagination__title\">
      " . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . '</a></li>';
                $dots         = true;
            elseif ( $dots && ! $args['show_all'] ) :
                $page_links[] = '<li class="nhsuk-pagination-item"><span class="nhsuk-pagination__title dots">' . __( '&hellip;'
                    ) . '</span></li>';
                $dots         = false;
            endif;
        endif;
    endfor;
    if ( $args['prev_next'] && $current && $current < $total ) :
        $link = str_replace( '%_%', $args['format'], $args['base'] );
        $link = str_replace( '%#%', $current + 1, $link );
        if ( $add_args ) {
            $link = add_query_arg( $add_args, $link );
        }
        $link .= $args['add_fragment'];

        /** This filter is documented in wp-includes/general-template.php */
        $page_links[] = '<li class="nhsuk-pagination-item--next">
      <a class="nhsuk-pagination__link nhsuk-pagination__link--next" href=' . esc_url( apply_filters( 'paginate_links', $link ) ) . '><span class="nhsuk-pagination__title">' . $args['next_text'] . '</span>
        <svg class="nhsuk-icon nhsuk-icon__arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
          <path d="M19.6 11.66l-2.73-3A.51.51 0 0 0 16 9v2H5a1 1 0 0 0 0 2h11v2a.5.5 0 0 0 .32.46.39.39 0 0 0 .18 0 .52.52 0 0 0 .37-.16l2.73-3a.5.5 0 0 0 0-.64z"></path>
        </svg>
      </a>
    </li>';
    endif;
    switch ( $args['type'] ) {
        case 'array':
            return $page_links;

        case 'list':
            $r .= "<ul class='page-numbers'>\n\t<li>";
            $r .= join( "</li>\n\t<li>", $page_links );
            $r .= "</li>\n</ul>\n";
            break;

        default:
            $r = join( "\n", $page_links );
            break;
    }
    return $r;
}

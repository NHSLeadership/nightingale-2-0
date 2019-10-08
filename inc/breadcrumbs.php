<?php
/**
 * Generate breadcrumbs
 *
 * Get path to current page and leave breacrumb trail for users to navigate back up the decision tree
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

/**
 *  Create the breadcrumb
 */
function nightingale_category_parents( $id, $link = false, $separator = '', $nicename = false, $visited = array(), $iscrumb = false ) {
	$chain  = '';
	$parent = get_term( $id, 'category' );
	if ( is_wp_error( $parent ) ) {
		return $parent;
	}
	if ( $nicename ) {
		$name = $parent->slug;
	} else {
		$name = $parent->name;
	}
	if ( $parent->parent && ( $parent->parent != $parent->term_id ) && ! in_array( $parent->parent, $visited ) ) {
		$visited[] = $parent->parent;
		$chain     .= get_category_parents( $parent->parent, $link, $separator, $nicename, $visited, $iscrumb );
	}
	if ( $iscrumb ) {
		$chain .= '<li class="nhsuk-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_category_link( $parent->term_id ) ) . '"><span itemprop="name">' . $name . '</span></a></li>' . $separator;
	} elseif ( $link && ! $iscrumb ) {
		$chain .= '<li class="nhsuk-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_category_link( $parent->term_id ) ) . '"><span itemprop=""name">' . $name . '</span></a>' . $separator . '</li>';
	} else {
		$chain .= '<li class="nhsuk-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">'.$name . $separator . '</span></li>';
	}

	return $chain;
}

function nightingale_breadcrumb() {
	global $wp_query;
	if (!is_home()) {
	    ?>
        <nav class="nhsuk-breadcrumb" aria-label="Breadcrumb">
            <div class="nhsuk-width-container">
                <ol class="nhsuk-breadcrumb__list" typeof="BreadcrumbList" vocab="http://schema.org/"><?php
                    // Adding the Home Page  ?>
                    <li class="nhsuk-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url( home_url() ); ?>"> <span itemprop="name">Home</span></a>
                    </li><?php
                    if ( ! is_front_page() ) {
                        // Check for categories, archives, search page, single posts, pages, the 404 page, and attachments
                        if ( is_category() ) {
                            $cat_obj   = $wp_query->get_queried_object();
                            $thisCat   = get_category( $cat_obj->term_id );
                            $parentCat = get_category( $thisCat->parent );
                            if ( $thisCat->parent != 0 ) {
                                $cat_parents = nightingale_category_parents( $parentCat, true, '', false, array(), true );
                            }
                            if ( $thisCat->parent != 0 && ! is_wp_error( $cat_parents ) ) {
                                echo $cat_parents;
                            }
                            echo '<li class="nhsuk-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="' . get_category_link( $thisCat ) . '"><span itemprop="name">' . single_cat_title( '', false ) . '</span></a></li>';
                        } elseif ( is_archive() && ! is_category() ) { ?>
                            <li class="nhsuk-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php _e( 'Archives', 'text-domain' ); ?></span></li><?php
                        } elseif ( is_search() ) { ?>
                            <li class="nhsuk-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php _e( 'Search Results', 'text-domain' ); ?></span></li><?php
                        } elseif ( is_404() ) { ?>
                            <li class="nhsuk-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php _e( '404 Not Found', 'text-domain' ); ?></span></li><?php
                        } elseif ( is_singular( 'post' ) ) {
                            $category    = get_the_category();
                            $category_id = get_cat_ID( $category[0]->cat_name );
                            $cat_parents = nightingale_category_parents( $category_id, true, '', false, array(), true );
                            if ( ! is_wp_error( $cat_parents ) ) {
                                echo $cat_parents;
                            }
                        } elseif ( is_singular( 'attachment' ) ) { ?>
                            <li class="nhsuk-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">
                            <?php
                            the_title(); ?></span>
                            </li><?php
                        } elseif ( is_page() ) {
                            $post = $wp_query->get_queried_object();
                            if ( $post->post_parent == 0 ) {
                            } else {
                                $title     = the_title( '', '', false );
                                $ancestors = array_reverse( get_post_ancestors( $post->ID ) );
                                array_push( $ancestors, $post->ID );
                                foreach ( $ancestors as $ancestor ) {
                                    if ( $ancestor != end( $ancestors ) ) { ?>
                                        <li class="nhsuk-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                        <a itemprop="item" href="<?php echo esc_url( get_permalink( $ancestor ) ); ?>">
                                            <span itemprop="name"><?php echo strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ); ?></span>
                                        </a>
                                        </li><?php
                                    } else { ?>
                                        <li class="nhsuk-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">
                                            <?php echo strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ); ?></span>
                                        </li><?php
                                    }
                                }
                            }
                        } ?>
                        <li class="nhsuk-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name"><?php echo esc_html( the_title() ); ?></span></li> <?
                    } ?>
                </ol>
            </div>
        </nav><?php
    }
}

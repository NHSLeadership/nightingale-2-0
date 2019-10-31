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
		$chain .= '<li class="nhsuk-breadcrumb__item"><a itemprop="item" href="' . esc_url( get_category_link( $parent->term_id ) ) . '">' . $name . '</a></li>' . $separator;
	} elseif ( $link && ! $iscrumb ) {
		$chain .= '<li class="nhsuk-breadcrumb__item"><a itemprop="item" href="' . esc_url( get_category_link( $parent->term_id ) ) . '">' . $name . '</a>' . $separator . '</li>';
	} else {
		$chain .= '<li class="nhsuk-breadcrumb__item">' . $name . $separator . '</li>';
	}

	return $chain;
}

function nightingale_uncanny_breadcrumb_check() {
	if(in_array('uncanny-learndash-toolkit/uncanny-learndash-toolkit.php', apply_filters('active_plugins', get_option('active_plugins')))){
	    $uo_active_classes = get_option( 'uncanny_toolkit_active_classes', 0 );
	    if ( 0 !== $uo_active_classes ) {
		    if ( ! key_exists( 'uncanny_learndash_toolkit\Breadcrumbs', $uo_active_classes ) ) {
			    return false; // plugin is active but breadcrumbs aren't turned on
		    }
	    }
	    $classes = get_body_class();
	    $matches = preg_grep("/sfwd/", $classes);
	    if ( count($matches) > 0 ) {
	        return true; // this is a LearnDash page, the Uncanny Toolkit is installed and the breadcrumb is active
        } else {
	        return false; // this isn't a Learndash page
        }
    } else {
	    return false; // plugin isn't active
    }
}

function nightingale_breadcrumb() {
	global $wp_query;
	if ( ! is_home() ) {

		if ( ! is_front_page() ) {
			$back_one_level = array( esc_url( home_url() ), __( 'Home', 'nightingale' ) );
			?>
            <nav class="nhsuk-breadcrumb" aria-label="Breadcrumb">
            <div class="nhsuk-width-container">
                <?php
                if ( true === nightingale_uncanny_breadcrumb_check() ) {
	                echo uo_breadcrumbs();
	                ?>

                    <p class="nhsuk-breadcrumb__back">
                        <a class="nhsuk-breadcrumb__backlink" href="<?php echo $back_one_level[0]; ?>">
			                <?php echo __( 'Back to ', 'nightingale' ) . $back_one_level[1]; ?>
                        </a>
                    </p>
                    <style>
                        .ld-breadcrumbs {
                            position: relative;
                        }
                        .ld-breadcrumbs-segments {
                            display: none !important;
                        }
                        .ld-status {
                            position: absolute;
                            right: 0;
                        }
                    </style>
                    <?php
                } else {
                ?>
                <ol class="nhsuk-breadcrumb__list">
                    <li class="nhsuk-breadcrumb__item">
                        <a href="<?php echo esc_url( home_url() ); ?>">
							<?php echo __( 'Home', 'nightingale' ); ?>
                        </a>
                    </li><?php
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
						echo '<li class="nhsuk-breadcrumb__item"><a  href="' . get_category_link( $thisCat ) . '">' . single_cat_title( '', false ) . '</a></li>';
					} elseif ( is_archive() && ! is_category() ) { ?>
                        <li class="nhsuk-breadcrumb__item"><?php _e( 'Archives', 'text-domain' ); ?><?php
					} elseif ( is_search() ) { ?>
                        <li class="nhsuk-breadcrumb__item"><?php _e( 'Search Results', 'text-domain' ); ?></li><?php
					} elseif ( is_404() ) { ?>
                        <li class="nhsuk-breadcrumb__item"><?php _e( '404 Not Found', 'text-domain' ); ?></li><?php
					} elseif ( is_singular( 'post' ) ) {
						$category    = get_the_category();
						$category_id = get_cat_ID( $category[0]->cat_name );
						$cat_parents = nightingale_category_parents( $category_id, true, '', false, array(), true );
						if ( ! is_wp_error( $cat_parents ) ) {
							echo $cat_parents;
						}

					} elseif ( is_singular( 'attachment' ) ) { ?>
                        <li class="nhsuk-breadcrumb__item">
						<?php
						the_title(); ?>
                        </li><?php
					} elseif ( is_page() ) {
						$post = $wp_query->get_queried_object();
						if ( $post->post_parent == 0 ) {
						} else {
							$title     = the_title( '', '', false );
							$ancestors = array_reverse( get_post_ancestors( $post->ID ) );
							array_push( $ancestors, $post->ID );
							$home_page = get_option( 'page_on_front' );
							foreach ( $ancestors as $ancestor ) {
								if ( ( $ancestor != end( $ancestors ) ) && ( ( $home_page != $ancestor ) ) ) {
									?>
                                    <li class="nhsuk-breadcrumb__item">
                                    <a href="<?php echo esc_url( get_permalink( $ancestor ) ); ?>">
										<?php echo strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) ); ?></span>
                                    </a>
                                    </li><?php
									$back_one_level = array(
										esc_url( get_permalink( $ancestor ) ),
										strip_tags( apply_filters( 'single_post_title', get_the_title( $ancestor ) ) )
									);
								}
							}
							$parent         = $post->post_parent;
							$back_one_level = array( get_permalink( $parent ), get_the_title( $parent ) );

						}
					} ?>
                    <li class="nhsuk-breadcrumb__item"><?php echo esc_html( the_title() ); ?></li> <?php


					?>
                </ol>
                <p class="nhsuk-breadcrumb__back">
                    <a class="nhsuk-breadcrumb__backlink" href="<?php echo $back_one_level[0]; ?>">
						<?php echo __( 'Back to ', 'nightingale' ) . $back_one_level[1]; ?>
                    </a>
                </p>
				<?php } // end of LearnDash / Uncanny Toolkit conditional ?>
            </div>
            </nav><?php
		}
	}
}

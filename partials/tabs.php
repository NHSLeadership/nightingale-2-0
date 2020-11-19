<?php
/**
 * The Rendering of the tabbed content layout partial
 *
 * This is the template that displays tabbed navigation for sub sections.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.0 19th November 2020
 */

if( $page_tabbed = get_post_meta( get_the_id(), 'tabbed-page', true ) ) {
	if ( 'on' === $page_tabbed ) {
		$args = array(
			'post_type'   => 'page',
			'post_parent' => $post->ID,
			'depth'       => 1,
			'post_status' => 'publish',
			'meta_query'  => array(
				array(
					'key'   => 'tabbed-page',
					'value' => 'on',
				),
			),
		);
		if ( ! empty( $post->post_parent ) || ! empty( get_children( $args ) ) ) {

			// Start first "Overview" link to parent page
			$link = '<li class="nhsuk-bordered-tabs-item';
			$altlink = '<li class="nhsuk-contents-list__item"';

			// Only show siblings if current page has no parent or parent doesn't have tabbed navigation
			$parent_tab = get_post_meta( $post->post_parent, 'tabbed-page', true );
			if ( empty( $post->post_parent ) || ( $parent_tab != 'on' ) ) {
				// On first arrival at the parent page, the Overview link is current (and therefore inactive)
				// and all the other links are to child pages...
				$link        .= '  nhsuk-bordered-tabs-item-active';
				$altlink .= ' aria-current="page"';

				$tabname = get_post_meta( $post->ID, 'tabname', true );
				if ( $tabname ) {
					$tabtitle = $tabname;
				} else {
					$tabtitle = get_the_title( $post->ID );
				}
				$link .= '">' . $tabtitle . '</li>';
				$altlink .= '><span class="nhsuk-contents-list__current">' . $tabtitle . '</span></li>';
				$section_title = get_the_title( $post->ID );
				$post_parent = $post->ID;
			} else {
				// ...but, once a child page is opened, the Overview link should point to the parent page
				// and all the other links to sibling pages
				$post_parent = $post->post_parent;
				$tabname = get_post_meta( $post_parent, 'tabname', true );
				if ( $tabname ) {
					$tabtitle = $tabname;
				} else {
					$tabtitle = get_the_title( $post_parent );
				}
				$link .= '"><a class="nhsuk-bordered-tabs-link';
$altlink .= '"><a class="nhsuk-contents-list__link';
				// Finish building and displaying Overview tab
				$link          .= '" href="';
				$altlink .= '" href="' . get_permalink( $post_parent ) .'">' . $tabtitle . '</a></li>';
				$link          .= get_permalink( $post_parent );
				$section_title = get_the_title( $post_parent );
				$link          .= '">';
				$link          .= $tabtitle;
				$link          .= '</a></li>';
			}
			$tabsize = strlen( $tabtitle ); // start a count of characters in the tabs. If we get too silly with size, revert to contents display
            $tabsize += 12;
			$menu          = $link;
			$altmenu = $altlink;

			// Get all child/sibling pages (depending on whether this is a parent or child page) that use this tabbed page template
			$args     = array(
				'post_type'   => 'page',
				'post_parent' => $post_parent,
				'orderby'     => 'menu_order',
				'order'       => 'ASC',
				'depth'       => 1,
				'post_status' => 'publish',
				'meta_query'  => array(
					array(
						'key'   => 'tabbed-page',
						'value' => 'on',
					),
				),
			);
			$children = new WP_Query( $args );

			// Define tab icons (based on image sprite definitions in Nightingale)
			$icons = array( "user", "menu", "info", "pencil", "currency", "speaker" );
			// Display child/sibling tabs
			while ( $children->have_posts() ) {
				$children->the_post();
				// Build tab
				$link = '<li class="nhsuk-bordered-tabs-item ';
				$altlink = '<li class="nhsuk-contents-list__item" ';
				$tabname = get_post_meta( $post->ID, 'tabname', true );
				if ( $tabname ) {
					$tabtitle = $tabname;
				} else {
					$tabtitle = get_the_title( $post->ID );
				}
				if ( is_page( $post->ID ) ) {
					$link .= 'nhsuk-bordered-tabs-item-active';
					$link .= '">' . $tabtitle . '</li>';
					$altlink .= 'aria-current="page"><span class="nhsuk-contents-list__current">' . $tabtitle . '</span></li>';
				} else {
					$link .= '"><a class="nhsuk-bordered-tabs-link';
					$link .= '" href="';
					$link .= get_permalink( $post );
					$link .= '">';
					$link .= $tabtitle;
					$link .= '</a></li>';
					$altlink .= '><a class="nhsuk-contents-list__link" href="' . get_permalink( $post ) . '">' . $tabtitle . '</a></li>';
				}
				$tabsize += strlen( $tabtitle );
				$tabsize += 12;
				// If number of tabs exceeds number of icons, reset to start of icon array (icons will repeat from the start)
				if ( ! next( $icons ) ) {
					reset( $icons );
				}
				// Display tab
				$menu .= $link;
				$altmenu .= $altlink;
			}
			wp_reset_query();

		}
		?>

        <div class="nhsuk-full-width-container">
            <section class="nhsuk-hero" id="nhsuk-tabbed-title">

                <div class="nhsuk-width-container">
                    <div class="nhsuk-grid-row">
                        <div class="nhsuk-grid-column-two-thirds">
                            <div class="nhsuk-hero__wrapper--tabs">
                                <h1 class="nhsuk-u-margin-bottom-3 nhsuk-heading-l entry_title"><?php echo $section_title; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
		<?php echo nightingale_breadcrumb(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <div class="nhsuk-full-width-container">
            <?php
            if ( $tabsize > 185 ) { // if we have too much content for some nice tabs, show as contents list instead.
                ?>
            <div class="nhsuk-width-container">
                <nav class="nhsuk-contents-list" role="navigation" aria-label="Pages in this guide">
                    <h3>Pages in this section:</h3>
                    <ol class="nhsuk-contents-list__list">
	                    <?php echo $altmenu; ?>
                    </ol>
                </nav>
            </div>
                <?php
            } else {
	            ?>
                <div class="nhsuk-bordered-tabs-container">
                    <div class="nhsuk-width-container">
                        <ul class="nhsuk-bordered-tabs">
				            <?php echo $menu; ?>
                        </ul>
                    </div>
                </div>
	            <?php
            }
            ?>
        </div>
		<?php
	}
}
?>

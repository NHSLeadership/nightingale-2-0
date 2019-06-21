<?php
/**
 * Template part for displaying navigation tabs
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package nightingale-wp
 */

// Check that page is a child (has a parent) or is a parent (has child pages)
$args = array(
    'post_type' => 'page',
    'post_parent' => $post->ID,
    'depth' => 1,
    'post_status' => 'publish',
    'meta_query' => array(
        array(
            'key' => '_wp_page_template',
            'value' => 'page-tabbed.php',
        ),
    ),
);
if (!empty($post->post_parent) || !empty(get_children($args))) {
    /*
     * <nav class="nhsuk-contents-list" role="navigation" aria-label="Pages in this guide">
      <h2 class="nhsuk-u-visually-hidden">Contents</h2>
      <ol class="nhsuk-contents-list__list">
            <li class="nhsuk-contents-list__item" aria-current="page">
              <span class="nhsuk-contents-list__current">What is AMD?</span>
            </li>
            <li class="nhsuk-contents-list__item">
              <a class="nhsuk-contents-list__link" href="https://www.nhs.uk/conditions/age-related-macular-degeneration-amd/symptoms/">Symptoms</a>
            </li>
            <li class="nhsuk-contents-list__item">
              <a class="nhsuk-contents-list__link" href="https://www.nhs.uk/conditions/age-related-macular-degeneration-amd/getting-diagnosed/">Getting diagnosed</a>
            </li>
            <li class="nhsuk-contents-list__item">
              <a class="nhsuk-contents-list__link" href="https://www.nhs.uk/conditions/age-related-macular-degeneration-amd/treatment/">Treatments</a>
            </li>
            <li class="nhsuk-contents-list__item">
              <a class="nhsuk-contents-list__link" href="https://www.nhs.uk/conditions/age-related-macular-degeneration-amd/living-with-amd/">Living with AMD</a>
            </li>
      </ol>
    </nav>

    <div class="nhsuk-list-panel">
  <h2 class="nhsuk-list-panel__label" id="A">A</h2>
  <ul class="nhsuk-list-panel__list nhsuk-list-panel__list--with-label">
    <li class="nhsuk-list-panel__item">
      <a class="nhsuk-list-panel__link" href="/conditions/abdominal-aortic-aneurysm/">AAA</a>
    </li>
    <li class="nhsuk-list-panel__item">
      <a class="nhsuk-list-panel__link" href="/conditions/abdominal-aortic-aneurysm/">Abdominal aortic aneurysm</a>
    </li>
    <li class="nhsuk-list-panel__item">
      <a class="nhsuk-list-panel__link" href="/conditions/abscess/">Abscess</a>
    </li>
  </ul>
  <div class="nhsuk-back-to-top">
    <a class="nhsuk-back-to-top__link" href="#nhsuk-nav-a-z">
      <svg class="nhsuk-icon nhsuk-icon__arrow-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M19.6 11.66l-2.73-3A.51.51 0 0 0 16 9v2H5a1 1 0 0 0 0 2h11v2a.5.5 0 0 0 .32.46.39.39 0 0 0 .18 0 .52.52 0 0 0 .37-.16l2.73-3a.5.5 0 0 0 0-.64z"></path>
      </svg>
      Back to top
    </a>
  </div>
</div>
     */


    // Start first "Overview" link to parent page
    $link = '<li class="nhsuk-list-panel__item"';

    // Only show siblings if current page has no parent or parent doesn't have tabbed navigation
    $parent_template = get_post_meta($post->post_parent, '_wp_page_template', true);
    if (empty($post->post_parent) || ($parent_template != 'page-tabbed.php')) {
        // On first arrival at the parent page, the Overview link is current (and therefore inactive)
        // and all the other links are to child pages...
        $link .= '  aria-current="page"><a class="nhsuk-list-panel__link " ';
        $post_parent = $post->ID;
    } else {
        // ...but, once a child page is opened, the Overview link should point to the parent page
        // and all the other links to sibling pages
        $post_parent = $post->post_parent;
        $link .= '><a class="nhsuk-list-panel__link ';
    }

    // Finish building and displaying Overview tab
    $link .= '" href="';
    $link .= get_permalink($post_parent);
    $link .= '">';
    $link .= get_the_title($post_parent);
    $link .= '</a>';
    $link .= '</li>';
    // Start unordered list
    echo '<div class="nhsuk-list-panel nhsuk-grid-column-one-third nhsuk-nav-minisite__menu">';
    echo '<nav class="nhsuk-contents-list" role = "navigation" aria - label = "Pages in this section" >
  <h2 class="nhsuk-list-panel__label" > ' .
        get_the_title($post_parent) . ': </h2 > <ul class="nhsuk-list-panel__list nhsuk-list-panel__list--with-label" >';
    echo $link;

    // Get all child/sibling pages (depending on whether this is a parent or child page) that use this tabbed page template
    $args = array(
        'post_type' => 'page',
        'post_parent' => $post_parent,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'depth' => 1,
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_wp_page_template',
                'value' => 'page-tabbed.php',
            ),
        ),
    );
    $children = new WP_Query($args);

    // Define tab icons (based on image sprite definitions in Nightingale)
    $icons = array("user", "menu", "info", "pencil", "currency", "speaker");

    // Display child/sibling tabs
    while ($children->have_posts()) {
        $children->the_post();
        // Build tab
        $link = '<li class="nhsuk-list-panel__item " ';
        if (is_page($post->ID)) {
            $link .= '  aria-current="page">
          <span class="nhsuk-contents-list__current"><a class="nhsuk-list-panel__link ';
            $endlink = '</span>';
        } else {
            $link .= '><a class="nhsuk-list-panel__link ';
            $endlink = '';
        }
        $link .= '" href="';
        $link .= get_permalink($post);
        $link .= '">' . $post->post_title;
        $link .= '</a>';
        $link .= $endlink;
        $link .= '</li>';
        // If number of tabs exceeds number of icons, reset to start of icon array (icons will repeat from the start)
        if (!next($icons)) {
            reset($icons);
        }
        // Display tab
        echo $link;
    }
    echo '</ul></nav></div>';
    wp_reset_query();
}

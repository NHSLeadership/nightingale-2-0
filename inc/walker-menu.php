<?php
class Walker_Nightingale_Menu extends Walker_Nav_Menu {



    private $menuID;  // Store menu id so that sub-menus can reference their parent menus
    private $panel = False; // Indicates whether or not a submenu panel exists

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
      // start sub-menus
      $item_output = $args->before;
      $id = $this->menuID;  // retrieve the menu ID
      $item_output .= '<nav class="c-nav-primary__sub jsNavSub" id="menu-item-'.$id.'-sub" role="group" aria-label="submenu">';
      $item_output .= $args->after;
  		$output .= apply_filters( 'walker_nav_menu_start_lvl', $item_output, $depth, $args );
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
      // end sub-menus
      $item_output = $args->before;
      $item_output .= '</nav>';
      $item_output .= $args->after;
  		$output .= apply_filters( 'walker_nav_menu_end_lvl', $item_output, $depth, $args );
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 )
    {
        // start element output
        $classes = array();
        if (!empty($item->classes)) {
            $classes = (array)$item->classes;
        }

        $url = '';
        if (!empty($item->url)) {
            $url = $item->url;
        }

        $item_output = $args->before;


        // menus without childen (including sub-menus)
        // Display standard menu item
        $item_output .= '<li class="nhsuk-header__navigation-item"><a
href="' . $item->url . '" class="nhsuk-header__navigation-link" >' . $item->title . '</a></li>';

        $this->menuID = $item->ID;  // store the menu ID

        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
      // end element output
      if( $depth == 0 && $args->walker->has_children ) {
        // parent-menus
        $output .= '</li>';
      }
    }

} // Walker_Nav_Menu

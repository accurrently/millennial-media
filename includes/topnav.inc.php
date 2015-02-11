<?php
/**
 * topnav.inc.php
 * 
 * Utilitiy functions for topnav.php template.
 */

// Register the menu first
register_nav_menu( 'top-bar-menu', __('Top bar menu', 'millennial-media')  );

/**
 * Adds Foundation classes to menu items
 * 
 * @param array $classes An array of CSS classes to add to the element
 * @param object $item The item object to check
 * @return array The appended classes
 */
function mm_active_nav_class( $classes, $item ) {

    if ( $item->db_id == get_the_ID() ) {
        $classes[] = 'active';
    }
	if ( in_array('menu-item-has-children', $classes) ) {
		$classes[] = 'has-dropdown';
	}

    return $classes;

}
add_filter( 'nav_menu_css_class', 'mm_active_nav_class', 10, 2 );

/**
 * A Walker class to add some simple html to the output for menus
 */
class MM_Walker_Nav_Menu extends Walker_Nav_Menu {
	/**
	 * Outputs a UL element and adds the "dropdown" Foundation class for proper rendering with Foundation
	 * @param string &$output Reference variable for the output
	 * @param int $depth How low is this menu (counts sub-menus)
	 * @param array $args An array of arguments for the menu rendering
	 */
	function start_lvl(&$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu dropdown\">\n";
	}
}



?>
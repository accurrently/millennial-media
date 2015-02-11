<?php
/**
 * pagination.inc.php
 *
 * Utilities for pagination layout using Foundation.
 *
 * @author Alex Campbell <alex@alexthejourno.com>
 */

/**
 * Searches the links HTML in array supplied by paginate_links and prints out the navigation.
 *
 * @see function paginate_links
 * @param array $args Array of arguments for paginate_links().
 */
function the_Foundation_pagination( $args = array() ) {
	$args['type'] = 'array';
	$links = paginate_links( $args );
	if( empty($links) ) {
		return;
	}
	
	$search_before = 'prev page-numbers';
	$search_after = 'next page-numbers';
	$search_ellipsis = 'page-numbers dots';
	$search_current = 'page-numbers current';
	
	echo '<ul class="pagination">\n';
	$i =0;
	$len = count( $links );
	foreach( $links as $link ) {
		// Check to see if we need to add an "arrow" class.
		// WordPress doesn't print prev and next links if they don't exist.
		if( ($i == 0 && strpos($link, $search_before) !== false) || ( $i == $len - 1 && strpos($link, $search_after) !== false ) ) {
			echo '\t<li class="arrow">' . $link . '</li>\n';
		}
		// Check for current page
		else if( strpos($link, $search_current) !== false ) {
			echo '\t<li class="current">' . $link . '</li>\n';
		}
		// Check for ellipsis
		else if( strpos($link, $search_ellipsis) !== false ) {
			echo '\t<li class="unavailable">' . $link . '</li>\n';
		}
		// For all other links
		else {
			echo '\t<li>' . $link . '</li>\n';
		}
		$i++;
	}
	echo '</ul>\n';
}

?>
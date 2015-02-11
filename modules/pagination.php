<?php
/**
 * pagination.php
 *
 * Creates foundation-friendly pagination HTML.
 * 
 * @author Alex Campbell <alex@alexthejourno.com>
 */
 
require_once( get_stylesheet_directory() . '/includes/pagination.inc.php' );

?>
<div class="pagination-centered">
	<?php the_Foundation_pagination(); ?>
</div>
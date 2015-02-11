<?php
/**
 * sticky-scroller.inc.php
 *
 * Sets up the sticky scroller.
 *
 * @author Alex Campbell <alex@alexthejourno.com>
 */

wp_enqueue_script( 'interchange' );

wp_enqueue_script(
	// The slug of the script
	'mm-sticky-scroller',
	
	// Where the Javascript is
	get_template_directory_uri() . '/js/modules/mm-sticky-scroller.js',
	
	// Dependencies
	array( 'slick', 'jquery' ), 
	
	// Version
	'1.0.0', 
	
	// In footer? Usually, it's a good idea to put custom scripts in the footer.
	true
);


?>

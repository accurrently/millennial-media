<?php
/**
 * prep-article.inc.php
 * 
 */

include_once( get_stylesheet_directory() . '/includes/interchange-images.inc.php' );

$author_gravatar = get_avatar(  get_the_author_meta( 'ID' ), 150 );

$link_page_els = wp_link_pages( array('before' => '', 'after' => '', 'next_or_number' => 'next', 'echo' => false) );
$link_page_frags = explode('<a href=', $link_page_els);
$link_page_str = '';
foreach( $link_page_frags as $frag ) {
	if( strlen($frag) > 0 ) {
		$link_page_str .= '<a class="button" href=' . $frag;
	}
}
?>
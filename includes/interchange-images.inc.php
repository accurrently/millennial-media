<?php
/**
 * Gets interchange images for screens
 */

require_once( get_stylesheet_directory() . '/includes/retina.inc.php' );
/*
$interchange_img = '';
if( has_post_thumbnail() ) {
	$md_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
	$lg_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
	
	$interchange_img = 'data-interchange="[' . $md_img[0] . ', (medium)], [' . $lg_img[0] . ', (large)]"';
}*/

function _mm_get_long_side( $size ) {
	global $_wp_additional_image_sizes;
	if( is_array($size) && isset($size[0]) ) {
		return ( isset( $size[1] ) && $size[1] > $size[0] ) ? $size[1] : $size[0];
	} else if( is_string($size) && $_size_object = $_wp_additional_image_sizes[$size] ) {
		if( isset ($_wp_additional_image_sizes[$size][0]) ) {
			return isset($_wp_additional_image_sizes[$size][1]) && $_wp_additional_image_sizes[$size][1] > $_wp_additional_image_sizes[$size][0]	?
							$_wp_additional_image_sizes[$size][1] : $_wp_additional_image_sizes[$size][0];
		}
	}
	return 0;
}

function mm_is_size_lte( $size, $slug = 'medium' ) {
	return _mm_get_long_side( $size ) <= _mm_get_long_side( 'mm-' . $slug );
}

function get_interchange_sizes( $size ) {
	$the_sizes = array();
	global $_wp_additional_image_sizes;
	if( null !== mm_is_size_lte( $size, 'thumb' ) ) {
		$the_sizes[] = 'thumb';
	}
	if( null !== mm_is_size_lte( $size, 'small' ) ) {
		$the_sizes[] = 'small';
	}
	if( null !== mm_is_size_lte( $size, 'medium' ) ) {
		$the_sizes[] = 'medium';
	}
	if( null !== mm_is_size_lte( $size, 'large' ) ) {
		$the_sizes[] = 'large';
	}
	if( null !== mm_is_size_lte( $size, 'xlarge' ) ) {
		$the_sizes[] = 'xlarge';
	}
	
	return $the_sizes;
}

function mm_make_interchange_attr( $id, $sizes, $type = '' ) {
	$html_inter = 'data-interchange="';
	$first = true;
	foreach( $sizes as $_i => $_size_slug ) {
		if( !$first ) {
			$html_inter .= ', ';
		} else {
			$first = false;
		}
		$url_normal = wp_get_attachment_image_src( $id, 'mm-' . $_size_slug . '-' . $type );
		$url_retina = wp_get_attachment_image_src( $id, 'mm-' . $_size_slug . '-' . $type . '-retina' );
		$html_inter .= '[' . esc_attr($url_normal) . ', (' . $_size_slug . ')], ';
		$html_inter .= '[' . esc_attr($url_retina) . ', (' . $_size_slug . 'retina)]';		
	}
	$html_inter .= '" ';
}

/**
 * Filters the content and uses interchange 
 * to load up images according to device size.
 * This is so we can save bandwidth for mobiles.
 * Will only bother to do this for local images.
 * External images ar out of my hands. I'm not 
 * going to resize images on my server!
 */
function mm_get_img_tag( $html, $id, $alt, $title, $align, $size = 'medium' ) {
	if( !isset($id) ) {
		return $html;
	}
	// Don't mess with SellMedia plugin
	$parent_type = get_post_type( get_post_field( 'post_parent', $id) );
	if( strpos($parent_type, 'sell_media') !== false ) {
		return $html;
	}
	
	$html_id = 'id="' . esc_attr( 'attachment-id-' . $id ) . '" ';
	$html_alt = 'alt="' . esc_attr( $alt ) . '" ';
	$html_class = 'class="' . apply_filters( 'get_image_tag_class', $class, $id, $align, $size ) . '" ';
	$html_w = is_array($size) ? 'width="' . $size[0] . '" ' : '';
	$html_h = is_array($size) && isset($size[1]) ? 'height="' . $size[1] . '" ' : $html_w;
	
	global $_wp_additional_image_sizes;
	
	// This is the size we'll retrieve
	$sizes = get_interchange_sizes($size);
		
	$html_inter = mm_maker_interchange_attr( $id, $sizes );
	
	return '<img ' . $html_id . $html_inter . $html_class . $html_w . $html_h . $html_alt . ' />';
}
add_filter( 'get_image_tag', 'mm_get_img_tag' );

function mm_interchange_header_attr($id){
	$sizes = array( 'small', 'medium', 'large', 'xlarge');
	return mm_make_interchange_attr( $id, $sizes, 'header' );
	
}

?>
<?php
/**
 * Gets interchange images for screens
 */

function mm_get_long_side( $size ) {
	global $_wp_additional_image_sizes;
	if( is_array($size) && isset($size[0]) ) {
		return ( isset( $size[1] ) && $size[1] > $size[0] ) ? $size[1] : $size[0];
	} else if( is_string($size) && $_size_object = $_wp_additional_image_sizes[$size] ) {
		if( isset ($_wp_additional_image_sizes[$size][0]) ) {
			return isset($_wp_additional_image_sizes[$size][1]) && $_wp_additional_image_sizes[$size][1] > $_wp_additional_image_sizes[$size][0] ? $_wp_additional_image_sizes[$size][1] : $_wp_additional_image_sizes[$size][0];
		}
	}
	return 0;
}

function mm_is_size_lte( $size, $slug = 'medium' ) {
	return mm_get_long_side( $size ) <= mm_get_long_side( 'mm-' . $slug );
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
	$typeslug = '';
	if( isset($type) ) {
		$typeslug = '-' . $type;
	}
	foreach( $sizes as $_size_slug ) {
		if( !$first ) {
			$html_inter .= ', ';
		} else {
			$first = false;
		}
		if( is_string($_size_slug) ) {
			$url_normal = wp_get_attachment_image_src( $id, 'mm-' . $_size_slug . $typeslug );
			$url_retina = wp_get_attachment_image_src( $id, 'mm-' . $_size_slug . $typeslug . '-retina' );
			$html_inter .= '[' . esc_attr($url_normal[0]) . ', (' . $_size_slug . ')], ';
			$html_inter .= '[' . esc_attr($url_retina[0]) . ', (' . $_size_slug . 'retina)]';
		}
	}
	$html_inter .= '" ';
	return $html_inter;
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
		
	$html_inter = mm_make_interchange_attr( $id, $sizes );
	
	return '<img ' . $html_id . $html_inter . $html_class . $html_w . $html_h . $html_alt . ' />';
}
add_filter( 'get_image_tag', 'mm_get_img_tag' );

/**
 * Makes creates the interchange attribute for header images.
 * @attr mixed $id The ID of the post. Defaults to false.
 * @return string a data-interchange HTML attribute
 */
function mm_interchange_header_attr($id = false){
	$theid = $id;
	if ($theid === false ) {
		/**
		 * From Nick Ohrn's blog.
		 * @see http://nickohrn.com/2013/09/get-attachment-id-wordpress-header-image/
		 */
		$data = get_theme_mod('header_image_data');
		$attachment_id = is_array($data) && isset($data['attachment_id']) ? $data['attachment_id'] : false;
		if($attachment_id) {
			$theid = $attachment_id;
		}
		else {
			return ''; 
		}
	}
	// back to business
	
	$sizes = array( 'small', 'medium', 'large', 'xlarge');
	return mm_make_interchange_attr( $theid, $sizes, 'header' );
	
}

?>
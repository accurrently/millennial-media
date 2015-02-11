<?php
/**
 * retina.inc.php
 *
 * Makes sure we make image sizes for different applications.
 *
 * @author Alex Campbell <alex@alexthejourno.com>
 */

// Set the quality to maximum so WordPress doesn't resample our images for us.
// Most sane people don't upload at 100% quality, so downsample more?
// add_filter('jpeg_quality', create_function('$quality', 'return 100;')); // deprecated
add_filter( 'jpeg_quality', 'mm_jpg_quality' );
add_filter( 'wp_editor_set_quality', 'mm_jpg_quality' ); 
function mm_jpg_quality() {
	return 100;
}

/**
 * Adds an image size, but at retina scale.
 * Dimensions will be multiplied for retina resolution.
 * @param string $slug The image size to add.
 * @param int $width The maximum width. Default: 200.
 * @param int $height The maximum height. Default: 200.
 * @param bool $crop Hard cropping. Defaults to FALSE.
 * @param float $dpi_multiplier Determines how much bigger the Retina version will be.  Defaults to 2.
 */
function add_retina_image_size( $slug = 'thumbnail', $width = 200, $height = 200, $crop = false, $dpi_multiplier = 2 ) {
	// Make the default image size for smaller screens
	add_image_size( $slug, $width, $height, $crop);
	// Make a retina size for HiDPI screens
	add_image_size( $slug . '-retina', $width * $dpi_multiplier, $height * $dpi_multiplier, $crop );
}

/**
 * Callback function for an action trigger.
 * Resamples jpeg images that are uploaded, 
 * but only for the sizes listed with the 'mm' prefix.
 * This code is borrowed from Ahmad M.
 * @see <http://wordpress.stackexchange.com/questions/74103/set-jpeg-compression-for-specific-custom-image-sizes>
 * @param int $meta_id The ID for the ID
 * @param int $attach_id The ID for the attachment itself
 * @param string $meta_key The type of metadata
 * @param array $attach_meta The metadata properties of the attachment object.
 */
function mm_update_jpeg_quality($meta_id, $attach_id, $meta_key, $attach_meta) {

    if ($meta_key == '_wp_attachment_metadata') {

        $post = get_post($attach_id);

        if ($post->post_mime_type == 'image/jpeg' && is_array($attach_meta['sizes'])) {

            $pathinfo = pathinfo($attach_meta['file']);
            $uploads = wp_upload_dir();
            $dir = $uploads['basedir'] . '/' . $pathinfo['dirname'];

            foreach ($attach_meta['sizes'] as $size => $value) {

                $image = $dir . '/' . $value['file'];
                $resource = imagecreatefromjpeg($image);

                if ( strpos( $size, 'retina') ) {
                    // Reduce the Retina sample quality
					// The image will be displayed at half resolution,
					// so let's get some filesize savings
					// This also protects hi-res images from theft.
                    imagejpeg($resource, $image, 60);
                } else {
                    // leave the jpeg quality alone
                    // imagejpeg($resource, $image, 10);
                }

                imagedestroy($resource);
            }
        }
    }
}
add_action('added_post_meta', 'mm_update_jpeg_quality', 10, 4);
?>
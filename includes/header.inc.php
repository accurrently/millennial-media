<?php
/**
 * Does things to the header size that we'd like.
 */

function mm_the_header_attr($attachment_id){

	if( !isset($attachment_id) ) {
		$data = get_theme_mod('header_image_data');

		$attachment_id = is_array($data) && isset($data['attachment_id']) ? $data['attachment_id'] : false;
	}
	
	$interchange_str = '';

	if($attachment_id) {
		$interchange_str = mm_interchange_header_attr($attachment_id, 'xlarge', 'header');
	}
	?>
	<style>
		.imageheader {
			height: <?php echo $header_height['small']; ?>px;
			background-color: #<?php echo get_theme_mod('background_color'); ?>;
			background-size: cover;
		}
		/* medium */
		@media only screen and (min-width: 40.063em) { .imageheader{ height: <?php echo $header_height['medium']; ?>px; } }
		/* large */
		@media only screen and (min-width: 64.063em) { .imageheader{ height: <?php echo $header_height['large']; ?>px; } }
		/* xlarge */
		@media only screen and (min-width: 90.063em) { .imageheader{ height: <?php echo $header_height['xlarge']; ?>px; } }
	</style>
	<div class="imageheader" <?php echo mm_interchange_header_attr(); ?> >
	<?php
}
?>
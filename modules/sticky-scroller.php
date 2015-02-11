<?php
/*
 * sticky-scroller.php
 * A scroller for sticky posts and their preview images.
*/

require_once( get_stylesheet_directory() . '/includes/sticky-scroller.inc.php' );

?>
<div class="row">
	<div class="small-12 columns mm-sticky-scroller">
		<?php
		$args = array(
			'posts_per_page' => 5, // Get 5 posts max
			'post__in'  => get_option( 'sticky_posts' ),
			'ignore_sticky_posts' => 1 
		);
		$query = new WP_Query( $args );
		
		if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
		?>
		<div <?php echo mm_make_interchange_attr(get_post_thumbnail_id(), array( 'small', 'medium', 'large', 'xlarge'));   ?>>
			<h2><?php the_title(); ?></h2>
		</div>
		<?php endwhile; endif; ?>
	</div>
</div>
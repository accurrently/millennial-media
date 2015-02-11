<?php
/*
* index.php
* 
* Default display
*/

include_once( get_stylesheet_directory() . '/includes/interchange-images.inc.php' );
?>
<?php get_header(); ?>
		<header class="row" role="banner" style="background-color: <?php background_color(); ?>; background-image: url(<?php header_image(); ?>); background-repeat: no-repeat; background-size: cover;" <?php echo $interchange_img; ?>>
			<div class="small-12 large-8 large-center columns text-center" style="color: <?php header_textcolor(); ?>;">
				<h1><?php bloginfo('name'); ?></h1>
				<p><?php bloginfo('description'); ?></p>
			</div>
		</header>
		<?php get_template_part('modules/sticky-scroller'); ?>
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php get_template_part('modules/preview'); ?>
		<?php endwhile; endif; ?>
		<?php get_template_part('modules/pagination'); ?>
<?php get_footer(); ?>
		
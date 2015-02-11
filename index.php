<?php
/*
* index.php
* 
* Default display
*/


?>
<?php get_header(); ?>
		<header class="imageheader" role="banner" style="background-color: <?php background_color(); ?>; background-image: url(<?php header_image(); ?>); background-repeat: no-repeat; background-size: cover;" <?php echo mm_interchange_header_attr(); ?>>
			<div class="row">
				<div class="small-12 large-8 large-center columns text-center" style="color: <?php header_textcolor(); ?>;">
					<h1><?php bloginfo('name'); ?></h1>
					<p><?php bloginfo('description'); ?></p>
				</div>
			</div>
		</header>
		<?php get_template_part('modules/sticky-scroller'); ?>
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php get_template_part('modules/preview'); ?>
		<?php endwhile; endif; ?>
		<?php get_template_part('modules/pagination'); ?>
<?php get_footer(); ?>
		
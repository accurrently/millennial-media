<?php
/*
* page.php
* 
* Default page display
*/

include( get_template_directory() . '/includes/prep-article.inc.php' );

?>
<?php get_header(); ?>
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		
		
			<article id="post-<?php the_ID(); ?>" class="page post-<?php echo get_post_type() ?>" >
				<header class="row" style="background-color: <?php background_color(); ?>; background-repeat: no-repeat; background-size: cover;" >
					<div class="small-12 large-8 large-center columns text-center" style="color: <?php header_textcolor(); ?>;">
						<h1><?php the_title(); ?></h1>
					</div>
				</header>
		<div class="row content">
			<div class="small-12 columns">
				<?php the_content(); ?>
			</div>
		</div>
		<div class="row">
			<div class="small-8 small-centered columns">
				<p><?php echo $link_page_str; ?>
			</div>
		</div>

	</article>
		<?php endwhile; endif; ?>
<?php get_footer(); ?>
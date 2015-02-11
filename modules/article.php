<?php
/**
 * article.php
 * 
 * Formats articles for display
 * @author Alex Campbell <alex@alexthejourno.com>
 */

include( get_stylesheet_directory() . '/includes/prep-article.inc.php' );

	/* style="background-color: <?php background_color(); ?>; background-repeat: no-repeat; background-size: cover;" */
?>
<article id="post-<?php the_ID(); ?>" class="post post-<?php echo get_post_type(); ?>" >
	<header <?php echo mm_interchange_header_attr(get_post_thumbnail_id()); ?> >
		<div class="row" >
			<div class="small-12 large-8 large-centered columns text-center" style="color: <?php header_textcolor(); ?>;">
				<h1><?php the_title(); ?></h1>
			</div>
		</div>
	</header>
	<div class="row">
		<div class="small-12 medium-8 columns">
			<div class="row post-meta">
				<?php if( $author_gravatar != '' ) : ?>
				<div class="small-1 columns">
					<?php echo $author_gravatar; ?>
				</div>
				<div class="small-2 columns">
				<?php else : ?>
				<div class="small-3 columns">
				<?php endif; ?>
					<p><?php the_author_posts_link(); ?></p>
				</div>
				<div class="small-9 columns">
					<p><?php _e('Posted', 'millennial-media'); ?> <?php the_date('D. Y-m-d'); ?> <?php _e('at', 'millennial-media'); ?>  <?php the_time('H:i T'); ?></p>
					<p><?php _e('Filed in', 'millennial-media'); ?>: <?php the_category(', ', 'single'); ?></p>
				</div>
			</div>
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
			<div class="row">
				<div class="small-12 columns">
					<p><?php _e('Filed in', 'millennial-media'); ?>: <?php the_category(', ', 'single'); ?></p>
					<p><?php _e('Tagged', 'millennial-media'); ?>: <?php the_tags( '', ', ' ); ?></p>
				</div>
			</div>
			<div class="row">
				<div class="small-8 small-centered columns">
					<div class="row">
						<div class="small-4 columns">
							<?php echo $author_gravatar; ?>
						</div>
						<div class="small-8 coluns">
							<?php the_author_link(); ?>
						</div>
					</div>
						<?php the_author_meta( 'description' ); ?>
				</div>
			</div>
		</div>
		<div class="hide-for-small-only medium-4 columns">
			<?php get_sidebar(); ?>
		</div>
	</div>
</article>
<section class="row"><!-- the comments -->
	<div class="small-12 columns">
		<?php comments_template(); ?>
	</div>
</section>
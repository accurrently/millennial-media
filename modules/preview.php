<?php
/*
* preview.php
* 
* Default post previews
*/
?>

<article class="row">
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="small-3 columns">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'small', array( 'style' => 'max-width: 100%; height: auto;' ) ); ?>
		</a>
	</div>
	<div class="small-9 columns">
	<?php else : ?>
	<div class="small-12 columns">
	<?php endif; ?>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<h6><?php the_date(); ?> / <?php the_time(); ?></h6> <?php _e('by', 'millennial-media'); ?> <?php the_author(); ?></h6>
		<?php the_excerpt(); ?>		
	</div>
</article>
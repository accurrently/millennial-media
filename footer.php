<?php
/*
* footer.php
* 
* The page footer and closing up WordPress
*
* @author Alex Campbell <alex@alexthejourno.com>
*/
?>
		<footer class="row" data-equalizer>
			<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4">
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
			</ul>
		</footer>
		<footer class="row copyright">
			<div class="small-centered small-8 columns">
				<h6><?php echo get_theme_mod('mm_copyright_notice'); ?></h6>
			</div>
		</footer>
		<?php wp_footer(); ?>
		<?php do_action('mm_exec_raw_script'); ?>
	</body>
</html>
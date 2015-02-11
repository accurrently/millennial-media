<?php
/*
 * topnav.php
 * Creates the top bar menu
 */

require_once( get_stylesheet_directory() . '/includes/topnav.inc.php' );



?>
<nav class="top-bar" data-topbar role="navigation">
	<ul class="title-area">
		<li class="name">
			<h1>
				<a href="<?php echo home_url(); ?>">
					<?php bloginfo('name'); ?>
				</a>
			</h1>
		</li>
	</ul>
	<section class="top-bar-section">
		<?php wp_nav_menu( array(
			'theme_location' => 'top-bar-menu',
			'echo' => true,
			'menu_class' => 'right menu',
			'walker' => new MM_Walker_Nav_Menu()
			) );
		?>
	</section>
</nav>
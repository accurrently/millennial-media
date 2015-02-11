<?php
/*
* header.php
* 
* Default header stuff
*
* @author Alex Campbell <alex@alexthejourno.com>
*/
?>
<!DOCTYPE html>
<html><!-- html5 -->
	<head>
		<title>
			<?php if ( !is_home() ) : the_title(); ?> | <?php endif; echo bloginfo( 'name' ); ?>
		</title>
		
		<?php wp_head(); ?>
		<?php do_action( 'mm_head' ); ?>
		<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	</head>
	<body>
		<?php get_template_part( 'modules/topnav' ); ?>
		
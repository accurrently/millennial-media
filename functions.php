<?php
/**
 * functions.php
 *
 * Initializes WordPress for us.
 * 
 * @author Alex Campbell <alex@alexthejourno.com>
 */



// Add theme support for cool stuff we need
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
add_theme_support( 'title-tag' );

// Get support for Retina and making sure WP doesn't mess with our file uploads
require_once( get_stylesheet_directory() . '/includes/retina.inc.php' );



// Image sizes
add_retina_image_size( 'mm-thumb', 200, 200);
add_retina_image_size( 'mm-small', 300, 300 );
add_retina_image_size( 'mm-medium', 640, 640 );
add_retina_image_size( 'mm-large', 800, 800 );
add_retina_image_size( 'mm-xlarge', 960, 960 );

/**
 * This is how tall our headers will be
 */
$header_height = array( 
	'small'		=>	300,
	'medium'	=>	350,
	'large'		=>	400,
	'xlarge'	=>	400,
);
add_retina_image_size( 'mm-small-header', 640, 300, true ); 
add_retina_image_size( 'mm-medium-header', 1024, 350, true );
add_retina_image_size( 'mm-large-header', 1440, 400, true );
add_retina_image_size( 'mm-xlarge-header', 1920, 400, true );



/**
 * Enqueue all the javascripts we know we'll need. 
 * Small snippets get enqueued when they're used.
 */
function enqueue_and_register_mm_scripts(){

    // Load up Foundation
	wp_enqueue_script( 'foundation-min', 'https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.0/js/foundation.min.js', array( 'jquery' ), '', true );
	
}
add_action( 'wp_enqueue_scripts', 'enqueue_and_register_mm_scripts' );

/**
 * Starts Foundation
 */
function mm_exec_foundation() {
?>
<script type="text/javascript">
	jQuery.noConflict();
	jQuery(document).ready(function($) {
 
		// Initialize Foundation
		$(document).foundation();
 
	}); 
</script>
<?php
}
add_action( 'mm_exec_raw_script', 'mm_exec_foundation' );

/**
 * Initializes our widget areas (sidebars)
 *
 * @author Alex Campbell <alex@alexthejourno.com>
 * @see function register_sidebar
 */
function mm_init_widgets() {
    register_sidebar( array(
        'name' => __( 'Footer', 'millennial-media' ),
        'id' => 'footer-widgets',
        'description' => __( 'Widgets in this area will show up in the footer.', 'millennial-media' ),
		'before_widget' => '<aside id="%1$s" class="widget data-equalizer-watch %2$s">',
		'after_widget'  => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Right sidebar', 'millennial-media' ),
        'id' => 'right-widgets',
        'description' => __( 'Widgets in this area will show up in the sidebar to the right.', 'millennial-media' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'mm_init_widgets' );

/**
 * Creates all the variables available through get_theme_mod() and sets up the controls
 * @author Alex Campbell <alex@alexthejourno.com>
 */
function mm_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 
		'mm_copyright_notice',
		array(
			'default'     => '',
			'transport'   => 'refresh',
		)
	);
	
	$wp_customize->add_control(
		'your_control_id', 
		array(
			'label'    => __( 'Copyright notice', 'millennial-media' ),
			'section'  => 'title_tagline',
			'settings' => 'mm_copyright_notice',
			'type'     => 'text',
		)
	);
}
add_action( 'customize_register', 'mm_customize_register' );

/**
 * Set up menu locations
 */
function mm_register_menus() {
	 register_nav_menu( 'top-bar-menu', __('Menu for the top nav bar', 'millennial-media') );
}
add_action( 'init', 'mm_register_menus' );
?>
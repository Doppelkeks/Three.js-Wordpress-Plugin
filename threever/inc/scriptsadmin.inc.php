<?php
function threever_admin_enqueue($hook) {
    if( 'post.php' != $hook && 'post-new.php' != $hook)
        return;

	//Interactive Preview Scripts
	
	//Three
	wp_deregister_script( 'threejs' );
	wp_register_script( 'threejs', plugins_url('inc/js/three.min.js',dirname(__FILE__)));
	wp_enqueue_script( 'threejs' );
	
	//Custom Class
	wp_deregister_script( 'threeverElement' );
	wp_register_script( 'threeverElement', plugins_url('inc/js/threeverElement.js',dirname(__FILE__)));
	wp_enqueue_script( 'threeverElement' );
	
	
	//Main Script for post/post-new area
	
	wp_deregister_script( 'adminPanel' );
	wp_register_script( 'adminPanel', plugins_url('js/adminpanel.js', __FILE__) );
	wp_enqueue_script( 'adminPanel' );
}

add_action( 'admin_enqueue_scripts', 'threever_admin_enqueue' );
?>
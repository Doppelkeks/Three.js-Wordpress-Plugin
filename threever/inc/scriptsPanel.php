<?php
function my_enqueue($hook) {
    if( 'post.php' != $hook && 'post-new.php' != $hook)
        return;
	//wp_register_style( 'custom_wp_admin_css', plugins_url('css/threeverPanel.css', __FILE__), false, '1.0.0' );
    //wp_enqueue_style( 'custom_wp_admin_css' );
	
	//Interactive Preview
	
	//Three
	wp_deregister_script( 'threejs' );
	wp_register_script( 'threejs', plugins_url('inc/js/three.min.js',dirname(__FILE__)));
	wp_enqueue_script( 'threejs' );
	
	//Custom Class
	wp_deregister_script( 'threeverElement' );
	wp_register_script( 'threeverElement', plugins_url('inc/js/threeverElement.js',dirname(__FILE__)));
	wp_enqueue_script( 'threeverElement' );
	
	wp_deregister_script( 'my_custom_script' );
	wp_register_script( 'my_custom_script', plugins_url('js/adminPanel.js', __FILE__) );
	wp_enqueue_script( 'my_custom_script' );
}

add_action( 'admin_enqueue_scripts', 'my_enqueue' );
?>
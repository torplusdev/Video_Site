<?php

add_action( 'wp_enqueue_scripts', 'streamlab_enqueue_parent_styles' , 99 );

function streamlab_enqueue_parent_styles() {

	 
    $child_style = 'streamlab-child-style';
    wp_enqueue_style( $child_style, get_stylesheet_uri() );
    

}

?>
<?php

function enqueue_scripts_and_styles() {

    // jQuery
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', false, '3.3.1', true);
    wp_enqueue_script('jquery');

    // Main
    // wp_enqueue_script( 'vendors', get_template_directory_uri() . '/assets/js/vendors.min.js', array('jquery'), false, true );
    wp_enqueue_script( 'wc-add-to-cart' );
    wp_enqueue_script( 'wc-add-to-cart-variation' );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), false, true );

    // CSS
    wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.min.css' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts_and_styles' );
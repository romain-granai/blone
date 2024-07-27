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

    wp_localize_script('main', 'custom_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('custom_nonce')
    ));

    // CSS
    // Register the stylesheet again with the correct path
    wp_register_style('wc-blocks-style-cart', plugins_url('/assets/client/blocks/cart.css', WC_PLUGIN_FILE), array(), WC_VERSION);
    wp_register_style('wc-blocks-style-all-products', plugins_url('/assets/client/blocks/all-products.css', WC_PLUGIN_FILE), array(), WC_VERSION);
    wp_register_style('wc-blocks-packages-style', plugins_url('/assets/client/blocks/packages-style.css', WC_PLUGIN_FILE), array(), WC_VERSION);
    wp_register_style('wc-blocks-style-checkout', plugins_url('/assets/client/blocks/checkout.css', WC_PLUGIN_FILE), array(), WC_VERSION);

    // Enqueue the stylesheet
    wp_enqueue_style('wc-blocks-style-cart');
    wp_enqueue_style('wc-blocks-style-all-products');
    wp_enqueue_style('wc-blocks-packages-style');
    wp_enqueue_style('wc-blocks-style-checkout');

    if(is_cart() || is_checkout() || is_account_page()){
        wp_enqueue_style('woocommerce-general');
    }

    wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.min.css' );

}

function dequeue_unnecessary_css() {
    // Dequeue the default WordPress CSS files
    wp_dequeue_style('wp-block-library'); // WordPress core block library CSS
    wp_dequeue_style('wp-block-library-theme'); // WordPress core block library theme CSS
    wp_dequeue_style('wc-blocks-style'); // WooCommerce block library CSS
    wp_deregister_style('wc-blocks-style');

    wp_dequeue_style('wc-blocks-style-cart');
    wp_deregister_style('wc-blocks-style-cart');
    wp_dequeue_style('wc-blocks-style-all-products');
    wp_deregister_style('wc-blocks-style-all-products');
    wp_dequeue_style('wc-blocks-packages-style');
    wp_deregister_style('wc-blocks-packages-style');
    wp_dequeue_style('wc-blocks-style-checkout');
    wp_deregister_style('wc-blocks-style-checkout');
    
    

    // Dequeue other unnecessary CSS files
    wp_dequeue_style('wp-components'); // WordPress components CSS
    wp_dequeue_style('wp-editor'); // WordPress editor CSS
    wp_dequeue_style('global-styles'); // Global styles CSS
    // Add more stylesheets to dequeue as needed

    // Dequeue WooCommerce styles
    wp_dequeue_style('woocommerce-layout');
    wp_dequeue_style('woocommerce-smallscreen');
    wp_dequeue_style('woocommerce-general');
}

add_action('wp_enqueue_scripts', 'enqueue_scripts_and_styles', 30);
add_action('wp_enqueue_scripts', 'dequeue_unnecessary_css', 20);
<?php

// Add Woocommerce theme support
function blone_woocommerce_add_support() {
    add_theme_support( 'woocommerce' );

    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    
        
}
add_action( 'after_setup_theme', 'blone_woocommerce_add_support' );

// Remove WooCommerce CSS
// add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Add dropdowns to single product
function blone_display_acf_dropdowns(){
    // Check rows exists.
    if( have_rows('product_dropdowns') ):
        echo '<ul>';
        // Loop through rows.
        while( have_rows('product_dropdowns') ) : the_row();

            // Load sub field value.
            $title = get_sub_field('title');
            $content = get_sub_field('content');
            
            echo '<li>'. $title .' ' . $content . '</li>';

        // End loop.
        endwhile;
        echo '</ul>';
    endif;
}

add_action('woocommerce_after_add_to_cart_form', 'blone_display_acf_dropdowns');

// Remove Sidebar

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// //Add Barba to WooCommerce Templates
// function blone_add_barba_container_start(){
//     echo '<div data-barba="container" data-barba-namespace="woo">';
// };
// add_action('woocommerce_before_template_part', 'blone_add_barba_container_start');


// Add Image into the products loop

function blone_add_image_into_product_loop(){

    if(is_shop()){
        
        $image = get_field('product_list_image', get_option('woocommerce_shop_page_id'));

        echo '<li><img src="' . $image['url'] . '" alt="' . $image['alt'] . '" /></li>';
    }
    
}

add_action('loop_start', 'blone_add_image_into_product_loop');


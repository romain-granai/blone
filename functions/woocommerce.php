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

        echo '<li class="product-list__image"><div class="media"><img src="' . $image['url'] . '" alt="' . $image['alt'] . '" /></div></li>';
    }
    
}

add_action('loop_start', 'blone_add_image_into_product_loop');

/**
 * Replace the classes of the WooCommerce product list.
 *
 * @param string $output The opening ul tag of the product list.
 * @return string Modified opening ul tag for the product list.
 */
function custom_woocommerce_product_loop_start($output) {
    // Replace the 'products' class and remove any 'columns-*' classes
    $output = str_replace('products', 'product-list', $output);
    $output = preg_replace('/columns-\d+/', '', $output);
    return $output;
}
add_filter('woocommerce_product_loop_start', 'custom_woocommerce_product_loop_start');

/**
 * Add custom class to WooCommerce product list items.
 *
 * @param array $classes The existing classes.
 * @param string $class Additional class.
 * @param int $post_id The product ID.
 * @return array Modified class array.
 */
function custom_woocommerce_post_class($classes, $class, $post_id) {
    // Add 'product-item' class to each product list item
    if (is_product_category() || is_shop()) {
        $classes[] = 'product-item';
    }
    return $classes;
}
add_filter('post_class', 'custom_woocommerce_post_class', 10, 3);

/**
 * Append custom HTML after opening li.product-item tag.
 */
function append_custom_html_after_product_item_open() {
    global $product;

    if (!$product) {
        return;
    }

    $product_id = $product->get_id();
    $model = get_field('product_3d_model', $product_id);
    $title = get_the_title($product_id);
    ?>

    <div class="product-item__media">
        <span class="product-item__number">
            <?php
                
                foreach (str_split($title) as $char) {
                    echo '<span>'. $char .'</span>';
                }

            ?>
        </span>
        <div class="product-item__3d" id="product-item__3d" data-model="<?php echo $model['url']; ?>"></div>
    </div>
    <?php
}
add_action('woocommerce_shop_loop_item_title', 'append_custom_html_after_product_item_open', 5);


// Wrap product title and price in a div
add_action('woocommerce_shop_loop_item_title', 'wrap_product_elements_open', 5);
function wrap_product_elements_open() {
    echo '<div class="product-item__info">';
}

add_action('woocommerce_after_shop_loop_item_title', 'wrap_product_elements_close', 15);
function wrap_product_elements_close() {
    echo '</div>';
}

// Wrap add to cart button in a div
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_after_shop_loop_item', 'wrap_add_to_cart_button', 10);
function wrap_add_to_cart_button() {
    echo '<div class="add-to-cart-button">';
    woocommerce_template_loop_add_to_cart();
    echo '</div>';
}




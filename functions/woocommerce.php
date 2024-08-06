<?php

// Add Woocommerce theme support
function blone_woocommerce_add_support() {
    add_theme_support( 'woocommerce' );

    // add_theme_support( 'wc-product-gallery-zoom' );
    // add_theme_support( 'wc-product-gallery-lightbox' );
    // add_theme_support( 'wc-product-gallery-slider' );
    
        
}
add_action( 'after_setup_theme', 'blone_woocommerce_add_support' );

// Remove WooCommerce CSS
// add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Add new fields to single product

function blone_display_single_product_new_fields(){
    $perfume = get_field('product_perfume');
    $volume = get_field('product_volume');

    if($perfume){
        echo '<span class="single-product__perfume">' . $perfume . '</span>';
    };

    if($volume){
        echo '<span class="single-product__volume">' . $volume . '</span>';
    };
};

add_action('woocommerce_single_product_summary', 'blone_display_single_product_new_fields', 6);

// Add dropdowns to single product
function blone_display_acf_dropdowns(){
    // Check rows exists.
    if( have_rows('product_dropdowns') ):
        echo '<ul class="dropdowns">';
        // Loop through rows.
        while( have_rows('product_dropdowns') ) : the_row();

            // Load sub field value.
            $title = get_sub_field('title');
            $content = get_sub_field('content');

            echo '<li class="dropdown">';
            echo    '<button class="dropdown__trigger">'. $title .'</button>';
            echo    '<div class="dropdown__content">';
            echo        '<div>'. $content .'</div>';
            echo    '</div>';
            echo '</li>';

        // End loop.
        endwhile;
        echo '</ul>';
    endif;
}

add_action('woocommerce_after_add_to_cart_form', 'blone_display_acf_dropdowns');

// Remove Sidebar

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );



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
    // Check if we are not on the single product page
    if (!is_singular('product')) {
        // Add 'product-item' class to each product list item
        $classes[] = 'product-item';
    } else {
        // Ensure the 'product-item' class is added to related products on single product pages
        global $woocommerce_loop;
        if (isset($woocommerce_loop['name']) && in_array($woocommerce_loop['name'], ['related', 'up-sells', 'cross-sells'])) {
            $classes[] = 'product-item';
        }
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
    $colors_array = [];

    for ($i = 1; $i <= 4; $i++) {
        $color = get_field('color_' . $i);
        if ($color) {
            $colors_array[] = $color;
        }
    }

    ?>

    <div class="product-item__media" style="--color-1: <?php echo $colors_array[0]; ?>; --color-2:  <?php echo $colors_array[1]; ?>; --color-3: <?php echo $colors_array[2]; ?>; --color-4: <?php echo $colors_array[3]; ?>">
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

// Remove stock status

add_filter( 'woocommerce_get_stock_html', function ( $html, $product ) {
    return '';
}, 10, 2);

function blone_open_single_product(){
    echo '<div class="single-product__main">'; // Opening Single Product Block
    // echo '<div class="add-to-cart-confirmation"></div>';
}

add_action('woocommerce_before_single_product_summary', 'blone_open_single_product', 10);

function blone_close_single_product(){
    echo '</div>'; // Close Single Product Block
}

add_action('woocommerce_after_single_product_summary', 'blone_close_single_product', 16);

function blone_content_block(){
    ?>

        <?php if( have_rows('content_blocks') ): ?>

        <?php while( have_rows('content_blocks') ): the_row(); ?>

            <?php if( get_row_layout() == 'full_media' ): 
                $mainTitle = get_sub_field('main_title');
                $animationTypeClass = 'block--full-media--'.get_sub_field('animation_type');
                $typeClass = ' ' . get_sub_field('type');
                $textPositionClass = ' ' . get_sub_field('text_position');
                $ctaPositionClass = ' ' . get_sub_field('cta_position');
                $mediaType = get_sub_field('media_type');
                $img = get_sub_field('image');
                $video = get_sub_field('video');
                $text = get_sub_field('text');
                $ctaLabel = get_sub_field('cta_label');
                $ctaLink = get_sub_field('cta_link');
                $ctaUrl = $ctaLink['url'];
                $ctaTitle = $ctaLink['title'];
                $ctaTarget = $ctaLink['target'] ? $ctaLink['target'] : '_self';
                $marginTopClass = get_sub_field('margin_top') != 'none' ? get_sub_field('margin_top') : '';
                $marginBottomClass = get_sub_field('margin_bottom') != 'none' ? get_sub_field('margin_bottom') : '';
            ?>

                <?php if($mainTitle): ?>
                    <div class="title title--center title--section"><h2><?php echo $mainTitle; ?></h2></div>
                <?php endif; ?>

                <div class="block block--full-media <?php echo $animationTypeClass . ' ' . $textPositionClass . ' ' . $ctaPositionClass . ' ' . $typeClass . ' ' . $marginTopClass . ' ' . $marginBottomClass; ?>"> 
                    <div class="media">
                        <?php if($mediaType == 'image'): ?>
                            <?php if(!empty( $img )): ?>
                                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if($video): ?>
                                <video src="<?php echo $video['url']; ?>"  loop="" muted="" playsinline=""></video>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="block--full-media__front">
                        <?php if($text): ?>
                            <?php if(get_sub_field('animation_type') == 'wave'): ?>
                                <span class="block--full-media__text"><?php echo $text; ?></span>
                            <?php else: 
                                $parts = explode('<br>', $text);
                                $parts = array_map('trim', $parts); 
                            ?>
                                <span class="block--full-media__text">
                                    <?php foreach($parts as $line): ?>
                                        <span><?php echo $line; ?></span>
                                    <?php endforeach; ?>
                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if($ctaLabel && $ctaLink): ?>
                            <a href="<?php echo $ctaUrl ?>" class="btn btn--light-neg btn--big btn--rounded" data-text="<?php echo $ctaLabel; ?>" target="<?php echo $ctaTarget; ?>" title="<?php echo $ctaTitle ?>"><span><?php echo $ctaLabel; ?></span></a>
                        <?php endif; ?>
                    </div>
                </div>

            <?php elseif( get_row_layout() == 'text_and_media' ): 
                $mainTitle = get_sub_field('main_title');
                $alignmentClass = get_sub_field('alignment');
                $title = get_sub_field('title');
                $textContent = get_sub_field('text_content');
                $mediaType = get_sub_field('media_type');
                $img = get_sub_field('image');
                $video = get_sub_field('video');
                $marginTopClass = get_sub_field('margin_top') != 'none' ? get_sub_field('margin_top') : '';
                $marginBottomClass = get_sub_field('margin_bottom') != 'none' ? get_sub_field('margin_bottom') : '';
            ?>

                <?php if($mainTitle): ?>
                    <div class="title title--center title--section"><h2><?php echo $mainTitle; ?></h2></div>
                <?php endif; ?>

                <div class="block block--text-n-media <?php echo $alignmentClass . ' ' . $marginTopClass . ' ' . $marginBottomClass; ?>">
                    <div class="block--text-n-media__text">
                        <?php if($title): ?>
                            <h2><?php echo $title; ?></h2>
                        <?php endif; ?>
                        <?php if($textContent): ?>
                            <?php echo $textContent ?>
                        <?php endif; ?>
                    </div>
                    <div class="block--text-n-media__media">
                        <div>
                            <div class="media">
                                <?php if($mediaType == 'image'): ?>
                                    <?php if(!empty( $img )): ?>
                                        <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" />
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if($video): ?>
                                        <video src="<?php echo $video['url']; ?>"  loop="" muted="" playsinline=""></video>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

            <?php elseif( get_row_layout() == 'just_text' ): 
                $mainTitle = get_sub_field('main_title');
                $textContent = get_sub_field('text_content');
                $ctaLabel = get_sub_field('cta_label');
                $ctaLink = get_sub_field('cta_link');

                $marginTopClass = get_sub_field('margin_top') != 'none' ? get_sub_field('margin_top') : '';
                $marginBottomClass = get_sub_field('margin_bottom') != 'none' ? get_sub_field('margin_bottom') : '';
            ?>

                <?php if($mainTitle): ?>
                    <div class="title title--center title--section"><h2><?php echo $mainTitle; ?></h2></div>
                <?php endif; ?> 

                <div class="block block--just-text <?php echo $marginTopClass . ' ' . $marginBottomClass; ?>">
                    <?php if($textContent): ?>
                        <div><?php echo $textContent; ?></div>
                    <?php endif; ?>
                    <?php if($ctaLink): 
                        $ctaUrl = $ctaLink['url'];
                        $ctaTitle = $ctaLink['title'];
                        $ctaTarget = $ctaLink['target'] ? $ctaLink['target'] : '_self';
                    ?>
                        <a href="<?php echo $ctaUrl; ?>" class="btn" data-text="<?php echo $ctaLabel; ?>" target="<?php echo $ctaTarget; ?>"><span><?php echo $ctaLabel; ?></span></a>
                    <?php endif; ?>
                </div>

            <?php elseif( get_row_layout() == 'title' ): 
                $level = get_sub_field('level');
                $title = get_sub_field('title');
                $theTitle = '<'. $level .'>'. $title . '</'. $level .'>';
                $alignmentClass = 'title--' . get_sub_field('alignment');
            ?>

                <div class="title <?php echo $alignmentClass; ?> title--section"><?php echo $theTitle; ?></div>

            <?php elseif( get_row_layout() == 'media_list' ): 
                $mainTitle = get_sub_field('main_title');
                $marginTopClass = get_sub_field('margin_top') != 'none' ? get_sub_field('margin_top') : '';
                $marginBottomClass = get_sub_field('margin_bottom') != 'none' ? get_sub_field('margin_bottom') : '';
            ?>
                <?php if($mainTitle): ?>
                    <div class="title title--center title--section"><h2><?php echo $mainTitle; ?></h2></div>
                <?php endif; ?> 

                <?php if( have_rows('list') ): ?>
                    <ul class="media-list <?php echo $marginTopClass . ' ' . $marginBottomClass; ?>">

                    <?php while( have_rows('list') ): the_row(); 
                        $image = get_sub_field('media');
                        $text = get_sub_field('text');
                        $link = get_sub_field('link');
                    ?>
                        
                        <li class="media-list__item">
                            <?php if($link): 
                                $linkUrl = $link['url'];
                                $linkTarget = $link['target'] ? $link['target'] : '_self';    
                            ?>
                                <a class="media-list__link" href="<?php echo $linkUrl; ?>" <?php echo $linkTarget; ?> title="<?php echo $text; ?>"></a>
                            <?php endif; ?>
                            <?php if(!empty( $image )): ?>
                                <div class="media">
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                </div>
                            <?php endif; ?>
                            <h3 class="media-list__title"><?php echo $text; ?></h3>
                        </li>

                    <?php endwhile; ?>

                    </ul>

                <?php endif; ?>

            <?php elseif( get_row_layout() == 'text_with_navigation' ): 
                $marginTopClass = get_sub_field('margin_top') != 'none' ? get_sub_field('margin_top') : '';
                $marginBottomClass = get_sub_field('margin_bottom') != 'none' ? get_sub_field('margin_bottom') : '';
            ?>

                <div class="block block--text-with-navigation <?php echo $marginTopClass . ' ' . $marginBottomClass; ?>">
                    <?php if( have_rows('list') ): ?>
                        <div class="text-with-navigation">
                            <nav class="text-with-navigation__nav">
                                <ul data-lenis-prevent>
                                <?php while( have_rows('list') ): the_row(); 
                                    $title = get_sub_field('title');
                                    $titleSlug = slugify($title);
                                ?>
                                    <?php if($title): ?>
                                        <li><a href="#<?php echo $titleSlug; ?>"><?php echo $title; ?></a></li>
                                    <?php endif; ?>
                                <?php endwhile ?>
                                </ul>
                            </nav>
                            <div class="text-with-navigation__content">
                                <?php while( have_rows('list') ): the_row(); 
                                    $title = get_sub_field('title');
                                    $titleSlug = slugify($title);
                                    $text = get_sub_field('text');
                                ?>   
                                    <?php if($title): ?>
                                        <h3 id="<?php echo $titleSlug; ?>"><?php echo $title; ?></h3>
                                    <?php endif; ?>

                                    <?php if($text): ?>
                                        <?php echo $text; ?>
                                    <?php endif; ?>


                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        <?php endwhile; ?>
        <?php endif; ?>

    <?php
};

add_action('woocommerce_after_single_product_summary', 'blone_content_block', 17);


function custom_woocommerce_flexslider_options() {
    if ( function_exists( 'is_product' ) && is_product() ) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                // Ensure FlexSlider is initialized
                if (typeof $.fn.flexslider === 'undefined') {
                    return;
                }
                
                // Customize FlexSlider settings
                $('.woocommerce-product-gallery').flexslider({
                    animation: 'fade',
                    animationSpeed: 600,
                    slideshow: true,
                    controlNav: 'thumbnails',
                });

                console.log($('.woocommerce-product-gallery').flexslider);
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'custom_woocommerce_flexslider_options', 20);

// Custom Product IMG Gallery

function remove_woocommerce_product_image_gallery() {
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
}
add_action( 'wp', 'remove_woocommerce_product_image_gallery' );

function custom_display_product_images() {
    global $product;

    $attachment_ids = $product->get_gallery_image_ids();
    
    if ( $attachment_ids && $product->get_image_id() ) {
        array_unshift( $attachment_ids, $product->get_image_id() );
    }

    if ( $attachment_ids && has_post_thumbnail() ) {
        echo '<div class="single-product__images">';

            echo '<div class="single-product__thumbnails">';
            $counter = 0;
            foreach ( $attachment_ids as $attachment_id ) {
                $image_url = wp_get_attachment_image_url( $attachment_id, 'medium' );
                echo '<div class="single-product__thumbnails__wrapper">';
                echo '<button class="single-product__thumbnails__media" data-index="'. $counter .'">';
                echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) . '" />';
                echo '</button>';
                echo '</div>';
                $counter++;
            }
            echo '</div>';

            echo '<div class="single-product__current">';
                $counter = 0;
                foreach ( $attachment_ids as $attachment_id ) {
                    $image_url = wp_get_attachment_image_url( $attachment_id, 'full' );
                    $activeClass = $counter === 0 ? 'single-product__current__media--is-active' : '';
                    echo '<div class="single-product__current__media '. $activeClass .'" data-related="'. $counter .'">';
                    echo '<img src="' . esc_url( $image_url ) . '" alt="' . esc_attr( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) . '" />';
                    echo '</div>';
                    $counter++;
                }
            echo '</div>';

        echo '</div>';
    }
}
add_action( 'woocommerce_before_single_product_summary', 'custom_display_product_images', 20 );

// Move price on the single product page

function blone_remove_woocommerce_single_product_price() {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
}
add_action( 'init', 'blone_remove_woocommerce_single_product_price' );

function blone_add_price_inside_cart() {
    global $product;
    
    echo '<div class="price">' . $product->get_price_html() . '</div>';
}
add_action( 'woocommerce_before_add_to_cart_button', 'blone_add_price_inside_cart', 10 ); // Choose an appropriate priority


// Display Cat on the Shop Page
function blone_display_cat_page_shop(){
?>
    <?php 
        $args = array(
            'post_type' => 'family',
            'posts_per_page' => -1, // Retrieves all posts
            'meta_query' => array(
                array(
                    'key' => 'related_product', // Replace with your actual relationship field name
                    'value' => '', // Ensure it has a value
                    'compare' => '!=', // Not equal to empty
                ),
            ),
        );
        
        $familyQuery = new WP_Query($args);

    if(is_shop() && $familyQuery->have_posts()): ?>
        <div class="title title--center title--section"><h2>Nos Familles olfactives</h2></div>
        <ul class="cat-list cat-list--v1">
            <?php while ($familyQuery->have_posts()) : $familyQuery->the_post(); 
                $relatedProduct = get_field('related_product')[0];
                $theProductTitle = get_the_title($relatedProduct);
                $theProductPermalink = get_the_permalink($relatedProduct);
                // print_r($relatedProduct);
            ?>
            <li class="cat-item">
                <div class="cat-item__main">
                    <a href="#" class="cat-item__link" title=""><span><?php echo the_title(); ?></span></a>
                    <h3 class="cat-item__title"><?php echo the_title(); ?></h3>
                </div>
                <div class="cat-item__info">
                    <p>Notre parfum <?php echo $theProductTitle; ?> a des notes lorem ipsum</p>
                    <a href="<?php echo $theProductPermalink; ?>" class="btn btn--dark-neg">Voir <?php echo $theProductTitle; ?></a>
                </div>
                <div class="cat-item__details">
                    <div class="cat-item__details__media">
                        <img src="https://assets.codepen.io/225413/blone-flower.png" alt="">
                    </div>
                    <div class="cat-item__details__text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium illo quod ad eos totam iste corporis quasi? Eos odio assumenda ratione quo dolor a nisi? Cum molestias inventore exercitationem obcaecati.</p>
                    </div>
                </div>
            </li>
            <?php endwhile; wp_reset_postdata(); ?>
        </ul>
    <?php endif; ?>
<?php
}

add_action( 'woocommerce_after_main_content', 'blone_display_cat_page_shop', 20 );

// Remove breadcrumbs from shop & categories
remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

function blone_show_subtitle_shop_page(){
    $title = get_field('header_title', get_correct_page_id());
    if($title && is_shop()){
        echo '<div class="title title--center title--section"><h2>'. strip_tags($title) .'</h2></div>';
    }
}

add_action( 'woocommerce_before_shop_loop', 'blone_show_subtitle_shop_page', 20 );


//Single product Add to card button AJAX

function custom_add_to_cart() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'custom_nonce')) {
        wp_send_json_error('Invalid nonce');
        return;
    }

    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    if (!$product_id || !$quantity) {
        wp_send_json_error('Invalid product ID or quantity');
        return;
    }

    $result = WC()->cart->add_to_cart($product_id, $quantity);

    if ($result) {
        // Get cart fragments and hash
        $fragments = WC_AJAX::get_refreshed_fragments();
        wp_send_json_success(array(
            'fragments' => $fragments['fragments'],
            'cart_hash' => $fragments['cart_hash']
        ));
    } else {
        wp_send_json_error('Failed to add product to cart');
    }
}
add_action('wp_ajax_custom_add_to_cart', 'custom_add_to_cart');
add_action('wp_ajax_nopriv_custom_add_to_cart', 'custom_add_to_cart');


add_filter('woocommerce_add_to_cart_fragments', 'custom_cart_fragment_update');

function custom_cart_fragment_update($fragments) {
    ob_start();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();

    $fragments['div.widget_shopping_cart_content'] = '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>';

    return $fragments;
};

// Add data-lenis-prevent to the .woocommerce-MyAccount-navigation

function start_myaccount_navigation_wrapper() {
    ob_start();
}
add_action( 'woocommerce_before_account_navigation', 'start_myaccount_navigation_wrapper', 5 );

function end_myaccount_navigation_wrapper() {
    $content = ob_get_clean();
    $content = str_replace('<nav class="woocommerce-MyAccount-navigation">', '<nav class="woocommerce-MyAccount-navigation" data-lenis-prevent>', $content);
    echo $content;
}
add_action( 'woocommerce_after_account_navigation', 'end_myaccount_navigation_wrapper', 15 );


// Custom Login Item Label (if logged In or Off)

function custom_menu_items($items, $menu, $args) {
    // Loop through each menu item
    foreach ($items as $item) {
        // Check if the menu item URL is the My Account URL
        // if (strpos($item->url, wc_get_page_permalink('myaccount')) !== false) {
        if (strpos($item->url, wc_get_page_permalink('myaccount')) !== false && !in_array('wpml-ls-item', $item->classes)) {
            
            // Change the title based on login status
            if (is_user_logged_in()) {
                $item->title = 'My Account';
            } else {
                $item->title = 'Login';
                // Optionally, you can change the URL to the login page if needed
                // $item->url = wp_login_url(); // Redirect to the login page
            }
        }
    }
    return $items;
}
add_filter('wp_get_nav_menu_items', 'custom_menu_items', 10, 3);



// Page checkout Wrap items
// Add the opening div before customer details
add_action( 'woocommerce_checkout_before_customer_details', 'custom_wrap_start', 1 );
function custom_wrap_start() {
    echo '<div class="checkout-grid">';
}

// Add the closing div after order review
add_action( 'woocommerce_checkout_after_order_review', 'custom_wrap_end', 20 );
function custom_wrap_end() {
    echo '</div>';
}

add_filter( 'woocommerce_product_tabs', 'remove_additional_information_tab', 98 );

function remove_additional_information_tab( $tabs ) {

 unset( $tabs['additional_information'] );

 return $tabs;

}










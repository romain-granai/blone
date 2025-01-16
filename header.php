<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php wp_head(); ?>
    <meta name="theme-color" content="FFFFFF">
</head>

<body <?php body_class(); ?> data-barba="wrapper">
    <?php wp_body_open(); ?>

    <?php

        // Define custom query arguments
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1, // To retrieve all products, use -1. You can specify a number to limit the posts.
            'post_status'    => 'publish'
        );

        // Instantiate the custom query
        $loop = new WP_Query( $args );

        // Initialize the JavaScript object as a string
        $products_js = 'let products = [';

        // Start the loop
        if ( $loop->have_posts() ) :
            $is_first_product = true;
            while ( $loop->have_posts() ) : $loop->the_post();
                global $product;
                
                // Get product title
                $product_title = get_the_title();
                
                // Get product permalink
                $permalink = get_permalink();

                // Initialize colors array
                $colors_array = [];

                $perfume = get_field('product_perfume');
                $volume = get_field('product_volume');

                // Fetch ACF color fields
                for ($i = 1; $i <= 4; $i++) {
                    $color = get_field('color_' . $i);
                    if ($color) {
                        $colors_array[] = $color;
                    }
                }

                // Append to the JavaScript object string
                $products_js .= '{';
                $products_js .= '"productTitle": "' . esc_js($product_title) . '",';
                $products_js .= '"perfume": "' . esc_js($perfume) . '",';
                $products_js .= '"volume": "' . esc_js($volume) . '",';
                $products_js .= '"colors": ' . json_encode($colors_array) . ',';
                $products_js .= '"permalink": "' . esc_url($permalink) . '"';
                $products_js .= '},';


            endwhile;

            // Remove the trailing comma and close the array
            $products_js = rtrim($products_js, ',') . '];';
        else :
            $products_js = 'let products = [];';
        endif;

        // Restore original Post Data
        wp_reset_postdata();
    ?>
    <script type="text/javascript">
        <?php echo $products_js; ?>
    </script>

    <div class="curtain"></div>
    <?php get_template_part( 'template-parts/topbar-navigation' ); ?>
    <?php 
        $namespace;
        if(is_front_page()){
            $namespace = 'home';
        } else if(is_singular( 'product' )){
            $namespace = 'single-product';
        } else if(is_shop()) {
            $namespace = 'shop';
        } else if(is_cart()) {
            $namespace = 'cart';
        } else if(is_account_page()) {
            $namespace = 'account';
        } else if(is_checkout()) {
            $namespace = 'checkout';
        } else {
            $namespace = 'page';
        }
    ?>
    <div data-barba="container" data-barba-namespace="<?php echo $namespace; ?>">
        <?php if(!is_singular( 'product' )):
            $pageID = get_correct_page_id();
            $headerSizeClass = get_field('header_size', $pageID) != 'regular' ? get_field('header_size', $pageID) : '';
            // $headerMediaType = get_field('header_media_type', $pageID); 
            $headerImg = get_field('header_image', $pageID);
            $headerText = get_field('header_title', $pageID) ? get_field('header_title', $pageID) : get_the_title($pageID);
        ?>

                <header class="header <?php echo $headerSizeClass; ?>">
                    <h1 class="d-none"><?php echo get_the_title($pageID); ?></h1>
                    <?php if(!is_account_page() && !is_cart() && !is_checkout()): ?>
                        <?php if(!empty( $headerImg )): ?>
                            <div class="header__media">
                                <img src="<?php echo esc_url($headerImg['url']); ?>" alt="<?php echo esc_attr($headerImg['alt']); ?>" />
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if($headerText): ?>
                        <div class="header__front"> 
                            <h2 class="header__text"><?php echo $headerText; ?></h2>
                        </div>
                    <?php endif; ?>
                </header>

        <?php endif; ?>
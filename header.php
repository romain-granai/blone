<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php wp_head(); ?>
    <meta name="theme-color" content="FFFFFF">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/media/img/favicon-dark.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/media/img/favicon-dark.ico" type="image/x-icon" media="(prefers-color-scheme: light)">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/assets/media/img/favicon-light.ico" type="image/x-icon" media="(prefers-color-scheme: dark)">
</head>

<body <?php body_class(); ?> data-barba="wrapper">
    <?php wp_body_open(); ?>
    

    <?php

        // Define custom query arguments
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'meta_query'     => array(
                array(
                  'key'     => 'show_on_bottle_screen', // ← exact ACF field name
                  'value'   => '1',                     // ACF true/false “true” is stored as string "1"
                  'compare' => '=',
                ),
              ),
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

    <?php get_template_part( 'template-parts/curtain' ); ?>
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
            $headerVideoMp4 = get_field('header_video_mp4');
            $headerVideoWebm = get_field('header_video_webm');
        ?>

                <header class="header <?php echo $headerSizeClass; ?>">
                    <h1 class="d-none"><?php echo get_the_title($pageID); ?></h1>
                    <?php if(!is_account_page() && !is_cart() && !is_checkout()): ?>
                        <?php if(!empty( $headerImg )): ?>
                            <div class="header__media">
                                <?php if(!$headerVideoMp4 || !$headerVideoWebm): ?>
                                <img src="<?php echo esc_url($headerImg['url']); ?>" alt="<?php echo esc_attr($headerImg['alt']); ?>" />
                                <?php else: 
                                    $videoMp4Url = $headerVideoMp4['url'];
                                    $videoWebmUrl = $headerVideoWebm['url'];
                                ?>
                                <!-- <video src="<?php echo $videoUrl; ?>" muted loop preload playsinline paused autoplay></video> -->
                                <video muted loop preload="auto" playsinline autoplay>
                                    <source src="<?php echo $videoMp4Url; ?>" type="video/mp4"/>
                                    <source src="<?php echo $videoWebmUrl; ?>" type="video/webm"/>
                                </video>
                                <?php endif; ?>
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
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

                <header class="header block block--full-media block--full-media--wave block--full-media--text-bl <?php echo $headerSizeClass; ?>">
                    <h1 class="d-none"><?php echo get_the_title($pageID); ?></h1>
                    <div class="media">
                        <?php if(!empty( $headerImg )): ?>
                            <img src="<?php echo esc_url($headerImg['url']); ?>" alt="<?php echo esc_attr($headerImg['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                    <?php if($headerText): ?>
                        <div class="block--full-media__front"> 
                            <h2 class="block--full-media__text"><?php echo $headerText; ?></h2>
                        </div>
                    <?php endif; ?>
                </header>

        <?php endif; ?>
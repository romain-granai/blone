<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <?php wp_head(); ?>
    <meta name="theme-color" content="000000">
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
        } else {
            $namespace = 'page';
        }
    ?>
    <div data-barba="container" data-barba-namespace="<?php echo $namespace; ?>">
        <?php if(!is_singular( 'product' )): ?>
            <header class="header block block--full-media block--full-media--viewport"> <!-- block--full-media--viewport -->
                <div class="media">
                    <img src="<?php echo get_template_directory_uri()?>/assets/media/img/header-1.png" alt="">
                </div>
                <span class="block--full-media__text">Notre <br>Univers</span>
            </header>
            <header class="header block block--full-media block--full-media--viewport"> <!-- block--full-media--viewport -->
                <div class="media">
                    <img src="<?php echo get_template_directory_uri()?>/assets/media/img/header-2.png" alt="">
                </div>
                <h1 class="block--full-media__text">Dare <br>To Be</h1>
            </header>
            <div class="block block--full-media block--full-media--viewport"> <!-- block--full-media--viewport -->
                <div class="media">
                    <video src="https://cdn.sanity.io/files/pwab4i5g/production/7519ca403d8da66754c0d908be1909e2b9cfe322.mp4"  loop="" muted="" playsinline=""></video>
                </div>
                <span class="block--full-media__text">Test <br>with Video</span>
            </div>
            <header class="header block block--full-media block--full-media--viewport"> <!-- block--full-media--viewport -->
                <div class="media">
                    <img src="<?php echo get_template_directory_uri()?>/assets/media/img/header-3.png" alt="">
                </div>
                <span class="block--full-media__text">Berite <br>Labelle</span>
            </header>

            <header class="header block block--full-media block--full-media--sm"> <!-- block--full-media--viewport -->
                <div class="media">
                    <img src="<?php echo get_template_directory_uri()?>/assets/media/img/header-1.png" alt="">
                </div>
                <span class="block--full-media__text">Notre <br>Univers</span>
            </header>

            
        <?php endif; ?>
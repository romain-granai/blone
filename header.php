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
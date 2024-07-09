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
    <div class="curtain"></div>
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
        <?php if(!is_singular( 'product' )):
            $pageID = get_correct_page_id();
            $headerMediaType = get_field('header_media_type', $pageID); 
            $headerImg = get_field('header_image', $pageID);
            $headerVideo = get_field('header_video', $pageID);
            $headerText = get_field('header_title', $pageID);
        ?>

                <header class="header block block--full-media block--full-media--wave block--full-media--text-bl">
                    <h1 class="d-none"><?php echo get_the_title($pageID); ?></h1>
                    <div class="media">
                        <?php if($headerMediaType == 'image'): ?>
                            <?php if(!empty( $headerImg )): ?>
                                <img src="<?php echo esc_url($headerImg['url']); ?>" alt="<?php echo esc_attr($headerImg['alt']); ?>" />
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if($headerVideo): ?>
                                <video src="<?php echo $headerVideo['url']; ?>"  loop="" muted="" playsinline=""></video>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if($headerText): ?>
                        <div class="block--full-media__front"> 
                            <h2 class="block--full-media__text"><?php echo $headerText; ?></h2>
                        </div>
                    <?php endif; ?>
                </header>

        <?php endif; ?>
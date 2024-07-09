<!-- <?php if( have_rows('content_blocks') ): ?>

<?php while( have_rows('content_blocks') ): the_row(); ?>

    <?php if( get_row_layout() == 'full_media' ): 
        $mainTitle = get_sub_field('main_title');
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

        <div class="block block--full-media <?php echo $textPositionClass . ' ' . $ctaPositionClass . ' ' . $typeClass . ' ' . $marginTopClass . ' ' . $marginBottomClass; ?>"> 
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
                    <span class="block--full-media__text"><?php echo $text; ?></span>
                <?php endif; ?>
                <?php if($ctaLabel && $ctaLink): ?>
                    <a href="<?php echo $ctaUrl ?>" class="btn" data-text="<?php echo $ctaLabel; ?>" target="<?php echo $ctaTarget; ?>" title="<?php echo $ctaTitle ?>"><span><?php echo $ctaLabel; ?></span></a>
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
        $ctaUrl = $ctaLink['url'];
        $ctaTitle = $ctaLink['title'];
        $ctaTarget = $ctaLink['target'] ? $ctaLink['target'] : '_self';
        $marginTopClass = get_sub_field('margin_top') != 'none' ? get_sub_field('margin_top') : '';
        $marginBottomClass = get_sub_field('margin_bottom') != 'none' ? get_sub_field('margin_bottom') : '';
    ?>

        <?php if($mainTitle): ?>
            <div class="title title--center title--section"><h2><?php echo $mainTitle; ?></h2></div>
        <?php endif; ?> 

        <div class="block block--just-text <?php echo $marginTopClass . ' ' . $marginBottomClass; ?>">
            <?php if($textContent): ?>
                <?php echo $textContent; ?>
            <?php endif; ?>
            <?php if($ctaLink): ?>
                <a href="<?php echo $ctaUrl; ?>" class="btn" data-text="<?php echo $ctaLabel; ?>" target="<?php echo $ctaTarget; ?>"><span><?php echo $ctaLabel; ?></span></a>
            <?php endif; ?>
        </div>

    <?php elseif( get_row_layout() == 'title' ): 
        $level = get_sub_field('level');
        $title = get_sub_field('title');
        $theTitle = '<'. $level .'>'. $title . '</'. $level .'>';
        $alignmentClass = 'title--' . get_sub_field('alignment');
    ?>

        <div class="title <?php echo $alignmentClass; ?>"><?php echo $theTitle; ?></div>

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
                $linkUrl = $link['url'];
                $linkTarget = $Link['target'] ? $Link['target'] : '_self';
            ?>

                <li class="media-list__item">
                    <?php if($link): ?>
                        <a class="media-list__link" href="<?php echo $linkUrl; ?>" title="<?php echo $text; ?>"></a>
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
<?php endif; ?> -->

<?php blone_content_block(); ?>

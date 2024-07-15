
<?php get_header(); ?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile; endif; ?>

    <?php get_template_part( 'template-parts/home-bottle-screen' ); ?>

    <?php blone_content_block(); ?>

<?php get_footer(); ?>
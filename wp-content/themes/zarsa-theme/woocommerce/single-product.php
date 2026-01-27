<?php get_header(); ?>

<main class="product-detail" style="padding: 96px 24px; max-width: 800px; margin: auto;">
    <?php
    while ( have_posts() ) : the_post();
        wc_get_template_part( 'content', 'single-product' );
    endwhile;
    ?>
</main>

<?php get_footer(); ?>

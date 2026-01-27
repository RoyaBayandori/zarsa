<?php get_header(); ?>

<main class="shop" style="padding: 96px 24px; max-width: 1200px; margin: auto;">
    <?php if ( have_posts() ) : ?>
        <div class="products-grid">
            <?php woocommerce_product_loop_start(); ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php wc_get_template_part( 'content', 'product' ); ?>
                <?php endwhile; ?>
            <?php woocommerce_product_loop_end(); ?>
        </div>
    <?php else : ?>
        <p>No products found</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>

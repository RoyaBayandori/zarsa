<?php
// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header(); ?>

<div class="shop-container">
    <?php if ( function_exists( 'woocommerce_breadcrumb' ) ) {
        woocommerce_breadcrumb();
    } ?>

    <main class="shop-main">
        <?php
        if ( woocommerce_product_loop() ) {
            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                    the_post();
                    wc_get_template_part( 'content', 'product' );
                }
            }

            woocommerce_product_loop_end();
        } else {
            echo '<p class="no-products">No products found</p>';
        }
        ?>
    </main>
</div>

<?php get_footer(); ?>

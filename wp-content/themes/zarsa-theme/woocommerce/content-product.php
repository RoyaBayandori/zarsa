<?php
defined( 'ABSPATH' ) || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>

<li <?php wc_product_class( 'zarsa-product-card', $product ); ?>>

    <div class="zarsa-product-inner">

        <div class="zarsa-product-image">
            <a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View %s', 'zarsa-theme' ), get_the_title() ) ); ?>">
                <?php
                if ( has_post_thumbnail() ) {
                    echo get_the_post_thumbnail( $product->get_id(), 'full', [
                        'class'   => 'zarsa-thumb',
                        'loading' => 'lazy',
                    ] );
                } else {
                    echo wc_placeholder_img( 'woocommerce_thumbnail' );
                }
                ?>
            </a>
        </div>

        <div class="zarsa-product-content">

            <h3 class="zarsa-product-title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>

            <div class="zarsa-product-price">
                <?php woocommerce_template_loop_price(); ?>
            </div>

        </div>

    </div>

</li>

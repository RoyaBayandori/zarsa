<?php
defined('ABSPATH') || exit;
global $product;
?>

<section class="product-hero">

  <div class="product-hero-inner">

    <!-- Gallery -->
    <div class="product-gallery">
      <?php
        if ( has_post_thumbnail() ) {
          echo get_the_post_thumbnail(
            $product->get_id(),
            'full',
            ['class' => 'product-main-image']
          );
        }
      ?>
    </div>

    <!-- Identity -->
    <div class="product-identity">

      <h1 class="product-title">
        <?php the_title(); ?>
      </h1>

      <div class="product-price">
        <?php woocommerce_template_single_price(); ?>
      </div>

      <?php if ( has_excerpt() ) : ?>
        <div class="product-excerpt">
          <?php the_excerpt(); ?>
        </div>
      <?php endif; ?>

      <div class="product-cta">
        <?php woocommerce_template_single_add_to_cart(); ?>
      </div>

    </div>

  </div>

</section>

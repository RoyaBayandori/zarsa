<?php if ( get_field('product_details') ) : ?>

<section class="product-details">

  <div class="product-details-inner">

    <div class="detail-text">
      <?php echo nl2br( esc_html( get_field('product_details') ) ); ?>
    </div>

  </div>

</section>

<?php endif; ?>
<?php if ( get_field('why_this_piece') ) : ?>

<section class="product-value">

  <div class="product-value-inner">

    <h2 class="product-value-title"><?php esc_html_e( 'Why This Piece', 'zarsa-theme' ); ?></h2>

    <ul class="product-value-list">

      <?php
      $items = explode("\n", get_field('why_this_piece'));

      foreach ( $items as $item ) :
        if ( trim($item) ) :
      ?>

        <li><?php echo esc_html( trim($item) ); ?></li>

      <?php
        endif;
      endforeach;
      ?>

    </ul>

  </div>

</section>

<?php endif; ?>
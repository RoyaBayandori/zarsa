<?php
defined( 'ABSPATH' ) || exit;

$story_text = get_field( 'story_text' );
?>

<section class="product-story">
  <div class="product-story-inner">

    <?php if ( $story_text ) : ?>
    <div class="product-story-editorial">
      <h2 class="product-story-title"><?php esc_html_e( 'Crafted with Purpose', 'zarsa-theme' ); ?></h2>
      <div class="product-story-description">
        <?php echo wpautop( wp_kses_post( $story_text ) ); ?>
      </div>
    </div>
    <?php endif; ?>

    <div class="product-story-body">
      <?php the_content(); ?>
    </div>

  </div>
</section>

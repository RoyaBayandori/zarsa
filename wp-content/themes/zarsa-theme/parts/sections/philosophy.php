<?php
defined( 'ABSPATH' ) || exit;

$title = zarsa_home_field( 'philosophy_title' );
$text  = zarsa_home_field( 'philosophy_text' );
$image = zarsa_home_field( 'philosophy_image' );
?>

<section class="philosophy section-warm" id="philosophy">
  <div class="container philosophy-grid">

    <div class="philosophy-text">
      <?php if ( $title ) : ?>
        <h2><?php echo esc_html( $title ); ?></h2>
      <?php endif; ?>

      <?php if ( $text ) : ?>
        <p><?php echo nl2br( esc_html( $text ) ); ?></p>
      <?php endif; ?>
    </div>

    <div class="philosophy-image">
      <?php if ( is_array( $image ) && ! empty( $image['url'] ) ) : ?>
        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="">
      <?php endif; ?>
    </div>

  </div>
</section>

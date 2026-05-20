<?php
defined( 'ABSPATH' ) || exit;

$title = zarsa_home_field( 'gifting_title' );
$text  = zarsa_home_field( 'gifting_text' );
$image = zarsa_home_field( 'gifting_image' );
$cta_t = zarsa_home_field( 'gifting_cta_text' );
$cta_l = zarsa_home_field( 'gifting_cta_link' );

$has_content = $title || $text || $image;
?>

<section class="gifting section-cream<?php echo $has_content ? '' : ' gifting--quiet'; ?>" id="gifting">
  <div class="container">

    <?php if ( $has_content ) : ?>
    <div class="gifting-grid">
      <?php if ( $image && is_array( $image ) && ! empty( $image['url'] ) ) : ?>
        <div class="gifting-image">
          <img src="<?php echo esc_url( $image['url'] ); ?>" alt="">
        </div>
      <?php endif; ?>

      <div class="gifting-content">
        <?php if ( $title ) : ?>
          <h2><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <?php if ( $text ) : ?>
          <p><?php echo nl2br( esc_html( $text ) ); ?></p>
        <?php endif; ?>

        <?php if ( $cta_t && is_array( $cta_l ) && ! empty( $cta_l['url'] ) ) : ?>
          <a href="<?php echo esc_url( $cta_l['url'] ); ?>"
             class="btn btn-outline"
             target="<?php echo esc_attr( ! empty( $cta_l['target'] ) ? $cta_l['target'] : '_self' ); ?>">
            <?php echo esc_html( $cta_t ); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
    <?php else : ?>
    <div class="zarsa-home-section-quiet" aria-hidden="true"></div>
    <?php endif; ?>

  </div>
</section>

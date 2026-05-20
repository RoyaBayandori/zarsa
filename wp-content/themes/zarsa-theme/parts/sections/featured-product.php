<?php
defined( 'ABSPATH' ) || exit;

$section_title = zarsa_home_field( 'featured_section_title' );
$image         = zarsa_home_field( 'featured_image' );
$title         = zarsa_home_field( 'featured_title' );
$text          = zarsa_home_field( 'featured_text' );
$btn_text      = zarsa_home_field( 'featured_button_text' );
$btn_link      = zarsa_home_field( 'featured_button_link' );

$has_content = $title || ( is_array( $image ) && ! empty( $image['url'] ) );
?>

<section class="featured-product section-warm<?php echo $has_content ? '' : ' featured-product--quiet'; ?>">
  <div class="container">

    <?php if ( $has_content ) : ?>
    <div class="featured-grid">
      <div class="featured-image">
        <?php if ( is_array( $image ) && ! empty( $image['url'] ) ) : ?>
          <img src="<?php echo esc_url( $image['url'] ); ?>" alt="">
        <?php endif; ?>
      </div>

      <div class="featured-content">

        <?php if ( $section_title ) : ?>
          <span class="featured-label"><?php echo esc_html( $section_title ); ?></span>
        <?php endif; ?>

        <?php if ( $title ) : ?>
          <h2><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>

        <?php if ( $text ) : ?>
          <p><?php echo nl2br( esc_html( $text ) ); ?></p>
        <?php endif; ?>

        <?php if ( $btn_text && is_array( $btn_link ) && ! empty( $btn_link['url'] ) ) : ?>
          <a href="<?php echo esc_url( $btn_link['url'] ); ?>"
             class="btn-primary"
             target="<?php echo esc_attr( ! empty( $btn_link['target'] ) ? $btn_link['target'] : '_self' ); ?>">
            <?php echo esc_html( $btn_text ); ?>
          </a>
        <?php endif; ?>

      </div>
    </div>
    <?php else : ?>
    <div class="zarsa-home-section-quiet" aria-hidden="true"></div>
    <?php endif; ?>

  </div>
</section>

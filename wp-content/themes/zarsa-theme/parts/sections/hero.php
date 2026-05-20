<?php
defined( 'ABSPATH' ) || exit;

$bg       = zarsa_home_field( 'hero_background' );
$title    = zarsa_home_field( 'hero_title' );
$subtitle = zarsa_home_field( 'hero_subtitle' );
$link     = zarsa_home_field( 'hero_button_link' );
?>

<section class="hero" id="home"
  style="background-image: url('<?php echo esc_url( is_array( $bg ) && ! empty( $bg['url'] ) ? $bg['url'] : '' ); ?>')">

  <div class="hero-overlay"></div>

  <div class="hero-content container">
    <?php if ( $title ) : ?>
      <h1><?php echo esc_html( $title ); ?></h1>
    <?php endif; ?>

    <?php if ( $subtitle ) : ?>
      <p><?php echo esc_html( $subtitle ); ?></p>
    <?php endif; ?>

    <?php if ( is_array( $link ) && ! empty( $link['url'] ) ) : ?>
      <a href="<?php echo esc_url( $link['url'] ); ?>"
         class="btn-primary"
         target="<?php echo esc_attr( ! empty( $link['target'] ) ? $link['target'] : '_self' ); ?>">
        <?php echo esc_html( ! empty( $link['title'] ) ? $link['title'] : '' ); ?>
      </a>
    <?php endif; ?>
  </div>
</section>

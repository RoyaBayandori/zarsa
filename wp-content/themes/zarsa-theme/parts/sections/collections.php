<?php
defined( 'ABSPATH' ) || exit;

$title    = zarsa_home_field( 'collections_title' );
$subtitle = zarsa_home_field( 'collections_subtitle' );

$collections = array(
  zarsa_home_field( 'collection_1' ),
  zarsa_home_field( 'collection_2' ),
  zarsa_home_field( 'collection_3' ),
);

$has_grid = $title && ! empty( array_filter( $collections ) );
?>

<section class="collections section-white<?php echo $has_grid ? '' : ' collections--quiet'; ?>" id="collections">
  <div class="container">

    <?php if ( $has_grid ) : ?>
    <header class="collections-header">
      <h2><?php echo esc_html( $title ); ?></h2>
      <?php if ( $subtitle ) : ?>
        <p><?php echo esc_html( $subtitle ); ?></p>
      <?php endif; ?>
    </header>

    <div class="collections-grid">
      <?php foreach ( $collections as $item ) : ?>
        <?php if ( ! $item ) { continue; } ?>
        <?php
        $item_link = is_array( $item ) && isset( $item['link'] ) ? $item['link'] : '';
        if ( is_array( $item_link ) && isset( $item_link['url'] ) ) {
            $item_link = $item_link['url'];
        }
        $item_image = is_array( $item ) && isset( $item['image'] ) ? $item['image'] : null;
        $item_title = is_array( $item ) && isset( $item['title'] ) ? $item['title'] : '';
        $item_text  = is_array( $item ) && isset( $item['text'] ) ? $item['text'] : '';
        ?>
        <a class="collection-card" href="<?php echo esc_url( $item_link ); ?>">
          <?php if ( is_array( $item_image ) && ! empty( $item_image['url'] ) ) : ?>
            <div class="collection-image">
              <img src="<?php echo esc_url( $item_image['url'] ); ?>" alt="">
            </div>
          <?php endif; ?>

          <div class="collection-content">
            <h3><?php echo esc_html( $item_title ); ?></h3>
            <p><?php echo esc_html( $item_text ); ?></p>
          </div>
        </a>

      <?php endforeach; ?>
    </div>
    <?php else : ?>
    <div class="zarsa-home-section-quiet" aria-hidden="true"></div>
    <?php endif; ?>

  </div>
</section>

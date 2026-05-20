<?php
defined( 'ABSPATH' ) || exit;

$title = zarsa_home_field( 'trust_section_title' );

$t1_icon  = zarsa_home_field( 'trust_1_icon' );
$t1_title = zarsa_home_field( 'trust_1_title' );
$t1_text  = zarsa_home_field( 'trust_1_text' );

$t2_icon  = zarsa_home_field( 'trust_2_icon' );
$t2_title = zarsa_home_field( 'trust_2_title' );
$t2_text  = zarsa_home_field( 'trust_2_text' );

$t3_icon  = zarsa_home_field( 'trust_3_icon' );
$t3_title = zarsa_home_field( 'trust_3_title' );
$t3_text  = zarsa_home_field( 'trust_3_text' );

$has_content = $title || $t1_title || $t2_title || $t3_title;
?>

<section class="trust-section section-white<?php echo $has_content ? '' : ' trust-section--quiet'; ?>">
  <div class="container">

    <?php if ( $title ) : ?>
      <h2 class="trust-title"><?php echo esc_html( $title ); ?></h2>
    <?php endif; ?>

    <div class="trust-grid">

      <div class="trust-item">
        <?php if ( $t1_icon ) : ?><div class="trust-icon"><?php echo esc_html( $t1_icon ); ?></div><?php endif; ?>
        <?php if ( $t1_title ) : ?><h3><?php echo esc_html( $t1_title ); ?></h3><?php endif; ?>
        <?php if ( $t1_text ) : ?><p><?php echo esc_html( $t1_text ); ?></p><?php endif; ?>
      </div>

      <div class="trust-item">
        <?php if ( $t2_icon ) : ?><div class="trust-icon"><?php echo esc_html( $t2_icon ); ?></div><?php endif; ?>
        <?php if ( $t2_title ) : ?><h3><?php echo esc_html( $t2_title ); ?></h3><?php endif; ?>
        <?php if ( $t2_text ) : ?><p><?php echo esc_html( $t2_text ); ?></p><?php endif; ?>
      </div>

      <div class="trust-item">
        <?php if ( $t3_icon ) : ?><div class="trust-icon"><?php echo esc_html( $t3_icon ); ?></div><?php endif; ?>
        <?php if ( $t3_title ) : ?><h3><?php echo esc_html( $t3_title ); ?></h3><?php endif; ?>
        <?php if ( $t3_text ) : ?><p><?php echo esc_html( $t3_text ); ?></p><?php endif; ?>
      </div>

    </div>

    <?php if ( ! $has_content ) : ?>
    <div class="zarsa-home-section-quiet" aria-hidden="true"></div>
    <?php endif; ?>

  </div>
</section>

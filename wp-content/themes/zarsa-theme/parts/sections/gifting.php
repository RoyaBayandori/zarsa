<?php
defined('ABSPATH') || exit;

$title = get_field('gifting_title');
$text  = get_field('gifting_text');
$image = get_field('gifting_image');
$cta_t = get_field('gifting_cta_text');
$cta_l = get_field('gifting_cta_link');

if (!$title && !$text && !$image) return;
?>

<section class="gifting section-cream" id="gifting">
  <div class="container gifting-grid">

    <?php if ($image): ?>
      <div class="gifting-image">
        <img src="<?php echo esc_url($image['url']); ?>" alt="">
      </div>
    <?php endif; ?>

    <div class="gifting-content">
      <?php if ($title): ?>
        <h2><?php echo esc_html($title); ?></h2>
      <?php endif; ?>

      <?php if ($text): ?>
        <p><?php echo nl2br(esc_html($text)); ?></p>
      <?php endif; ?>

      <?php if ($cta_t && $cta_l): ?>
        <a href="<?php echo esc_url($cta_l); ?>" class="btn btn-outline">
          <?php echo esc_html($cta_t); ?>
        </a>
      <?php endif; ?>
    </div>

  </div>
</section>

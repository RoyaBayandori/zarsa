<?php
defined('ABSPATH') || exit;

$section_title = get_field('featured_section_title');
$image = get_field('featured_image');
$title = get_field('featured_title');
$text  = get_field('featured_text');
$btn_text = get_field('featured_button_text');
$btn_link = get_field('featured_button_link');

if (!$title && !$image) return;
?>

<section class="featured-product section-warm">
  <div class="container featured-grid">

    <div class="featured-image">
      <?php if ($image): ?>
        <img src="<?php echo esc_url($image['url']); ?>" alt="">
      <?php endif; ?>
    </div>

    <div class="featured-content">

      <?php if ($section_title): ?>
        <span class="featured-label"><?php echo esc_html($section_title); ?></span>
      <?php endif; ?>

      <?php if ($title): ?>
        <h2><?php echo esc_html($title); ?></h2>
      <?php endif; ?>

      <?php if ($text): ?>
        <p><?php echo nl2br(esc_html($text)); ?></p>
      <?php endif; ?>

      <?php if ($btn_text && $btn_link): ?>
        <a href="<?php echo esc_url($btn_link); ?>" class="btn-primary">
          <?php echo esc_html($btn_text); ?>
        </a>
      <?php endif; ?>

    </div>

  </div>
</section>

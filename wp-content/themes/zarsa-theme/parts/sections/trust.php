<?php
defined('ABSPATH') || exit;

$title = get_field('trust_section_title');

$t1_icon  = get_field('trust_1_icon');
$t1_title = get_field('trust_1_title');
$t1_text  = get_field('trust_1_text');

$t2_icon  = get_field('trust_2_icon');
$t2_title = get_field('trust_2_title');
$t2_text  = get_field('trust_2_text');

$t3_icon  = get_field('trust_3_icon');
$t3_title = get_field('trust_3_title');
$t3_text  = get_field('trust_3_text');

if (!$title && !$t1_title && !$t2_title && !$t3_title) return;
?>

<section class="trust-section section-white">
  <div class="container">

    <?php if ($title): ?>
      <h2 class="trust-title"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <div class="trust-grid">

      <div class="trust-item">
        <?php if ($t1_icon): ?><div class="trust-icon"><?php echo esc_html($t1_icon); ?></div><?php endif; ?>
        <?php if ($t1_title): ?><h3><?php echo esc_html($t1_title); ?></h3><?php endif; ?>
        <?php if ($t1_text): ?><p><?php echo esc_html($t1_text); ?></p><?php endif; ?>
      </div>

      <div class="trust-item">
        <?php if ($t2_icon): ?><div class="trust-icon"><?php echo esc_html($t2_icon); ?></div><?php endif; ?>
        <?php if ($t2_title): ?><h3><?php echo esc_html($t2_title); ?></h3><?php endif; ?>
        <?php if ($t2_text): ?><p><?php echo esc_html($t2_text); ?></p><?php endif; ?>
      </div>

      <div class="trust-item">
        <?php if ($t3_icon): ?><div class="trust-icon"><?php echo esc_html($t3_icon); ?></div><?php endif; ?>
        <?php if ($t3_title): ?><h3><?php echo esc_html($t3_title); ?></h3><?php endif; ?>
        <?php if ($t3_text): ?><p><?php echo esc_html($t3_text); ?></p><?php endif; ?>
      </div>

    </div>
  </div>
</section>

<?php
$bg      = get_field('hero_background');
$title   = get_field('hero_title');
$subtitle= get_field('hero_subtitle');
$link    = get_field('hero_button_link');
?>

<section class="hero" id="home"
  style="background-image: url('<?php echo esc_url($bg['url'] ?? ''); ?>')">

  <div class="hero-overlay"></div>

  <div class="hero-content container">
    <?php if ($title): ?>
      <h1><?php echo esc_html($title); ?></h1>
    <?php endif; ?>

    <?php if ($subtitle): ?>
      <p><?php echo esc_html($subtitle); ?></p>
    <?php endif; ?>

    <?php if ($link): ?>
      <a href="<?php echo esc_url($link['url']); ?>"
         class="btn-primary"
         target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
        <?php echo esc_html($link['title']); ?>
      </a>
    <?php endif; ?>
  </div>
</section>

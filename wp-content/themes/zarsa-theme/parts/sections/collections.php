<?php
defined('ABSPATH') || exit;

$title    = get_field('collections_title');
$subtitle = get_field('collections_subtitle');

$collections = [
  get_field('collection_1'),
  get_field('collection_2'),
  get_field('collection_3'),
];

if (!$title || empty(array_filter($collections))) return;
?>

<section class="collections section-white" id="collections">
  <div class="container">

    <header class="collections-header">
      <h2><?php echo esc_html($title); ?></h2>
      <?php if ($subtitle): ?>
        <p><?php echo esc_html($subtitle); ?></p>
      <?php endif; ?>
    </header>

    <div class="collections-grid">
      <?php foreach ($collections as $item): ?>
        <?php if (!$item) continue; ?>

        <a class="collection-card" href="<?php echo esc_url($item['link']); ?>">
          <?php if (!empty($item['image'])): ?>
            <div class="collection-image">
              <img src="<?php echo esc_url($item['image']['url']); ?>" alt="">
            </div>
          <?php endif; ?>

          <div class="collection-content">
            <h3><?php echo esc_html($item['title']); ?></h3>
            <p><?php echo esc_html($item['text']); ?></p>
          </div>
        </a>

      <?php endforeach; ?>
    </div>

  </div>
</section>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header" style="background: var(--bg-main); padding: 16px 0;">
  <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
    
    <!-- Logo -->
    <div class="logo">
      <a href="<?php echo home_url(); ?>" style="font-family: 'Playfair Display', serif; font-size: 24px; color: var(--text-main); text-decoration: none;">ZARSA</a>
    </div>

    <!-- Navigation -->
    <nav class="main-nav">
      <ul style="list-style: none; display: flex; gap: 32px; margin: 0; padding: 0; font-family: 'Inter', sans-serif; font-size: 16px;">
        <li><a href="#" style="color: var(--text-main); text-decoration: none;">Collection</a></li>
        <li><a href="#" style="color: var(--text-main); text-decoration: none;">Gift Boxes</a></li>
        <li><a href="#" style="color: var(--text-main); text-decoration: none;">Our Story</a></li>
        <li><a href="#" style="color: var(--text-main); text-decoration: none;">Contact</a></li>
      </ul>
    </nav>

    <!-- Cart Icon -->
    <!-- <div class="cart">
      <?php if ( function_exists('wc_get_cart_url') ) : ?>
        <a href="<?php echo wc_get_cart_url(); ?>" style="color: var(--text-main); font-size: 20px; text-decoration: none;">🛒</a>
      <?php endif; ?>
    </div> -->

  </div>
</header>
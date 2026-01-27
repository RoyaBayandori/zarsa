<?php
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="site-header" id="siteHeader">
    <div class="header-inner container">

        <!-- Logo -->
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">ZARSA</a>
            <span class="tagline">Pure Taste. Elegant Selection.</span>
        </div>

        <!-- Mobile Toggle -->
        <div class="mobile-menu-toggle" id="mobileToggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <!-- Navigation -->
        <nav class="main-nav" id="mainNav">

            <!-- Mobile Close Button -->
            <div class="mobile-menu-close" id="mobileClose">×</div>

            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'nav-menu'
            ));
            ?>
        </nav>

        <!-- Cart -->
        <div class="header-cart">
            <a href="<?php echo wc_get_cart_url(); ?>" aria-label="Cart">
                🛒
            </a>
        </div>

    </div>
</header>

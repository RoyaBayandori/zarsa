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
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="header-cart-link" aria-label="<?php esc_attr_e( 'Cart', 'zarsa-theme' ); ?>">
                <svg class="header-cart-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                    <path d="M8 9h8l-1.25 9.25H9.25L8 9z" stroke="currentColor" stroke-width="1.25" stroke-linejoin="round"/>
                    <path d="M10 9V7.25a2 2 0 0 1 4 0V9" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/>
                </svg>
            </a>
        </div>

    </div>
</header>

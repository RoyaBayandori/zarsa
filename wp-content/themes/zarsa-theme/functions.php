<?php
// ==============================
// Zarsa Theme Functions
// ==============================

// Theme Setup
function zarsa_theme_setup() {
    add_theme_support( 'menus' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array( 'primary' => __( 'Primary Menu', 'zarsa-theme' ) ) );
}
add_action( 'after_setup_theme', 'zarsa_theme_setup' );

// Enqueue style.css
function zarsa_enqueue_styles() {
    wp_enqueue_style( 'zarsa-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) ?: '1.0' );
}
add_action( 'wp_enqueue_scripts', 'zarsa_enqueue_styles' );

// ==============================
// WooCommerce Cleanup
// ==============================
add_filter('woocommerce_enqueue_styles', '__return_false'); // Remove default styles
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20); // Remove breadcrumbs

// ============================
// ACF Options Page
// ============================
if ( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'  => 'Theme Settings',
        'menu_title'  => 'Theme Settings',
        'menu_slug'   => 'theme-settings',
        'capability'  => 'edit_posts',
        'redirect'    => false
    ));

}

// Remove emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Remove embeds
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

function zarsa_enqueue_assets() {

    wp_enqueue_script(
        'zarsa-enterprise-ui',
        get_template_directory_uri() . '/assets/js/enterprise-ui.js',
        array(),
        '1.0.0',
        true // footer
    );

}
add_action('wp_enqueue_scripts', 'zarsa_enqueue_assets');

add_filter('woocommerce_currency_symbol', function($currency_symbol, $currency) {
    if ($currency === 'AED') {
        return 'AED';
    }
    return $currency_symbol;
}, 10, 2);

add_filter('woocommerce_price_format', function($format, $currency_pos) {
    if ($currency_pos === 'left') {
        return '%2$s %1$s'; // AED 200
    }
    return $format;
}, 10, 2);

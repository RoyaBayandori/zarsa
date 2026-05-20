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

/**
 * Theme typography: Inter (body/UI) + Playfair Display (headings).
 * Weights match existing CSS only — no new families or sizes.
 */
function zarsa_enqueue_fonts() {
    wp_enqueue_style(
        'zarsa-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display:wght@500;700&display=swap',
        array(),
        null
    );
}
add_action( 'wp_enqueue_scripts', 'zarsa_enqueue_fonts', 5 );

// Enqueue style.css
function zarsa_enqueue_styles() {
    wp_enqueue_style(
        'zarsa-style',
        get_stylesheet_uri(),
        array( 'zarsa-fonts' ),
        wp_get_theme()->get( 'Version' ) ?: '1.0'
    );
}
add_action( 'wp_enqueue_scripts', 'zarsa_enqueue_styles' );

// ==============================
// WooCommerce Cleanup
// ==============================
add_filter('woocommerce_enqueue_styles', '__return_false'); // Remove default styles
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20); // Remove breadcrumbs

// ============================
// Homepage CMS (ACF Free — dedicated Page, slug: home)
// ============================

/**
 * Resolve the editorial homepage Page ID (slug: home).
 *
 * @return int Post ID, or 0 if the Home page does not exist.
 */
function zarsa_get_home_page_id() {
    static $home_id = null;

    if ( null !== $home_id ) {
        return $home_id;
    }

    $home_id = 0;
    $page    = get_page_by_path( 'home', OBJECT, 'page' );

    if ( $page instanceof WP_Post && 'publish' === $page->post_status ) {
        $home_id = (int) $page->ID;
    }

    return $home_id;
}

/**
 * Homepage ACF field — always read from the Home page (slug: home).
 * Register field groups with location: Page is equal to Home.
 *
 * @param string $key ACF field name.
 * @return mixed|null
 */
function zarsa_home_field( $key ) {
    if ( ! function_exists( 'get_field' ) ) {
        return null;
    }

    $home_id = zarsa_get_home_page_id();
    if ( ! $home_id ) {
        return null;
    }

    return get_field( $key, $home_id );
}

add_filter(
    'acf/settings/save_json',
    static function () {
        return trailingslashit( get_stylesheet_directory() ) . 'acf-json';
    }
);
add_filter(
    'acf/settings/load_json',
    static function ( $paths ) {
        $paths[] = trailingslashit( get_stylesheet_directory() ) . 'acf-json';
        return $paths;
    }
);

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

add_filter( 'woocommerce_product_tabs', 'zarsa_remove_description_tab', 98 );
function zarsa_remove_description_tab( $tabs ) {
    unset( $tabs['description'] );
    return $tabs;
}

remove_action(
  'woocommerce_single_product_summary',
  'woocommerce_template_single_add_to_cart',
  30
);

add_filter( 'woocommerce_product_tabs', function( $tabs ) {
  unset( $tabs['reviews'] );
  return $tabs;
}, 98 );

// Future: taxonomy/tier-driven collections and PDP layouts — keep data layer explicit (home page + product meta) before expanding here.

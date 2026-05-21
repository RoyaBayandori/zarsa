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

/**
 * Editorial product collections (maison identity — not product_cat commerce structure).
 */
function zarsa_register_collection_taxonomy() {
    if ( ! post_type_exists( 'product' ) ) {
        return;
    }

    $labels = array(
        'name'                       => _x( 'Collections', 'taxonomy general name', 'zarsa-theme' ),
        'singular_name'              => _x( 'Collection', 'taxonomy singular name', 'zarsa-theme' ),
        'menu_name'                  => __( 'Collections', 'zarsa-theme' ),
        'all_items'                  => __( 'All Collections', 'zarsa-theme' ),
        'edit_item'                  => __( 'Edit Collection', 'zarsa-theme' ),
        'view_item'                  => __( 'View Collection', 'zarsa-theme' ),
        'update_item'                => __( 'Update Collection', 'zarsa-theme' ),
        'add_new_item'               => __( 'Add New Collection', 'zarsa-theme' ),
        'new_item_name'              => __( 'New Collection Name', 'zarsa-theme' ),
        'parent_item'                => __( 'Parent Collection', 'zarsa-theme' ),
        'parent_item_colon'          => __( 'Parent Collection:', 'zarsa-theme' ),
        'search_items'               => __( 'Search Collections', 'zarsa-theme' ),
        'popular_items'              => __( 'Popular Collections', 'zarsa-theme' ),
        'separate_items_with_commas' => __( 'Separate collections with commas', 'zarsa-theme' ),
        'add_or_remove_items'        => __( 'Add or remove collections', 'zarsa-theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used collections', 'zarsa-theme' ),
        'not_found'                  => __( 'No collections found.', 'zarsa-theme' ),
        'no_terms'                   => __( 'No collections', 'zarsa-theme' ),
        'items_list_navigation'      => __( 'Collections list navigation', 'zarsa-theme' ),
        'items_list'                 => __( 'Collections list', 'zarsa-theme' ),
        'back_to_items'              => __( '&larr; Back to Collections', 'zarsa-theme' ),
    );

    register_taxonomy(
        'collection',
        'product',
        array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'query_var'         => true,
            'rewrite'           => array(
                'slug'         => 'collection',
                'with_front'   => false,
                'hierarchical' => true,
            ),
        )
    );
}
add_action( 'init', 'zarsa_register_collection_taxonomy', 10 );

// ============================
// Shop / collection archive filters (GET + WooCommerce native attributes)
// ============================

/**
 * WooCommerce attribute filter query key (e.g. material → filter_material).
 *
 * @param string $attribute_name Attribute name without pa_ prefix.
 */
function zarsa_shop_filter_attribute_query_key( $attribute_name ) {
	return 'filter_' . wc_sanitize_taxonomy_name( $attribute_name );
}

/**
 * Active shop filter values from the current request.
 *
 * @return array<string, string>
 */
function zarsa_shop_filter_active_values() {
	$active = array(
		'collection'  => '',
		'product_cat' => '',
		'material'    => '',
		'stone'       => '',
	);

	if ( is_tax( 'collection' ) ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term ) {
			$active['collection'] = $term->slug;
		}
	} elseif ( isset( $_GET['collection'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$active['collection'] = sanitize_title( wp_unslash( $_GET['collection'] ) );
	}

	if ( isset( $_GET['product_cat'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$active['product_cat'] = sanitize_title( wp_unslash( $_GET['product_cat'] ) );
	}

	$material_key = zarsa_shop_filter_attribute_query_key( 'material' );
	if ( isset( $_GET[ $material_key ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$active['material'] = sanitize_title( wp_unslash( $_GET[ $material_key ] ) );
	}

	$stone_key = zarsa_shop_filter_attribute_query_key( 'stone' );
	if ( isset( $_GET[ $stone_key ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$active['stone'] = sanitize_title( wp_unslash( $_GET[ $stone_key ] ) );
	}

	return $active;
}

/**
 * Hidden inputs preserving unrelated query vars when a filter changes.
 *
 * @param array<int, string> $exclude_keys Query keys controlled by the filter form.
 */
function zarsa_shop_filter_hidden_fields( $exclude_keys = array() ) {
	$exclude = array_merge(
		array(
			'collection',
			'product_cat',
			zarsa_shop_filter_attribute_query_key( 'material' ),
			zarsa_shop_filter_attribute_query_key( 'stone' ),
			's',
			'post_type',
			'paged',
		),
		$exclude_keys
	);

	foreach ( $_GET as $key => $value ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( in_array( $key, $exclude, true ) || is_array( $value ) ) {
			continue;
		}

		echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( wc_clean( wp_unslash( $value ) ) ) . '">';
	}
}

/**
 * Apply collection + product_cat filters via WooCommerce product query.
 *
 * @param array $tax_query Tax query clauses.
 * @return array
 */
function zarsa_shop_archive_filter_tax_query( $tax_query ) {
	if ( ! ( is_shop() || is_tax( 'collection' ) ) ) {
		return $tax_query;
	}

	if ( ! is_array( $tax_query ) ) {
		$tax_query = array();
	}

	if ( is_shop() && ! empty( $_GET['collection'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$slug = sanitize_title( wp_unslash( $_GET['collection'] ) );
		$term = get_term_by( 'slug', $slug, 'collection' );
		if ( $term && ! is_wp_error( $term ) ) {
			$tax_query[] = array(
				'taxonomy' => 'collection',
				'field'    => 'slug',
				'terms'    => array( $slug ),
			);
		}
	}

	if ( ! empty( $_GET['product_cat'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$slug = sanitize_title( wp_unslash( $_GET['product_cat'] ) );
		$term = get_term_by( 'slug', $slug, 'product_cat' );
		if ( $term && ! is_wp_error( $term ) ) {
			$tax_query[] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => array( $slug ),
			);
		}
	}

	return $tax_query;
}
add_filter( 'woocommerce_product_query_tax_query', 'zarsa_shop_archive_filter_tax_query', 20 );

/**
 * Shop / collection archive filter bar script.
 */
function zarsa_enqueue_shop_filters() {
	if ( ! function_exists( 'is_shop' ) || ! ( is_shop() || is_tax( 'collection' ) ) ) {
		return;
	}

	wp_enqueue_script(
		'zarsa-shop-filters',
		get_template_directory_uri() . '/assets/js/shop-filters.js',
		array(),
		wp_get_theme()->get( 'Version' ) ?: '1.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'zarsa_enqueue_shop_filters' );

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

/**
 * Primary menu: link homepage editorial sections by page slug or /{slug} URL path.
 *
 * @return array<string, string> Page slug => homepage section id.
 */
function zarsa_home_section_menu_anchors() {
    return array(
        'philosophy'  => 'philosophy',
        'collections' => 'collections',
        'gifting'     => 'gifting',
    );
}

/**
 * @param object $item Nav menu item.
 * @return string|null Section id when item targets a homepage anchor section.
 */
function zarsa_home_section_for_nav_item( $item ) {
    $anchors = zarsa_home_section_menu_anchors();

    if ( 'post_type' === $item->type && 'page' === $item->object ) {
        $page = get_post( (int) $item->object_id );
        if ( $page instanceof WP_Post && isset( $anchors[ $page->post_name ] ) ) {
            return $anchors[ $page->post_name ];
        }
    }

    $path = (string) wp_parse_url( $item->url, PHP_URL_PATH );
    if ( '' === $path ) {
        return null;
    }

    $path = untrailingslashit( $path );
    foreach ( $anchors as $slug => $section_id ) {
        if ( preg_match( '#/' . preg_quote( $slug, '#' ) . '/?$#', $path ) ) {
            return $section_id;
        }
    }

    return null;
}

/**
 * @param string $section Homepage section element id.
 */
function zarsa_home_section_menu_anchor_url( $section ) {
    return home_url( '/#' . $section );
}

add_filter( 'wp_nav_menu_objects', 'zarsa_home_section_menu_anchor_link', 10, 2 );
function zarsa_home_section_menu_anchor_link( $items, $args ) {
    if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
        return $items;
    }

    foreach ( $items as $item ) {
        $section = zarsa_home_section_for_nav_item( $item );
        if ( null !== $section ) {
            $item->url = zarsa_home_section_menu_anchor_url( $section );
        }
    }

    return $items;
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

// Future: collection-driven shop filtering and PDP layouts — data layer: collection taxonomy + product meta + home page.

<?php
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'is_shop' ) || ! ( is_shop() || is_tax( 'collection' ) ) ) {
	return;
}

$active           = zarsa_shop_filter_active_values();
$is_collection_tax = is_tax( 'collection' );
$material_key     = zarsa_shop_filter_attribute_query_key( 'material' );
$stone_key        = zarsa_shop_filter_attribute_query_key( 'stone' );
$material_tax     = wc_attribute_taxonomy_name( 'material' );
$stone_tax        = wc_attribute_taxonomy_name( 'stone' );

$collections = get_terms(
	array(
		'taxonomy'   => 'collection',
		'hide_empty' => false,
	)
);

$categories = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
	)
);

$materials = taxonomy_exists( $material_tax )
	? get_terms(
		array(
			'taxonomy'   => $material_tax,
			'hide_empty' => false,
		)
	)
	: array();

$stones = taxonomy_exists( $stone_tax )
	? get_terms(
		array(
			'taxonomy'   => $stone_tax,
			'hide_empty' => false,
		)
	)
	: array();

if ( is_wp_error( $collections ) ) {
	$collections = array();
}
if ( is_wp_error( $categories ) ) {
	$categories = array();
}
if ( is_wp_error( $materials ) ) {
	$materials = array();
}
if ( is_wp_error( $stones ) ) {
	$stones = array();
}

$collection_archive_base = trailingslashit( home_url( '/collection' ) );
?>

<div class="shop-filters">
	<form
		method="get"
		class="shop-filters-form"
		action=""
		<?php if ( $is_collection_tax && function_exists( 'wc_get_page_permalink' ) ) : ?>
			data-shop-url="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"
		<?php endif; ?>
	>

		<?php zarsa_shop_filter_hidden_fields(); ?>

		<div class="shop-filters-row">

			<?php if ( ! empty( $collections ) ) : ?>
			<div class="shop-filter-field">
				<label class="shop-filter-label" for="shop-filter-collection"><?php esc_html_e( 'Collection', 'zarsa-theme' ); ?></label>
				<select
					id="shop-filter-collection"
					name="collection"
					class="shop-filter-select"
					<?php echo $is_collection_tax ? ' data-collection-nav="1" data-archive-base="' . esc_attr( $collection_archive_base ) . '"' : ''; ?>
				>
					<option value=""><?php esc_html_e( 'All collections', 'zarsa-theme' ); ?></option>
					<?php foreach ( $collections as $term ) : ?>
						<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $active['collection'], $term->slug ); ?>>
							<?php echo esc_html( $term->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $categories ) ) : ?>
			<div class="shop-filter-field">
				<label class="shop-filter-label" for="shop-filter-category"><?php esc_html_e( 'Category', 'zarsa-theme' ); ?></label>
				<select id="shop-filter-category" name="product_cat" class="shop-filter-select">
					<option value=""><?php esc_html_e( 'All categories', 'zarsa-theme' ); ?></option>
					<?php foreach ( $categories as $term ) : ?>
						<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $active['product_cat'], $term->slug ); ?>>
							<?php echo esc_html( $term->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $materials ) ) : ?>
			<div class="shop-filter-field">
				<label class="shop-filter-label" for="shop-filter-material"><?php esc_html_e( 'Material', 'zarsa-theme' ); ?></label>
				<select id="shop-filter-material" name="<?php echo esc_attr( $material_key ); ?>" class="shop-filter-select">
					<option value=""><?php esc_html_e( 'All materials', 'zarsa-theme' ); ?></option>
					<?php foreach ( $materials as $term ) : ?>
						<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $active['material'], $term->slug ); ?>>
							<?php echo esc_html( $term->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<?php endif; ?>

			<?php if ( ! empty( $stones ) ) : ?>
			<div class="shop-filter-field">
				<label class="shop-filter-label" for="shop-filter-stone"><?php esc_html_e( 'Stone', 'zarsa-theme' ); ?></label>
				<select id="shop-filter-stone" name="<?php echo esc_attr( $stone_key ); ?>" class="shop-filter-select">
					<option value=""><?php esc_html_e( 'All stones', 'zarsa-theme' ); ?></option>
					<?php foreach ( $stones as $term ) : ?>
						<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $active['stone'], $term->slug ); ?>>
							<?php echo esc_html( $term->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
			<?php endif; ?>

		</div>
	</form>
</div>

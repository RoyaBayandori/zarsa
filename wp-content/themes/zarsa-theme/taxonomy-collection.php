<?php
defined( 'ABSPATH' ) || exit;

get_header();

$term = get_queried_object();
?>

<main class="shop">

	<header class="collection-intro">
		<span class="collection-intro-label"><?php esc_html_e( 'COLLECTION', 'zarsa-theme' ); ?></span>
		<?php if ( $term instanceof WP_Term && 'collection' === $term->taxonomy ) : ?>
			<h1 class="collection-intro-title"><?php echo esc_html( $term->name ); ?></h1>
			<?php if ( ! empty( $term->description ) ) : ?>
				<div class="collection-intro-text">
					<?php echo wp_kses_post( wpautop( $term->description ) ); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="products-grid">
			<?php woocommerce_product_loop_start(); ?>
				<?php
				while ( have_posts() ) :
					the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile;
				?>
			<?php woocommerce_product_loop_end(); ?>
		</div>
	<?php else : ?>
		<p class="collection-empty"><?php esc_html_e( 'No pieces are available in this collection at the moment.', 'zarsa-theme' ); ?></p>
	<?php endif; ?>

</main>

<?php
get_footer();

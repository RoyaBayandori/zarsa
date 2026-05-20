<?php
defined( 'ABSPATH' ) || exit;

get_header();
?>

<main class="shop">

	<header class="shop-intro">
		<span class="shop-intro-label"><?php esc_html_e( 'COLLECTIONS', 'zarsa-theme' ); ?></span>
		<h1 class="shop-intro-title"><?php esc_html_e( 'Collections', 'zarsa-theme' ); ?></h1>
		<p class="shop-intro-text"><?php esc_html_e( 'A quiet selection of ceremonial saffron pieces, chosen for gifting, ritual, and intentional tables.', 'zarsa-theme' ); ?></p>
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
		<p class="shop-empty"><?php esc_html_e( 'No products found', 'zarsa-theme' ); ?></p>
	<?php endif; ?>

</main>

<?php
get_footer();

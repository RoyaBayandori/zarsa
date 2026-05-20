<?php
defined( 'ABSPATH' ) || exit;

global $product;
?>

<section class="product-hero">
	<div class="product-hero-inner">

		<div class="product-gallery">
			<?php
			if ( has_post_thumbnail() ) {
				echo get_the_post_thumbnail(
					$product->get_id(),
					'full',
					array( 'class' => 'product-main-image' )
				);
			}
			?>
		</div>

		<div class="product-identity">
			<h1 class="product-title"><?php the_title(); ?></h1>

			<div class="product-price">
				<?php woocommerce_template_single_price(); ?>
			</div>

			<div class="product-cta">
				<?php woocommerce_template_single_add_to_cart(); ?>
			</div>
		</div>

	</div>
</section>

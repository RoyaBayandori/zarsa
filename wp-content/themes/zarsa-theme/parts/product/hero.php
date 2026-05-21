<?php
defined( 'ABSPATH' ) || exit;

global $product;

$image_ids = array();

if ( $product instanceof WC_Product ) {
	$featured_id = (int) $product->get_image_id();

	if ( $featured_id ) {
		$image_ids[] = $featured_id;
	}

	foreach ( $product->get_gallery_image_ids() as $gallery_id ) {
		$gallery_id = (int) $gallery_id;

		if ( $gallery_id && ! in_array( $gallery_id, $image_ids, true ) ) {
			$image_ids[] = $gallery_id;
		}
	}
}
?>

<section class="product-hero">
	<div class="product-hero-inner">

		<?php if ( ! empty( $image_ids ) ) : ?>
			<?php
			$main_id     = $image_ids[0];
			$has_thumbs  = count( $image_ids ) > 1;
			?>
			<div class="product-gallery">
				<div class="product-gallery-main">
					<?php
					echo wp_get_attachment_image(
						$main_id,
						'full',
						false,
						array(
							'class'    => 'product-main-image',
							'id'       => 'product-gallery-main-image',
							'loading'  => 'eager',
							'decoding' => 'async',
						)
					);
					?>
				</div>

				<?php if ( $has_thumbs ) : ?>
					<div class="product-gallery-thumbs" role="list" aria-label="<?php esc_attr_e( 'Product images', 'zarsa-theme' ); ?>">
						<?php foreach ( $image_ids as $index => $attachment_id ) : ?>
							<?php
							$full_src    = wp_get_attachment_image_url( $attachment_id, 'full' );
							$full_srcset = wp_get_attachment_image_srcset( $attachment_id, 'full' );
							$full_sizes  = wp_get_attachment_image_sizes( $attachment_id, 'full' );
							$thumb_alt   = trim( (string) get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) );

							if ( '' === $thumb_alt ) {
								$thumb_alt = sprintf(
									/* translators: %d: image number in gallery */
									__( 'Product image %d', 'zarsa-theme' ),
									$index + 1
								);
							}
							?>
							<button
								type="button"
								class="product-gallery-thumb<?php echo 0 === $index ? ' is-active' : ''; ?>"
								role="listitem"
								aria-pressed="<?php echo 0 === $index ? 'true' : 'false'; ?>"
								aria-label="<?php echo esc_attr( $thumb_alt ); ?>"
								data-full-src="<?php echo esc_url( $full_src ); ?>"
								<?php if ( $full_srcset ) : ?>
									data-full-srcset="<?php echo esc_attr( $full_srcset ); ?>"
								<?php endif; ?>
								<?php if ( $full_sizes ) : ?>
									data-full-sizes="<?php echo esc_attr( $full_sizes ); ?>"
								<?php endif; ?>
							>
								<?php
								echo wp_get_attachment_image(
									$attachment_id,
									'woocommerce_thumbnail',
									false,
									array(
										'class'   => 'product-gallery-thumb-image',
										'loading' => 'lazy',
										'alt'     => '',
									)
								);
								?>
							</button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>

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

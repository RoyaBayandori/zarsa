<?php

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main class="product-page">

	<?php
	while ( have_posts() ) :
		the_post();

		if ( function_exists( 'woocommerce_output_all_notices' ) ) {
			echo '<div class="product-notices">';
			woocommerce_output_all_notices();
			echo '</div>';
		}

		get_template_part( 'parts/product/hero' );
		get_template_part( 'parts/product/story' );
	endwhile;
	?>

</main>

<?php
get_footer();

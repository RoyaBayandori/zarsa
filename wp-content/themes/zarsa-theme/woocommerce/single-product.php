<?php

defined('ABSPATH') || exit;
get_header();
?>

<main class="product-page">

  <?php
  while ( have_posts() ) :
    the_post();
  ?>

    <?php get_template_part('parts/product/hero'); ?>

    <?php get_template_part('parts/product/story'); ?>

    <?php get_template_part('parts/product/details'); ?>

    <?php get_template_part('parts/product/value'); ?>

    <!-- <?php get_template_part('parts/product/product-action'); ?> -->

    <?php
        // woocommerce_output_related_products();
    ?>

  <?php endwhile; ?>

</main>

<?php get_footer(); ?>

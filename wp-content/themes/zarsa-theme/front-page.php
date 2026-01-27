<?php
/**
 * Template Name: Home Page
 */
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main class="home-page">

  <?php get_template_part('parts/sections/hero'); ?>
  <?php get_template_part('parts/sections/philosophy'); ?>
  <?php get_template_part('parts/sections/collections'); ?>
  <?php get_template_part('parts/sections/gifting'); ?>
  <?php get_template_part('parts/sections/trust'); ?>
  <?php get_template_part('parts/sections/featured-product'); ?>

</main>

<?php get_footer(); ?>

<?php
/* Template Name: Home */
get_header();
?>

<main class="home">

  <!-- Hero Section -->
  <section class="hero" style="background: var(--bg-main); padding: 120px 24px; text-align: center;">
    <h1 style="font-family: 'Playfair Display', serif; font-size: 48px; margin-bottom: 16px;">Pure Taste. Elegant Selection.</h1>
    <p style="font-family: 'Inter', sans-serif; font-size: 18px; color: var(--text-muted); margin-bottom: 32px;">
      Hand-selected premium nuts, curated for those who value balance, quality, and refined taste.
    </p>
    <a href="#" style="background: var(--green-primary); color: #fff; padding: 14px 28px; border-radius: 4px; text-decoration: none; font-family: 'Inter', sans-serif;">Explore the Collection</a>
  </section>

  <!-- Brand Philosophy Section -->
  <section class="philosophy" style="display: flex; flex-wrap: wrap; gap: 48px; padding: 96px 24px; background: var(--bg-soft); align-items: center;">
    <div class="text" style="flex: 1; min-width: 300px;">
      <h2 style="font-family: 'Playfair Display', serif; font-size: 36px; margin-bottom: 16px;">A Philosophy of Balance</h2>
      <p style="font-family: 'Inter', sans-serif; font-size: 16px; line-height: 1.75; color: var(--text-main);">
        ZARSA Nuts is not about excess. It is about careful selection, natural freshness, and quiet refinement.
        Each product is thoughtfully curated — from the origin of the nuts to the final presentation — designed to be enjoyed, gifted, and remembered.
      </p>
    </div>
    <div class="illustration" style="flex: 1; min-width: 300px;">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/illustration.jpg" alt="Elegant Illustration" style="width: 100%; height: auto;">
    </div>
  </section>

</main>

<?php get_footer(); ?>

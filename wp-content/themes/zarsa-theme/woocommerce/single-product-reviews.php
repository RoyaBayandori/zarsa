<div class="product-reviews">

  <h2>Selected Quietly</h2>

  <?php if ( ! have_comments() ) : ?>
    <p class="no-reviews">
      Early selections often speak for themselves.
    </p>
  <?php endif; ?>

  <details class="review-form-wrapper">
    <summary>Leave a considered review</summary>
    <?php comment_form(); ?>
  </details>

</div>

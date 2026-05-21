(function () {
  const gallery = document.querySelector('.product-gallery');
  if (!gallery) {
    return;
  }

  const main = gallery.querySelector('.product-main-image');
  const thumbs = gallery.querySelectorAll('.product-gallery-thumb');

  if (!main || thumbs.length === 0) {
    return;
  }

  thumbs.forEach(function (thumb) {
    thumb.addEventListener('click', function () {
      const src = thumb.dataset.fullSrc;

      if (!src) {
        return;
      }

      main.src = src;

      if (thumb.dataset.fullSrcset) {
        main.srcset = thumb.dataset.fullSrcset;
      } else {
        main.removeAttribute('srcset');
      }

      if (thumb.dataset.fullSizes) {
        main.sizes = thumb.dataset.fullSizes;
      } else {
        main.removeAttribute('sizes');
      }

      thumbs.forEach(function (btn) {
        btn.classList.remove('is-active');
        btn.setAttribute('aria-pressed', 'false');
      });

      thumb.classList.add('is-active');
      thumb.setAttribute('aria-pressed', 'true');
    });
  });
})();

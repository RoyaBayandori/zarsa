(function () {
  const form = document.querySelector('.shop-filters-form');
  if (!form) {
    return;
  }

  const collectionSelect = form.querySelector('select[name="collection"]');

  if (collectionSelect && collectionSelect.dataset.collectionNav === '1') {
    collectionSelect.addEventListener('change', function () {
      const slug = this.value;
      const base = collectionSelect.dataset.archiveBase || '/collection/';

      if (!slug) {
        const shopUrl = form.dataset.shopUrl;
        const params = new URLSearchParams(new FormData(form));
        params.delete('collection');
        const query = params.toString();

        if (shopUrl) {
          window.location.assign(shopUrl + (query ? '?' + query : ''));
          return;
        }

        form.submit();
        return;
      }

      const params = new URLSearchParams(new FormData(form));
      params.delete('collection');

      const query = params.toString();
      const url = base + slug + '/' + (query ? '?' + query : '');

      window.location.assign(url);
    });
  }

  form.querySelectorAll('.shop-filter-select').forEach(function (select) {
    if (select === collectionSelect && collectionSelect.dataset.collectionNav === '1') {
      return;
    }

    select.addEventListener('change', function () {
      form.submit();
    });
  });
})();

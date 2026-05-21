(function () {
  const form = document.querySelector('.shop-filters-form');
  if (!form) {
    return;
  }

  const collectionSelect = form.querySelector('#shop-filter-collection');
  const archiveBase = form.dataset.archiveBase || '/collection/';
  const shopUrl = form.dataset.shopUrl || '/shop/';

  function pruneParams(params) {
    params.delete('collection');
    params.delete('paged');

    params.forEach(function (value, key) {
      if (!value) {
        params.delete(key);
      }
    });

    return params;
  }

  function buildQuery() {
    return pruneParams(new URLSearchParams(new FormData(form))).toString();
  }

  function currentPath() {
    return window.location.pathname.replace(/\/page\/\d+\/?$/, '/');
  }

  function navigate(url) {
    window.location.assign(url);
  }

  if (collectionSelect) {
    collectionSelect.addEventListener('change', function () {
      const slug = this.value;
      const query = buildQuery();

      if (!slug) {
        navigate(shopUrl + (query ? '?' + query : ''));
        return;
      }

      const base = archiveBase.endsWith('/') ? archiveBase : archiveBase + '/';
      navigate(base + slug + '/' + (query ? '?' + query : ''));
    });
  }

  form.querySelectorAll('.shop-filter-select').forEach(function (select) {
    if (select === collectionSelect) {
      return;
    }

    select.addEventListener('change', function () {
      const query = buildQuery();
      navigate(currentPath() + (query ? '?' + query : ''));
    });
  });

  form.addEventListener('submit', function (event) {
    event.preventDefault();
    const query = buildQuery();
    navigate(currentPath() + (query ? '?' + query : ''));
  });
})();

var portfolioIsotope

$(document).ready(function () {
  // alert("asddsa")
  // initPortpolio();
  getProduct();
  // initFetch();
});

function usersProduct() {
  $('.userProduct').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 3,
    dots: true,
    autoplay: true,
    mobileFirst: true,
    pauseOnFocus: true,
    autoplaySpeed: 3000,
    speed: 1000,
    centerMode: false,
  });
}

function getClients() {
  console.log('clientGet');
  // alert('clientGet')
  return new Promise(resolve => {
    var clientsAPI = `${API_PATH}/public/get/clients`;
    $.getJSON(clientsAPI, {
      format: 'json'
    }).done(function (response) {
      let clients = '';
      $.each(response.data, function (i, items) {
        clients += `
                  <div class="col-lg-3 col-md-4 col-6">
                      <div class="client-logo">
                          <img src="${BASE_URL}/uploads/clients/${items.icon}" class="img-fluid" alt="${items.name}" title="${items.description}">
                      </div>
                  </div>
                  `;
        $('#clientsData').html(clients);
        // $('#clientsData').removeClass('d-none');
        resolve(true);
      });
    });

  });
}

function initPortpolio() {
  let portfolioContainer = select('.portfolio-container');
  if (portfolioContainer) {
    portfolioIsotope = new Isotope(portfolioContainer, {
      itemSelector: '.portfolio-item'
    });

    let portfolioFilters = select('#portfolio-flters li', true);

    on('click', '#portfolio-flters li', function (e) {
      e.preventDefault();
      portfolioFilters.forEach(function (el) {
        el.classList.remove('filter-active');
      });
      this.classList.add('filter-active');

      portfolioIsotope.arrange({
        filter: this.getAttribute('data-filter')
      });
      portfolioIsotope.on('arrangeComplete', function () {
        AOS.refresh()
      });
    }, true);
  }
}

function getProduct() {
  console.log('getProduct');
  // alert('clientGet')
  return new Promise(resolve => {
    var productsAPI = `${API_PATH}/get/products`;
    $.getJSON(productsAPI, {
      format: 'json'
    }).done(function (response) {
      let products = '';
      $.each(response.data, function (i, items) {
        products += `
                  <div class="col-lg-3 col-md-4 col-6">
                      <div class="client-logo">
                          <img src="${BASE_URL}/uploads/clients/${items.icon}" class="img-fluid" alt="${items.name}" title="${items.description}">
                      </div>
                  </div>
                  <div class="col-lg-2 col-md-6 portfolio-item filter-${str.toLowerCase(items.id_category_product)} shadow-sm" style="position: absolute; left: 760px; top: 230.25px;">
                      <img src="${BASE_URL}/uploads/products/${items.icons}" class="img-fluid" alt="${items.name}">
                      <div class="portfolio-info">
                          <h4>${items.name}</h4>
                          <p>${items.description}</p>
                          <-- <a href="#" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a> -->
                          <a href="#" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                      </div>
                  </div>
                  `;
        $('#productData').html(products);
        resolve(true);
      });
    });

  });
}

async function initFetch() {
  console.log('initFetch');
  await getClients();
  usersProduct();

}
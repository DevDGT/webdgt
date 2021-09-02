var portfolioIsotope;

$(document).ready(function () {
  initFetch();

  $("#portfolio-flters").on("click", ".options", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $("#coreCategory").removeClass("filter-active");
    $(".options").removeClass("filter-active");
    // $(".tab").addClass("active"); // instead of this do the below
    $(this).addClass("filter-active");
    getSelected(id);
  });
})

async function productsData(){
  $('#productData').not('.slick-initialized').slick({
    lazyLoad:'progressive',
  });
  $('#productData').slick('unslick');
}

async function usersProduct() {
  $('#clientsData').not('.slick-initialized').slick({
    infinite: false,
    dots: true,
    autoplay: true,
    pauseOnFocus: true,
    autoplaySpeed: 10000,
    speed: 300,
    mobileFirst: true,
    lazyLoad:'ondemand',
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 2,
                dots: false,
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: false,
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                dots: false,
            }
        },
        {
            breakpoint: 300,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                dots: false,
            }
        }
    ]
  });
}

async function getClients() {
  return new Promise(resolve => {
      var clientsAPI = `${API_PATH}/public/get/clients`;
      $.getJSON(clientsAPI, {
          format: 'json'
      }).done(function (response) {
          let clients = '';
          $.each(response.data, function (i, items) {
              clients += `
                  <div class="col" style="border:1px solid #ececec;">
                      <div class="client-logo d-block mx-auto" style="border: unset; width:8rem; height: 8rem;">
                          <img data-lazy="${BASE_URL}/uploads/clients/${items.icon}" style="height: -webkit-fill-available;
                          width: -webkit-fill-available; alt="${items.name}" title="${items.description}">
                      </div>
                      <div class="container">
                          <p class="text-center text-truncate fw-light">${items.name}</p>
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

async function initPortpolio() {
  let portfolioContainer = select(".portfolio-container");
  if (portfolioContainer) {
    portfolioIsotope = new Isotope(portfolioContainer, {
      itemSelector: ".portfolio-item",
    });

    let portfolioFilters = select("#portfolio-flters li", true);
    on(
      "click",
      "#portfolio-flters li",
      function (e) {
        e.preventDefault();
        portfolioFilters.forEach(function (el) {
          el.classList.remove("filter-active");
        });
        this.classList.add("filter-active");
        portfolioIsotope.arrange({
          filter: this.getAttribute("data-filter"),
        });
        portfolioIsotope.on("arrangeComplete", function () {
          AOS.refresh();
        });
      },
      true
    );
  };
};

async function getProduct() {
  $("#coreCategory").addClass("filter-active");
  $(".options").removeClass("filter-active");
  return new Promise((resolve) => {
    var productsAPI = `${API_PATH}/public/get/products`;
    $.getJSON(productsAPI, {
      format: "json",
    }).done(function (response) {
      let products = "";
      $.each(response.data, function (i, items) {
        products += `
          <div class="col-lg-2 col-md-6 col-sm-6 p-2 portfolio-item filter-${items.id_category_product}">
            <div class="card h-100 shadow-sm">
              <span class="text-center text-decoration-underline text-muted">${items.name}</span>
              <a href="${BASE_URL + '/product/detail/' + items.slug}" class="text-decoration-none">
                <img data-lazy="${BASE_URL}/uploads/products/${items.icon}" class="card-img-top" alt="${items.name}">
              </a>
              <div class="item-card position-absolute w-100" style="overflow:hidden">
                  <div class='bg-white p-2 pb-3 portfolio-info shadow-sm' style='position:sticky; top:60%; opacity:0.8'>
                    <p class="text-truncate">${items.description}</p>
                    <a href="${BASE_URL + '/product/detail/' + items.slug}" class="details-link" title="More Details" target="_blank"><i class="bx bx-link"></i></a>
                  </div>
              </div>
            </div>
          </div>
          `;
        $("#productData").html(products);
        resolve(true);
        productsData();
      });
    });
  });
}

async function getCategory() {
  return new Promise((resolve) => {
    {
      var categoryProductsAPI = `${API_PATH}/public/get/category-products`;
      $.getJSON(categoryProductsAPI, {
        format: "json",
      }).done(function (response) {
        // console.log(response);
        let category = ``;
        category += `<li data-filter="*" id="coreCategory" class="filter-active" onclick="getProduct()">All</li>`;
        $.each(response.data, function (i, items) {
          category += `<li data-filter=".filter-${items.id}" class="options" data-id="${items.id}" id="category${items.name}">${items.name}</li>`;
          $("#portfolio-flters").html(category);
          resolve(true);
          productsData();
        });
      });
    }
  });
};

async function getSelected(id) {
  return new Promise((resolve) => {
    var productsAPI = `${API_PATH}/public/get/products`;
    $.getJSON(productsAPI, {
      format: "json",
    }).done(function (response) {
      let products = "";
      $.each(response.data, function (i, items) {
        // console.log(items);
        if (items.id_category_product != id) {
          products += ``;
        } else {
          products += `
            <div class="col-lg-2 col-md-6 col-sm-6 p-2 portfolio-item filter-${items.id_category_product}">
              <div class="card h-100 shadow-sm">
                <span class="text-center text-muted">${items.name}</span>
                <a href="${BASE_URL + '/product/detail/' + items.slug}" class="text-decoration-none">
                  <img data-lazy="${BASE_URL}/uploads/products/${items.icon}" class="card-img-top" alt="${items.name}">
                </a>
                <div class="item-card position-absolute w-100" style="overflow:hidden">
                    <div class='bg-white p-2 pb-3 portfolio-info shadow-sm' style='position:sticky; top:60%; opacity:0.8'>
                      <p class="text-truncate">${items.description}</p>
                      <a href="${BASE_URL + '/product/detail/' + items.slug}" class="details-link" title="More Details" target="_blank"><i class="bx bx-link"></i></a>
                    </div>
                </div>
              </div>
            </div>
            `;
        }
        $("#productData").html(products);
        resolve(true);
        productsData();
      });
    });
  });
}

async function initFetch() {
  await getCategory();
  await getProduct();
  await getClients();
  usersProduct();
  productsData();
}

var portfolioIsotope;

$(document).ready(function () {
  // alert("asddsa")
  // initPortpolio();
  initFetch();
  $("#portfolio-flters").on("click", ".options", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $("#coreCategory").removeClass("filter-active");
    $(".options").removeClass("filter-active");
    // $(".tab").addClass("active"); // instead of this do the below
    $(this).addClass("filter-active");
    console.log(id);
    getSelected(id);
  });
});

function usersProduct() {
  $(".userProduct").slick({
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

async function getClients() {
  console.log("clientGet");
  // alert('clientGet')
  return new Promise((resolve) => {
    var clientsAPI = `${API_PATH}/public/get/clients`;
    $.getJSON(clientsAPI, {
      format: "json",
    }).done(function (response) {
      let clients = "";
      $.each(response.data, function (i, items) {
        clients += `
                  <div class="col-lg-3 col-md-4 col-6">
                      <div class="client-logo">
                          <img src="${BASE_URL}/uploads/clients/${items.icon}" class="img-fluid" alt="${items.name}" title="${items.description}">
                      </div>
                  </div>
                  `;
        $("#clientsData").html(clients);
        // $('#clientsData').removeClass('d-none');
        resolve(true);
      });
    });
  });
}

function initPortpolio() {
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
  }
}

async function getProduct() {
  $("#coreCategory").addClass("filter-active");
  $(".options").removeClass("filter-active");
  // console.log('getProduct');
  return new Promise((resolve) => {
    var productsAPI = `${API_PATH}/public/get/products`;

    $.getJSON(productsAPI, {
      format: "json",
    }).done(function (response) {
      let products = "";
      $.each(response.data, function (i, items) {
        products += `
                    <div class="col-lg-2 p-2 portfolio-item filter-${items.id_category_product} ">
                      <div class='card h-100 shadow-sm'>
                          <img src="${BASE_URL}/uploads/products/${items.icon}"class="card-img-top" alt="${items.name}">
                          <div class="item-card position-absolute w-100" style="overflow:hidden">
                              <div class='bg-white p-2 pb-3 portfolio-info shadow-sm' style='position:sticky; top:60%; opacity:0.8'>
                                <h4>${items.name}</h4>
                                <p class="text-truncate">${items.description}</p>
                                <a href="#" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                              </div>
                          </div>
                      </div>
                    </div>
                    `;
        $("#productData").html(products);
        resolve(true);
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
        console.log(response);
        let category = ``;
        category += `<li data-filter="*" id="coreCategory" class="filter-active" onclick="getProduct()">All</li>`;
        $.each(response.data, function (i, items) {
          category += `<li data-filter=".filter-${items.id}" class="options" data-id="${items.id}" id="category${items.name}">${items.name}</li>`;
          $("#portfolio-flters").html(category);
          resolve(true);
        });
      });
    }
  });
}

async function getSelected(id) {
  return new Promise((resolve) => {
    var productsAPI = `${API_PATH}/public/get/products`;

    $.getJSON(productsAPI, {
      format: "json",
    }).done(function (response) {
      let products = "";
      $.each(response.data, function (i, items) {
        if (items.id_category_product != id) {
          products += ``;
        } else {
          products += `
                      <div class="col-lg-2 p-2 portfolio-item filter-${items.id_category_product} ">
                          <div class='card h-100 shadow-sm'>
                              <img src="${BASE_URL}/uploads/products/${items.icon}"class="card-img-top" alt="${items.name}">
                              <div class="item-card position-absolute w-100" style="overflow:hidden">
                                  <div class='bg-white p-2 pb-3 portfolio-info shadow-sm' style='position:sticky; top:60%; opacity:0.8'>
                                    <h4>${items.name}</h4>
                                    <p class="text-truncate">${items.description}</p>
                                    <a href="#" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                  </div>
                              </div>
                          </div>
                        </div>
                      `;
        }
        $("#productData").html(products);
        resolve(true);
      });
    });
  });
}

async function initFetch() {
  console.log("initFetch");
  await getCategory();
  await getProduct();
  await getClients();
  usersProduct();
}

$(document).ready(function () {
    initFetch();
    $("#portfolio-flters").on("click", ".options", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        console.log('ID : ' + id);
        $("#coreCategory").removeClass("filter-active");
        $(".options").removeClass("filter-active");
        // $(".tab").addClass("active"); // instead of this do the below
        $(this).addClass("filter-active");
        getSelected(id);
    });
});

function usersProduct() {
    $(".userProduct").slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 3,
        dots: false,
        autoplay: true,
        mobileFirst: true,
        pauseOnFocus: true,
        autoplaySpeed: 6000,
        speed: 2000,
        centerMode: false,
    });
};

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
                                <a href="${BASE_URL + '/product/detail/' + items.slug}" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
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
};

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
                console.log(items);
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
                                        <a href="${BASE_URL + '/product/detail/' + items.slug}" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
                                    </div>
                                </div>
                            </div>
                            </div>
                        `;
                }
                $("#productData").html(products);
                resolve(true);
                // console.log('ok getselected');
            });
        });
    });
};

async function getProductData() {
    return new Promise((resolve) => {
        {
            var idProduct = $('#productDetail').attr('data-id');
            var dataCataProductsAPI = `${API_PATH}public/get/products-demo?id=` + idProduct;
            $.getJSON(dataCataProductsAPI, {
                format: "json",
            }).done(function (response) {
                console.log(response);
                var lCategory = response.count;
                let catDetail = `<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-touch="false" data-bs-interval="false">`;
                catDetail += `<div class="carousel-indicators">`;
                for (let i = 0; i < lCategory; i++) {
                    catDetail += `<button type="button" data-bs-target="#carousel${i}" data-bs-slide-to="${i}" aria-current="true" aria-label="Slide${i}" class="${i === 0 ? 'active' : ''}"></button>`;
                }
                catDetail += `</div>`;
                catDetail += `<div class="carousel-inner">`;
                $.each(response.data, function (i, items) {
                    // console.log('Items  : ' + items);
                    // console.log('I : ==== ' + i);
                    catDetail += `
                    <div class="carousel-item ${i === 0 ? 'active' : ''}">
                        <div class="row">
                            <div class="col-lg-12" style="height: 30rem;">
                                <iframe class="w-100 h-100" src="${items.link}?controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                </iframe>
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>${items.title}</h5>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
                catDetail += `
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    </div>`;

                $("#carouselProduct").html(catDetail);
                resolve(true);
            });
        }
    });
};

// async function getOtherVideo() { }

async function initFetch() {
    // console.log("initFetch");
    await getProductData();
    await getCategory();
    await getProduct();
    await getClients();
    await usersProduct();
};

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
}

async function getClients() {
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

    return new Promise((resolve) => {
        var productsAPI = `${API_PATH}/public/get/products`;
        $.getJSON(productsAPI, {
            format: "json",
        }).done(function (response) {
            let products = "";
            $.each(response.data, function (i, items) {
                products += `
                <div class="col-lg-3 col-md-3 col-sm-2 p-2 portfolio-item filter-${items.id_category_product}">
                    <div class="container mt-5 d-flex justify-content-center">
                        <div class="my-card"><img class="my-card-img" src="${BASE_URL + '/uploads/products/' + items.icon}" />
                            <div class="my-card-body trainer-card-body">
                                <span class="fs-4">${items.name}</span>
                                <p class="text-truncate mb-4">${items.description}</p>
                                <a href="${BASE_URL + '/product/detail/' + items.slug}" class="my-card-btn">detail</a>
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
                    <div class="col-lg-3 col-md-3 col-sm-2 p-2 portfolio-item filter-${items.id_category_product}">
                        <div class="container mt-5 d-flex justify-content-center">
                            <div class="my-card"><img class="my-card-img" src="${BASE_URL + '/uploads/products/' + items.icon}" />
                                <div class="my-card-body trainer-card-body">
                                    <span class="fs-4">${items.name}</span>
                                    <p class="text-truncate mb-4">${items.description}</p>
                                    <a href="${BASE_URL + '/product/detail/' + items.slug}" class="my-card-btn">detail</a>
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

async function getProductData() {
    return new Promise((resolve) => {
        {
            let idProduct = $('#productDetail').attr('data-id');
            let dataCataProductsAPI = `${API_PATH}public/get/products-demo?id=` + idProduct;
            $.getJSON(dataCataProductsAPI, {
                format: "json",
            }).done(function (response) {
                let lCategory = response.count;
                // console.log(lCategory);
                let catDetail = ``;
                if(lCategory === 0 ){
                    catDetail = `<h4 class="text-center">No others video found sorry !</h4>`;
                }else{
                    catDetail = `<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-touch="false" data-bs-interval="false">`;
                    catDetail += `<div class="carousel-indicators">`;
                    for (let i = 0; i < lCategory; i++) {
                        catDetail += `<button type="button" data-bs-target="#carousel${i}" data-bs-slide-to="${i}" aria-current="true" aria-label="Slide${i}" class="${i === 0 ? 'active' : ''}"></button>`;
                    }
                    catDetail += `</div>`;
                    catDetail += `<div class="carousel-inner">`;

                    $.each(response.data, function (i, items) {
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
                }

                $("#carouselProduct").html(catDetail);
                getProductUser(idProduct);
                getProductDoc(idProduct);
                resolve(true);
            });
        }
    });
}

async function getProductUser(id) {
    return new Promise((resolve) => {
        var clientsAPI = `${API_PATH}/public/get/clients/order/` + id;
        $.getJSON(clientsAPI, {
            format: "json",
        }).done(function (response) {
            let clients = ``;
            clients += `<h5 class="card-title text-center">Who's use this product</h5>`;
            $.each(response.data, function (i, items) {
                clients += `
                <div class="col-lg-5 col-md-5 col-sm-1 p-2">
                    <div class="testimonial-item">
                        <img src="${BASE_URL}/uploads/clients/${items.icon}" class="testimonial-img" alt="${items.name}">
                        <h3>${items.name}</h3>
                        <h4>${items.jobs}</h4>
                        <p> Lorem Ipsum
                        </p>
                    </div>
                </div>
                `;
                $("#productClient").html(clients);
                resolve(true);
            });
        });
    });
}

async function getProductDoc(ids) {
    return new Promise((resolve) => {
        {
            let dataCataProductsAPI = `${API_PATH}/public/get/products-brosur/` + ids;
            $.getJSON(dataCataProductsAPI, {
                format: "json",
            }).done(function (response) {
                let catDetail = ``;
                let countCatalog = response.count;
                if(countCatalog === 0){
                    catDetail = `<h6 class="card-title text-center">Catalog not available</h6>`;
                }else{
                $.each(response.data, function (i, items) {
                    catDetail += `
                        <div class="p-2">
                            <a href="${BASE_URL}/product/read?file=${items.id}" target="_blank" class="btn btn-outline-info">Catalog ${i+1}<i class="bi bi-book ms-2"></i></a>
                        </div>`;
                    });
                }
                
                $("#catalogProduct").html(catDetail);
                resolve(true);
            });
        }
    });
}

async function initFetch() {
    await getProductData();
    await getCategory();
    await getProduct();
    await getClients();
    usersProduct();
    productsData();
}

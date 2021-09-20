$(document).ready(function () {
    initFetch();
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

async function getProduct() {
    return new Promise((resolve) => {
        var productsAPI = `${API_PATH}/public/get/career`;
        $.getJSON(productsAPI, {
        format: "json",
        }).done(function (response) {
        let products = "";
        $.each(response.data, function (i, items) {
            products += `
            <div class="card m-2" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="${BASE_URL}/uploads/careers/${items.icon}" class="img-fluid rounded-start" alt="${items.name}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 id="name_${items.id}" class="card-title">${items.name}</h5>
                            <p id="desc_${items.id}" class="card-text text-truncate">${items.description}</p>
                            <p class="card-text">
                                <button type="button" data-name="${items.name}" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" onclick="openMore('${items.id}');">
                                    Read More
                                </button>
                            </p>
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

async function initFetch() {
    await getProduct();
    usersProduct();
    productsData();
}

async function openMore(id){
    
    let name = $('#name_' + id).text();
    let desc = $('#desc_' + id).text();

    $('#staticBackdropLabel').text(name);
    $('#staticBackdropBody').text(desc);
}

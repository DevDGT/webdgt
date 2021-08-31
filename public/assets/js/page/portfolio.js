$(document).ready(function () {
    initFetch();
})

async function getDetailsProducts(id = '') {
    return new Promise((resolve) => {
        var clientsAPI = `${API_PATH}/public/get/clients/select/` + id;

        $.getJSON(clientsAPI, {
            format: "json",
        }).done(function (response) {
            let clients = ``;
            $('#titleItems').text('');
            if (response.count != 0) {
                $.each(response.data, function (i, items) {
                    // console.log(response);
                    clients += `
                        <div class="col">
                            <div class="testimonial-item">
                                <img src="${BASE_URL}/uploads/products/${items.icon}" class="testimonial-img" alt="${items.name}" style="width:5rem;">
                                <h3>${items.name}</h3>
                                <p>${items.date}</p>
                            </div>
                        </div>
                        `;
                    $("#clientsDataDetails").html(clients);
                    resolve(true);
                });
            } else {
                clients += `<h4 class="text-center" id="titleItems">No data found sorry !</h4>`;
                $("#clientsDataDetails").html(clients);
                resolve(true);
            }
        });
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
                                <div class="client-logo" style="border: unset; widht:auto; height: 7rem;">
                                    <img src="${BASE_URL}/uploads/clients/${items.icon}" class="img-fluid" style="border:none; height: -webkit-fill-available;" alt="${items.name}" title="${items.description}">
                                </div>
                                <div class="container text-center text-truncate fw-light">
                                    <a href="#" onclick=getDetailsProducts('${items.id}')>
                                    ${items.name}
                                    </a>
                                </div> 
                            </div>
                            `;
                $('#clientsData').html(clients);
                // $('#clientsData').removeClass('d-none');
                resolve(true);
            });
        });
    });
};

async function initSlick() {
    $('#clientsData').not('.slick-initialized').slick({
        infinite: false,
        dots: false,
        autoplay: true,
        pauseOnFocus: true,
        autoplaySpeed: 6000,
        speed: 2000,
        centerMode: false,
        mobileFirst: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 300,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });
};

async function initFetch() {
    await getClients();
    await initSlick();
};
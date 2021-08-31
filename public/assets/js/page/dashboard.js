$(document).ready(function () {
    moveRoom('home');
    initFetch();
})

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
                    slidesToShow: 3,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
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
}

async function reloadSlick() {
    $("#clientsData").addClass('d-none').slick('unslick');
    // $('.clientSlick').slick('unslick');
    getClients();
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

async function initFetch() {
    await getClients();
    await initSlick();
}

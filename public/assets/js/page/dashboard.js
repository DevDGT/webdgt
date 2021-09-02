$(document).ready(function () {
    moveRoom('home');
    initFetch();
})

async function initSlick() {
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

async function reloadSlick() {
    $("#clientsData").addClass('d-none').slick('unslick');
    // $('.clientSlick').slick('unslick');
    getClients();
}

async function initFetch() {
    await getClients();
    await initSlick();
}

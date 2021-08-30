$(document).ready(function () {

  moveRoom("aboutus");
  getTeams();

})

function initSlick() {

  $('#teamApi').not('.slick-initialized').slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 2,
    dots: false,
    autoplay: true,
    adaptiveHeight: false,
    pauseOnFocus: true,
    autoplaySpeed: 3000,
    speed: 1000,
    centerMode: false,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ],

  });

}

function reloadSlick() {

  $("#teamApi").addClass('d-none').slick('unslick');
  $('.benefits').slick('unslick');
  getTeams();

}

async function addTeam() {

  return new Promise(resolve => {
    var teamsAPI = `${API_PATH}/public/get/teams`;
    $.getJSON(teamsAPI, {
      format: 'json'
    }).done(function (response) {
      let teams = ``;
      let ceo = ``;
      $.each(response.data, function (i, items) {
        if (i == 0) {
          ceo = `
          <div class="col">
            <div class="member" style="box-shadow:unset;">
              <div class="member-img pt-4">
                <img src="${BASE_URL}/uploads/users/${items.photo == '' ? 'default.png' : items.photo}" class="img-fluid" alt="${items.name}" style="max-width:15rem; min-width:15rem; border-radius:50%">
                <div class="container">
                    <h3 class="text-uppercase p-4">${items.name} - CEO</h3>
                    <p class="mx-auto">
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                      ${items.quotes}
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                </div>
              </div>
            </div>
          </div>
          `;
        } else if (i > 0) {
          teams += `
            <div class="col-lg-3 col-md-2 col-sm-1 p-2" style="height:29rem;">
              <div class="member w-100 h-100 d-flex justify-content-center border border-1" style="box-shadow:unset;">
                <div class="card" style="width: 40rem; max-height:60vh; border:none;">
                  <img src="${BASE_URL}/uploads/users/${items.photo == '' ? 'default.png' : items.photo}" alt="${items.name}" style="width:100%; height:15rem; object-fit: cover;" class="img-fluid">
                  <div class="social d-flex flex-row">`;
          $.each(items.socials, function (i, social) {
            teams += `<a href="${social.link}" target="_blank"><i class="bi bi-${social.social}"></i></a>`;
          });
          teams += `
                  </div>
                    <div class="card-body">
                      <h5 class="card-title">${items.name}</h5>
                      <div class="container d-flex flex-row justify-content-evenly">
                        <a href="${BASE_URL}/teams/?name=${items.username}&onweb=false" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Outside Web"><i class="bx bi-eye"></i></a>
                        <a href="${BASE_URL}/teams/?name=${items.username}&onweb=true" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Inside Web"><i class="bx bi-eye-fill"></i></a>
                      </div>
                      <p class="card-text p-2">${items.jobs}</p>
                      <p class="card-text d-inline-block text-break" style="max-width: -webkit-fill-available;">
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        ${items.quotes == '' ? 'Default Quotes' : items.quotes}
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                      </p>
                    </div>
                  </div>
              </div>
            </div>
            `;
        }
      });
      $('#teamCEO').html(ceo);
      $('#teamApi').html(teams);
      resolve(true);
    });
  });

}

async function getTeams() {

  await addTeam();
  initSlick();

  $('.benefits').not('.slick-initialized').slick({
    centerMode: true,
    slidesToShow: 5,
    autoplay: true,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 3
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 1
        }
      }
    ]
  });

}

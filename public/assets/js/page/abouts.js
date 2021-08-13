$(document).ready(function () {
  moveRoom("aboutus");
  getTeams();
});

function initSlick() {
  $('#teamApi').not('.slick-initialized').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 2,
    dots: false,
    autoplay: true,
    adaptiveHeight: true,
    responsive: [
      {
        breakpoint: 1024,
        settings: 'unslick'
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
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ],
    pauseOnFocus: true,
    autoplaySpeed: 3000,
    speed: 1000,
    centerMode: false,

  })
}

function reloadSlick() {
  $("#teamApi").addClass('d-none').slick('unslick');
  $('.benefits').slick('unslick');
  getTeams();
}

function addTeam() {
  return new Promise(resolve => {
    var teamsAPI = `${API_PATH}/public/get/teams`;
    $.getJSON(teamsAPI, {
      format: 'json'
    }).done(function (response) {
      // nanobar.go(90)
      let teams = '';
      let ceo = '';
      $.each(response.data, function (i, items) {
        if (i == 0) {
          ceo = `
          <div class="col-lg-12">
              <div class="member aos-init aos-animate rounded-pill" data-aos="fade-up">
                  <div class="member-img my-4">
                      <img src="${BASE_URL}/uploads/users/${items.photo == '' ? 'default.png' : items.photo}" class="img-fluid imgceo" alt="" style="max-width:15rem;min-width:15rem;">
                      <div class="container">
                          <h3 class="text-uppercase my-4">${items.name} - CEO</h3>
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
            <div class="col-12 p-3 teamImg">
              <div class="member w-100 h-100 bg-black aos-init aos-animate d-flex justify-content-center" data-aos="fade-up">
                <div class="card" style="width: 20rem; max-height:60vh; border:none;">
                  <img src="${BASE_URL}/uploads/users/${items.photo == '' ? 'default.png' : items.photo}" alt="${items.name}" style="width:100%; height:15vw; object-fit: cover;">
                  <div class="social">`;
          $.each(items.socials, function (i, social) {
            teams += `<a href="${social.link}" target="_blank"><i class="bi bi-${social.social}"></i></a>`;
          });
          teams += `</div>
                    <div class="card-body">
                      <h5 class="card-title">${items.name}</h5>
                      <p class="card-text">${items.jobs}</p>
                      <p class="card-text d-inline-block text-truncate" style="max-width: -webkit-fill-available;">
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                      ${items.quotes ?? 'Default Quotes'}
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                      </p>
                    </div>
                  </div>
              </div>
          </div>
          `;
        }
        $('#teamCEO').html(ceo);
        $('#teamApi').html(teams);
        $("#teamApi").removeClass('d-none');
        resolve(true);
      });
    });
  });
};

async function getTeams() {

  await addTeam();
  initSlick();

  $('.benefits').not('.slick-initialized').slick({
    centerMode: true,
    // centerPadding: '60px',
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
};

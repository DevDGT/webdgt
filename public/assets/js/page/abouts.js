$(document).ready(function(){

    var teamsAPI = `${API_PATH}/public/get/teams`;
          
    $.getJSON(teamsAPI, {
        format: 'json'
    }).done(function(response){
        let teams = '';
        let ceo = '';
        $.each(response.data, function(i, items){
          if(i == 0) {
            ceo = `
            <div class="col-lg-12">
                <div class="member aos-init aos-animate" data-aos="fade-up">
                    <div class="member-img my-4">
                        <img src="${BASE_URL}/uploads/users/${items.photo == '' ? 'default.png' : items.photo}" class="img-fluid imgceo" alt="" style="max-width:20rem;">
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
          }else if (i > 0){
            teams += `
              <div class="col-lg-3 col-md-4 mx-2 p-6 d-flex align-items-stretch">
                <div class="member aos-init aos-animate" data-aos="fade-up">
                    <div class="member-img">
                        <img src="${BASE_URL}/uploads/users/${items.photo == '' ? 'default.png' : items.photo}" class="img-fluid" alt="">
                        <div class="social">
                            <a href="#" target="_blank"><i class="bi bi-twitter"></i></a>
                            <a href="#" target="_blank"><i class="bi bi-facebook"></i></a>
                            <a href="#" target="_blank"><i class="bi bi-instagram"></i></a>
                            <a href="#" target="_blank"><i class="bi bi-linkedin"></i></a>
                            <a href="#" target="_blank"><i class="bi bi-github"></i></a>
                            <a href="#" target="_blank"><i class="bi bi-youtube"></i></a>
                            <a href="#" target="_blank"><i class="bi bi-discord"></i></a>
                            <a href="#" target="_blank"><i class="bi bi-eye-fill"></i></a>
                        </div>
                    </div>
                    <div class="member-info">
                        <h4>${items.name}</h4>
                        <span>${items.jobs}</span>
                        <span>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        ${items.quotes}
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </span>
                    </div>
                </div>
            </div>
            `;
          }
            $('#teamCEO').html(ceo);
            $('#teamApi').html(teams);
            
        });
        console.log(response);
        $('.dgtTeam').slick({
          infinite: true,
          slidesToShow: 3,
          slidesToScroll: 2,
          dots: true,
          mobileFirst: true,
          adaptiveHeight: true
      });
        
    });


    $('.benefits').slick({
        centerMode: true,
        centerPadding: '60px',
        slidesToShow: 3,
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
});
$(document).ready(function(){

    var teamsAPI = `${API_PATH}/public/get/teams`;
          
    $.getJSON(teamsAPI, {
        format: 'json'
    }).done(function(response){
        let teams = '';
        $.each(response.data, function(i, items){
          teams += `
              <div class="col-lg-3 col-md-4 mx-2 p-6 d-flex align-items-stretch">
                <div class="member aos-init aos-animate" data-aos="fade-up">
                    <div class="member-img">
                        <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
                        <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                            <a href=""><i class="bi bi-github"></i></a>
                            <a href=""><i class="bi bi-youtube"></i></a>
                            <a href=""><i class="bi bi-discord"></i></a>
                        </div>
                    </div>
                    <div class="member-info">
                        <h4>${items.name}</h4>
                        <span>${items.jobs}</span>
                    </div>
                </div>
            </div>
            `;
            $('#teamApi').html(teams);
            
        });
        // console.log(response);
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
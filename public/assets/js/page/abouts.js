$(document).ready(function(){
    // $('.ourTeam').slick({
    //     lazyLoad: 'ondemand',
    //     slidesToShow: 3,
    //     slidesToScroll: 1
    // });
    $('.ourTeam').slick({
        infinite: true,
        slidesToShow: 2,
        slidesToScroll: 2,
        dots: true,
        autoplay: true,
        mobileFirst: true,
        pauseOnFocus: true,
        autoplaySpeed: 3000,
        speed: 1000,
        centerMode: false,
    });
});
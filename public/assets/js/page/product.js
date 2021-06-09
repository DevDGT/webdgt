$(document).ready(function(){
    $('.userProduct').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        dots: true,
        autoplay:true,
        mobileFirst:true,
        pauseOnFocus:true,
        autoplaySpeed:3000,
        speed: 1000,
        centerMode: false,
    });
});
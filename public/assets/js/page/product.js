var portfolioIsotope

$(document).ready(function () {
  // alert("asddsa")
  usersProduct();
  initPortpolio();
});

function usersProduct() {
  $('.userProduct').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 3,
    dots: true,
    autoplay: true,
    mobileFirst: true,
    pauseOnFocus: true,
    autoplaySpeed: 3000,
    speed: 1000,
    centerMode: false,
  });
}

function initPortpolio() {
  let portfolioContainer = select('.portfolio-container');
  if (portfolioContainer) {
    portfolioIsotope = new Isotope(portfolioContainer, {
      itemSelector: '.portfolio-item'
    });

    let portfolioFilters = select('#portfolio-flters li', true);

    on('click', '#portfolio-flters li', function (e) {
      e.preventDefault();
      portfolioFilters.forEach(function (el) {
        el.classList.remove('filter-active');
      });
      this.classList.add('filter-active');

      portfolioIsotope.arrange({
        filter: this.getAttribute('data-filter')
      });
      portfolioIsotope.on('arrangeComplete', function () {
        AOS.refresh()
      });
    }, true);
  }
}

// window.addEventListener('load', () => {


//   });
$(document).ready(() => {
  $('.lazy').lazy({
    effect: 'fadeIn',
    effectTime: 1000,
    threshold: 0
  });

  $('.owl-carousel').owlCarousel({
    loop: true,
    margin: 30,
    lazyLoad: true,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    responsive: {
        0: { items: 1 },
        576: { items: 1 },
        768: { items: 2 },
        992: { items: 3 },
        1200: { items: 4 }
    }
  });

  let scrollTop = $('#to-top');
  $(window).scroll(function() {
      $(scrollTop).css('opacity', $(this).scrollTop() > 100 ? '1' : '0');
  });
  $(scrollTop).click(function() {
      $('html, body').animate({
          scrollTop: 0
      }, 1000);
      return false;
  });
});
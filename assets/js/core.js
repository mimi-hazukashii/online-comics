jQuery.noConflict();
(function($) {
  $(document).ready(() => {
    $('.search-form .fa-search').click(() => {
      $('.search-form button').click();
    });

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
        0: {items: 2},
        576: {items: 2},
        768: {items: 3},
        992: {items: 4},
        1200: {items: 6}
      }
    });

    $('#switch-chapter').change(() => {
      location.href = $('#switch-chapter').val();
    });

    let position = $(window).scrollTop();
    $(window).scroll(() => {
      let scroll = $(this).scrollTop();
      if (scroll > position) {
        $('#read .box').hide('slow');
      } else {
        $('#read .box').show('slow');
      }
      position = scroll;
      if (scroll > 500) {
        $('#to-top').show('slow');
      } else {
        $('#to-top').hide('slow');
      }
    });

    $('#to-top').click(() => {
      $('html').animate({
        scrollTop: 0
      }, 1000);
    });
  });
})(jQuery);
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
            0: {items: 2},
            576: {items: 2},
            768: {items: 3},
            992: {items: 4},
            1200: {items: 6}
        }
    });

    let scrollTop = $('#to-top');
    $(window).scroll(() => {
        $(scrollTop).css('opacity', $(this).scrollTop() > 300 ? '1' : '0');
    });
    $(scrollTop).click(() => {
        $('html').animate({
            scrollTop: 0
        }, 1000);
    });
});
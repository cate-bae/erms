$(document).ready(function() {
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        center: true,
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        autoHeight:true,
        nav: true
    });

});
$(document).ready(function(){

    //Homepage home from home carousel
    $('.homeFromHomeSlider').owlCarousel({
        autoplay: true,
        autoplayHoverPause: false,
        dots: true,
        loop: true,
        nav: false,
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>'
        ],
        paginationSpeed: 3500,
        slideSpeed: 3500,
        items: 1
    });
    //Testimonial Main Carousel
    $('.testimonialMainCarousel').owlCarousel({
        autoplay: true,
        autoplayHoverPause: false,
        dots: true,
        loop: true,
        nav: false,
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>'
        ],
        paginationSpeed: 3500,
        slideSpeed: 3500,
        items: 1
    });
});

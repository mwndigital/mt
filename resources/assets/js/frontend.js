$(document).ready(function(){

    $('.navbar-toggler').click(function(){
       $(this).find('i').toggleClass('fa-bars fa-times');
    });

    //$('button.goldOutlineBtn')
    /*$('header .navbar ul.rightMenu .dropdown .dropdown-menu').each(function () {
        if ($(this).hasClass('show')) {
            $('header .navbar ul.rightMenu .dropdown button.goleOutlineBtn').toggleClass('fa-chevron-down fa-chevron-up');
            /!*$(this).closest('.dropdown').find('button.goldOutlineBtn i').toggleClass('fa-chevron-down fa-chevron-up');*!/
        }
    });*/
    $('ul.rightMenu li .goldOutlineBtn').click(function(){
        $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
    });


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

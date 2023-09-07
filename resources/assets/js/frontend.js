$(document).ready(function(){
    //Toggle the icon on navbar-toggler
    $('.navbar-toggler').click(function(){
       $(this).find('i').toggleClass('fa-bars fa-times');
    });
    //Toggle icon on the button on right menu
    $('ul.rightMenu li .goldOutlineBtn').click(function(){
        $(this).find('i').toggleClass('fa-chevron-down fa-chevron-up');
    });
    //Add class to header when scrolled
    $(window).scroll(function(){
        if($(window).scrollTop() > 0){
            $('header').addClass('scrolled');
        }
        else{
            $('header').removeClass('scrolled');
        }
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

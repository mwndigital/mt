$(document).ready(function () {
    //Toggle the icon on navbar-toggler
    $(".navbar-toggler").click(function () {
        $(this).find("i").toggleClass("fa-bars fa-times");
    });
    //Toggle icon on the button on right menu
    $("ul.rightMenu li .goldOutlineBtn").click(function () {
        $(this).find("i").toggleClass("fa-chevron-down fa-chevron-up");
    });
    //Add class to header when scrolled
    $(window).scroll(function () {
        if ($(window).scrollTop() > 0) {
            $("header").addClass("scrolled");
        } else {
            $("header").removeClass("scrolled");
        }
    });

    //Homepage home from home carousel
    $(".homeFromHomeSlider").owlCarousel({
        autoplay: true,
        autoplayHoverPause: false,
        dots: true,
        loop: true,
        nav: false,
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>',
        ],
        paginationSpeed: 3500,
        slideSpeed: 3500,
        items: 1,
    });
    //Testimonial Main Carousel
    $(".testimonialMainCarousel").owlCarousel({
        autoplay: true,
        autoplayHoverPause: false,
        dots: true,
        loop: true,
        nav: false,
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>',
        ],
        paginationSpeed: 3500,
        slideSpeed: 3500,
        items: 1,
    });
    //Rooms page lodge slider
    $(".roomsPageLodgeSlider").owlCarousel({
        autoplay: true,
        autoplayHoverPause: false,
        dots: true,
        loop: true,
        nav: false,
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>',
        ],
        paginationSpeed: 3500,
        slideSpeed: 3500,
        items: 1,
    });
    //Restaurant page slider
    $(".restaurantImageSlider").owlCarousel({
        autoplay: true,
        autoplayHoverPause: false,
        dots: true,
        loop: true,
        margin: 20,
        nav: false,
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>',
        ],
        paginationSpeed: 3500,
        slideSpeed: 3500,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 3,
            },
        },
    });
    //Our history page banner slider
    $(".historypageBannerSlider").owlCarousel({
        autoplay: true,
        autoplayHoverPause: false,
        dots: true,
        loop: true,
        nav: false,
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>',
        ],
        paginationSpeed: 1500,
        slideSpeed: 1500,
        items: 1,
    });
    //Lodge page image slider
    $(".lodgePageImageSlider").owlCarousel({
        autoplay: true,
        autoplayHoverPause: false,
        dots: true,
        loop: true,
        nav: false,
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>',
        ],
        paginationSpeed: 1500,
        slideSpeed: 1500,
        items: 1,
    });
    //Contact page
    $(".contactPageImageSlider").owlCarousel({
        autoplay: true,
        autoplayHoverPause: false,
        dots: true,
        loop: true,
        nav: false,
        navText: [
            '<i class="fas fa-chevron-left"></i>',
            '<i class="fas fa-chevron-right"></i>',
        ],
        paginationSpeed: 3500,
        slideSpeed: 3500,
        items: 1,
    });

    // Apply Coupon Code - Post Request TO apply-coupon endpoint
    $("#applyCouponBtn").click(function () {
        const csrfToken = $('meta[name="csrf-token"]').attr("content");
        const couponCode = $("#coupon_code").val();
        $.ajax({
            url: "/api/apply-coupon",
            type: "POST",
            data: {
                couponCode: couponCode,
                _token: csrfToken,
            },
            success: function (data) {
                if (data.status) {
                    // Change the total price
                    $("#totalAmount").text(`£${data.total}`);
                    $(".applyCoupon").html(
                        `<span class="text-success">Coupon Applied -  £${data.discount} Discount</span>`
                    );
                } else {
                    alert(data.message);
                }
            },
        });
    });
});

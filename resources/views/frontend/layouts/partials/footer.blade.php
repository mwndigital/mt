
            @include('frontend.pages.partials.newsletterBanner')
            <section class="awardsBanner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="awardsWrap">
                                <a href="https://www.secret-scotland.com/" rel="nofollow" target="_blank">
                                    <img class='img-fluid' src="{{ asset('images/secret-scotland-logo.webp') }}" alt="Secret Scotland Logo">
                                </a>
                                <a href="https://www.healthstaffdiscounts.co.uk/town/t/Aberlour" rel="nofollow" target="_blank">
                                    <img class="img-fluid" src="{{ asset('images/nhs-support-badge.webp') }}" alt="NHS Support Badge">
                                </a>
                                <a href="https://restaurantguru.com/Mash-Tun-Aberlour" rel="nofollow" target="_blank">
                                    <img class="img-fluid" src="{{ asset('logos/restaurant-guru.png') }}" alt="Resaurant Guru Image">
                                </a>
                                <a href="">
                                    <img class="img-fluid" src="{{ asset('logos/food-hygiene-image.png') }}" alt="food hygiene image">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
            <div class="modal fade viewMenuModal" id="viewWineMenuModal">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="{{ asset('images/menus/mash-tun-wine-list-new.pdf') }}" frameborder="0" width="100%" height="700px"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade viewMenuModal" id="viewWhiskyMenuModal">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="{{ asset('images/menus/mash-tun-whisky-flights.pdf') }}" frameborder="0" width="100%" height="700px"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade viewMenuModal" id="viewCocktailsMenuModal">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="{{ asset('images/menus/mash-tun-cocktails-list.pdf') }}" frameborder="0" width="100%" height="700px"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade viewMenuModal" id="viewDinnerMenuModal">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="{{ asset('images/menus/mash-tun-dinner-menu-new.pdf') }}" frameborder="0" width="100%" height="700px"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade viewMenuModal" id="viewWhiskySpiritsMenuModal">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <iframe src="{{ asset('images/menus/mash-tun-whisky-spirits-menu.pdf') }}" frameborder="0" width="100%" height="700px"></iframe>
                        </div>
                    </div>
                </div>
            </div>


        <footer>
            <div class="footerMain">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <img class="img-fluid footerLogo" src="{{ asset('logos/mash-tun-new-logo-main.webp') }}">
                            <ul class="list-unstyled footerAddress">
                                <li>
                                    The Mash Tun,
                                </li>
                                <li>
                                    8 Broomfield Square,
                                </li>
                                <li>
                                    Arberlour, Speyside,
                                </li>
                                <li>Scotland,</li>
                                <li>AB38 9QP</li>
                            </ul>

                        </div>
                        <div class="col-md-3">
                            <h5 class="footerTitle">Quick Links</h5>
                            <ul class="list-unstyled quickLinksMenu">
                                <li>
                                    <a href="/">Home</a>
                                </li>
                                <li><a href="{{ route('about-us') }}">Our History</a></li>
                                <li><a href="{{ route('faqs.index') }}">FAQs</a></li>
                                <li><a href="{{ route('gallery.index') }}">Gallery</a></li>
                                <li><a href="{{ route('bar') }}">Bar</a></li>
                                <li><a href="{{ route('restaurant.index') }}">Dining</a></li>
                                <li><a href="{{ route('rooms') }}">The Rooms</a></li>
                                <li><a href="{{ route('lodge.index') }}">Stalla Dhu Lodge</a></li>
                                <li><a href="{{ route('contact-us') }}">Contact Us</a></li>

                            </ul>
                        </div>
                        <div class="col-md-2">
                            <h5 class="footerTitle">Menu</h5>
                            <ul class="list-unstyled quickLinksMenu">
                                <li>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#viewDinnerMenuModal">Dinner Menu</a>
                                </li>
                                <li>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#viewWhiskySpiritsMenuModal">Whisky Menu</a>
                                </li>
                                <li>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#viewWineMenuModal">Wine Menu</a>
                                </li>
                                <li>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#viewCocktailsMenuModal">Cocktails Menu</a>
                                </li>
                                <li>
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#viewWhiskyMenuModal">
                                        Whisky Flights Menu
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5 class="footerTitle">Legal</h5>
                            <ul class="list-unstyled quickLinksMenu mb-4">
                                <li><a href="/deposit-cancellations-policy">Deposit & Cancellations Policy</a></li>
                                <li><a href="/privacy-policy">Privacy Policy</a></li>
                                <li><a href="/terms-conditions">Terms & Conditions</a></li>
                            </ul>
                            <h5 class="footerTitle">
                                Get in touch
                            </h5>
                            <ul class="list-inline contactDetails">
                                <li class="list-inline-item ">
                                    Tel: <a href="tel:+441340881771">01340 881771</a>
                                </li>
                                <li class="list-inline-item">
                                    Email: <a href="mailto:reservations@mashtun-aberlour.com">reservations@mashtun-aberlour.com</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footerBottom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                &copy; Copyright @php echo date("Y"); @endphp {{ config('app.name') }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-inline ms-auto socialLinks">
                                <li class="list-inline-item"><a href="https://www.tripadvisor.co.uk/Hotel_Review-g658240-d672367-Reviews-The_Mash_Tun-Aberlour_Moray_Scotland.html" rel="nofollow" target="_blank"><img class="img-fluid tripAdvisorLogo" src="{{ asset('logos/trip-advisor.svg') }}" alt="TripAdvisor Logo"></a></li>
                                <li class="list-inline-item"><a href="https://www.facebook.com/themashtunaberlour/?locale=en_GB" rel="nofollow" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="https://twitter.com/MashTunAberlour" rel="nofollow" target="_blank"><img class="img-fluid" src="{{ asset('images/icon-x.png') }}" alt="Twitter Icon" style=""></a></li>
                                <li class="list-inline-item"><a href="https://www.instagram.com/therealmashtunaberlour/?hl=en" rel="nofollow" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="https://restaurantguru.com/Mash-Tun-Aberlour" rel="nofollow" target="_blank"><img class="img-fluid" src="{{ asset('images/restaurant-guru-logo-icon-only.svg') }}"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
    <script>
        new WOW().init();
    </script>
</html>

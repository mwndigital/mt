
            <section class="newsletterBanner">
                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h4>newsletter</h4>
                        </div>
                    </div>
                </div>
            </section>
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
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer>
            <div class="footerMain">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
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
                            <ul class="list-unstyled contactDetails">
                                <li>
                                    Tel: <a href="tel:+441340881771">01340 881771</a>
                                </li>
                                <li>
                                    Email: <a href="mailto:reservations@mashtun-aberlour.com">reservations@mashtun-aberlour.com</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5 class="footerTitle">Quick Links</h5>
                            <ul class="list-unstyled quickLinksMenu">
                                <li>
                                    <a href="/">Home</a>
                                </li>
                                <li><a href="{{ route('about-us') }}">About Us</a></li>
                                <li><a href="{{ route('bar-restaurant') }}">The Bar & Restaurant</a></li>
                                <li><a href="{{ route('rooms') }}">The Rooms</a></li>
                                <li><a href="{{ route('contact-us') }}">Contact Us</a></li>

                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h5 class="footerTitle">Legal</h5>
                            <ul class="list-unstyled quickLinksMenu">
                                <li><a href="/deposit-cancellations-policy">Deposit & Cancellations Policy</a></li>
                                <li><a href="">Privacy Policy</a></li>
                                <li><a href="/terms-conditions">Terms & Conditions</a></li>
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
                                &copy; Copyright @php date("Y"); @endphp {{ config('app.name') }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-inline ms-auto socialLinks">
                                <li class="list-inline-item"><a href="" rel="nofollow" target="_blank"><img class="img-fluid tripAdvisorLogo" src="{{ asset('logos/trip-advisor.svg') }}" alt="TripAdvisor Logo"></a></li>
                                <li class="list-inline-item"><a href="" rel="nofollow" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li class="list-inline-item"><a href="" rel="nofollow" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="" rel="nofollow" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
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

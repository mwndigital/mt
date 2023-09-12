<div class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a href="/" class="navbar-brand">
            <img class="img-fluid" src="{{ asset('logos/mash-tun-new-logo-main.webp') }}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#frontendMainNavbar" aria-controls="frontendMainNavbar" aria-expanded="false" aria-label="Toggle Navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="frontendMainNavbar">
            <ul class="navbar-nav ms-auto">
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('about-us') }}">Our History</a></li>
                <li>
                    <a href="{{ route('gallery.index') }}">
                        Gallery
                    </a>
                </li>
                <li><a href="{{ route('bar-restaurant') }}">Bar</a></li>
                <li>
                    <a href="">
                        Restaurant
                    </a>
                </li>
                <li><a href="{{ route('rooms') }}">Rooms</a></li>
                {{--<li><a href="{{ route('book-a-room-index') }}">Book a room</a></li>--}}
                <li class="dropdown">
                    <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Our Menus</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="">Dinner Menu</a>
                        </li>
                        <li>
                            <a href="">
                                Whisky List
                            </a>
                        </li>
                        <li>
                            <a href="">Wine List</a>
                        </li>
                        <li>
                            <a href="">Cocktails List</a>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ route('contact-us') }}">Contact Us</a></li>

            </ul>
            <ul class="navbar-nav ms-auto rightMenu">
                <li class="ms-auto">
                    <div class="dropdown">
                        <button class="whiteOutlineBtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Book <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="{{ route('book-a-room-index') }}">Book a stay</a>
                            </li>
                            <li>
                                <a href="">Book a table</a>
                            </li>
                        </ul>
                        <ul class="list-inline ms-auto socialLinks">
                            <li class="list-inline-item"><a href="" rel="nofollow" target="_blank"><img class="img-fluid tripAdvisorLogo" src="{{ asset('logos/trip-advisor.svg') }}" alt="TripAdvisor Logo"></a></li>
                            <li class="list-inline-item"><a href="" rel="nofollow" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li class="list-inline-item"><a href="" rel="nofollow" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="" rel="nofollow" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

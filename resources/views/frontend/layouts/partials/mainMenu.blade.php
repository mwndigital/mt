<div class="navbar navbar-expand-xl">
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
                <li><a href="{{ route('bar') }}">Bar</a></li>
                <li>
                    <a href="{{ route('restaurant.index') }}">
                        Dining
                    </a>
                </li>
                <li><a href="{{ route('rooms') }}">Rooms</a></li>
                <li>
                    <a href="{{ route('lodge.index') }}">Lodge</a>
                </li>
                <li>
                    <a href="">Cigar & Whisky Shop</a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Our Menus</a>
                    <ul class="dropdown-menu">
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
                        <li>
                            <a type="button" data-bs-toggle="modal" data-bs-target="#viewCigarMenuModal">Cigar Menu</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('faqs.index') }}">FAQs</a>
                </li>
                <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                <li>
                    <a href="@if(Auth::check())
                                 {{ route('customer.dashboard') }}
                              @else
                                 {{ route('login') }}
                              @endif"
                       title="Login to your account">
                        <i class="fas fa-user"></i>
                    </a>
                </li>
                            </ul>
            <ul class="navbar-nav ms-auto rightMenu">
                <li class="ms-auto">
                    <div class="dropdown">
                        <button class="darkGoldBtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Book <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="{{ route('book-a-room-index') }}">Book a stay</a>
                            </li>
                            <li>
                                <a href="{{ route('book-a-table-index') }}">Book a table</a>
                            </li>
                        </ul>

                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

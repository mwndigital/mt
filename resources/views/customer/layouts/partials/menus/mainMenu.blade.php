<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="" class="navbar-brand">
                <img class="img-fluid" src="{{ asset('logos/main-logo.webp') }}">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#frontendNavbarCollapse">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="frontendNavbarCollapse">
                <ul class="navbar-nav ms-auto">
                    <li>
                        <a href="{{ route('customer.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="">
                            My Dining Bookings
                        </a>
                    </li>
                    <li>
                        <a href="">My Room Bookings</a>
                    </li>
                    <li>
                        <a href="{{ route('customer.my-account', auth()->user()->id) }}">My Account</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

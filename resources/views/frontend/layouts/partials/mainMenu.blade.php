<div class="navbar navbar-expand-lg">
    <div class="container">
        <a href="/" class="navbar-brand">
            <img class="img-fluid" src="{{ asset('logos/mash-tun-new-logo-main.webp') }}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#frontendMainNavbar" aria-controls="frontendMainNavbar" aria-expanded="false" aria-label="Toggle Navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="frontendMainNavbar">
            <ul class="navbar-nav ms-auto">
                <li><a href="/">Home</a></li>
                <li><a href="{{ route('about-us') }}">About Us</a></li>
                <li><a href="{{ route('bar-restaurant') }}">The Bar & Restaurant</a></li>
                <li><a href="{{ route('rooms') }}">The Rooms</a></li>
                <li><a href="{{ route('book-a-room-index') }}">Book a room</a></li>
                <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
            </ul>
        </div>
    </div>
</div>

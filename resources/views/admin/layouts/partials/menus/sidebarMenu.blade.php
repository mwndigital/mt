<ul class="sidebarMenu list-unstyled">
    <li>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pages
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('admin.homepage.edit', ['homepage' => 1]) }}">Homepage</a>
            </li>
            <li>
                <a href="{{ route('admin.about-us.edit', ['about_u' => 1]) }}">About us</a>
            </li>
            <li><a href="{{ route('admin.bar-restaurant.edit', ['bar_restaurant' => 1]) }}">The Bar & Restaurant</a></li>
            <li><a href="{{ route('admin.rooms-page.edit', ['rooms_page' => 1]) }}">The Rooms</a></li>

            <li>
                <a href="{{ route('admin.faqs-page.edit', ['faqs_page' => 1]) }}">FAQs</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="{{ route('admin.bookings.index') }}">Room Bookings</a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Restaurant Bookings</a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('admin.restaurant-bookings.index') }}">All Bookings</a>
            </li>
            <li>
                <a href="{{ route('admin.restaurant-bookings.create') }}">Create Booking</a>
            </li>
            <li>
                <a href="{{ route('admin.restaurant-tables.index') }}">All Tables</a>
            </li>
            <li>
                <a href="{{ route('admin.restaurant-tables.create') }}">Add Table</a>
            </li>
        </ul>
    </li>
    <li><a href="/admin/rooms">Rooms</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Gallery</a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('admin.gallery.index') }}">All Gallery Items</a>
            </li>
            <li>
                <a href="{{ route('admin.gallery.create') }}">Create Gallery Item</a>
            </li>
            <li>
                <a href="{{ route('admin.gallery-category.index') }}">All Gallery Categories</a>
            </li>
            <li>
                <a href="{{ route('admin.gallery-category.create') }}">Create New Gallery Category</a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Menu</a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('admin.menu.index') }}">All Menu Items</a>
            </li>
            <li>
                <a href="{{ route('admin.menu.create') }}">Create Menu Item</a>
            </li>
            <li>
                <a href="{{ route('admin.menu-category.index') }}">All Menu Categories</a>
            </li>
            <li>
                <a href="{{ route('admin.menu-category.create') }}">Create new menu category</a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Whisky Selection
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('admin.whisky.index') }}">All Whisky Selection</a>
            </li>
            <li>
                <a href="{{ route('admin.whisky.create') }}">Add New Whisky</a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="falase">
            FAQs
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('admin.faq.index') }}">All FAQs</a>
            </li>
            <li>
                <a href="{{ route('admin.faq.create') }}">Add New FAQ</a>
            </li>
            <li>
                <a href="{{ route('admin.faq-category.index') }}">All FAQ Categories</a>
            </li>
            <li>
                <a href="{{ route('admin.faq-category.create') }}">Add new FAQ Category</a>
            </li>
        </ul>
    </li>
    <li class="dropdown">
        <a href="" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Policy Pages
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{ route('admin.policy-pages.index') }}">All Policy Pages</a>
            </li>
            <li><a href="{{ route('admin.policy-pages.create') }}">Create New Policy Page</a></li>
        </ul>
    </li>
    <li><a href="">Settings</a></li>

</ul>

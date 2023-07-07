<ul class="sidebarMenu list-unstyled">
    <li>
        <a href="">Dashboard</a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pages
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="">Homepage</a>
            </li>
            <li>
                <a href="">About us</a>
            </li>
            <li><a href="">The Bar & Restaurant</a></li>
            <li><a href="">The Rooms</a></li>
            <li><a href="">Contact Us</a></li>
        </ul>
    </li>
    <li><a href="">Bookings</a></li>
    <li><a href="{{ route('admin.rooms.index') }}">Rooms</a></li>
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
    <li><a href="">Settings</a></li>

</ul>

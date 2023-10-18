<header>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-4">
                <a href="" class="brand">
                    <img class="img-fluid adminTopBarLogo" src="{{ asset('logos/main-logo.webp') }}">
                </a>
            </div>
            <div class="col-md-4">
                <div class="searchWrapper">
                    <form class="searchForm" action="{{ route('admin.search') }}">

                        <div class="input-group">
                            <input type="search" name="q" id="search" placeholder="Search...">
                            <button type="submit" class="input-group-text"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="d-flex justify-content-end">
                    <li>
                        <button type="button" class="sidebarToggleBtn">
                            <i class="fa fa-times"></i> <span>Close Menu</span>
                        </button>
                    </li>
                    <li class="dropdown">
                        <button type="button" class="dropdown-toggle notificationButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            @if(auth()->user()->unreadNotifications)
                                <span class="notifAmount">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            @endif
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @foreach(auth()->user()->unreadNotifications as $notification)
                                <li class="dropdown-item notificationItemInner">
                                    <h5>{{ $notification->data['title'] }}</h5>
                                    <p>
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <button class="mark-as-read" data-notification-id="{{ $notification->id }}">Mark as Read</button>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="" class="dropdown-item">My Account</a>
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
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<header>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-4">
                <a href="" class="brand">
                    <img class="img-fluid adminTopBarLogo" src="{{ asset('logos/main-logo.webp') }}">
                </a>
            </div>
            {{--<div class="col-md-4">
                <div class="searchWrapper">
                    <form class="searchForm" action="{{ route('admin.search') }}">

                        <div class="input-group">
                            <input type="search" name="q" id="search" placeholder="Search...">
                            <button type="submit" class="input-group-text"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>--}}
            <div class="col-md-8">
                <ul class="d-flex justify-content-end">
                    <li>
                        <button type="button" class="sidebarToggleBtn d-none d-sm-none d-md-none d-lg-block d-xl-block">
                            <i class="fa fa-times"></i> <span>Close Menu</span>
                        </button>
                        <button type="button" class="sidebarToggleBtnMobile d-sm-block d-md-block d-lg-none d-xl-none">
                            <i class="fa fa-bars"></i> <span>Open Menu</span>
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
                            <li>
                                <div class="row align-items-center notifTopItem">
                                    <div class="col-6">
                                        <h5>Notifications</h5>
                                    </div>
                                    <div class="col-6">
                                        <form action="{{ route('admin.mark-all-notifications-as-read') }}" method="post">
                                            @csrf
                                            <button type="submit">Mark all as read</button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            @foreach(auth()->user()->unreadNotifications as $notification)
                                <li class="dropdown-item notificationItemInner">
                                    <h5>{{ $notification->data['title'] }}</h5>
                                    <p>
                                        {{ $notification->data['message'] }}
                                    </p>
                                    <form action="{{ route('admin.mark-notification-as-read', $notification->id) }}" method="post">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="mark-as-read">
                                            Mark as read
                                        </button>
                                    </form>
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

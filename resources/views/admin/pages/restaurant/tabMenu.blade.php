<a class="list-group-item list-group-item-action {{ Route::is('admin.restaurant-bookings.index') ? 'active' : '' }}" id='list-latest-list' href="{{ route('admin.restaurant-bookings.index') }}">Latest Bookings</a>
<a class="list-group-item list-group-item-action {{ Route::is('admin.restaurant-bookings.todays-bookings') ? 'active' : '' }}" id="list-home-list"
   href="{{ route('admin.restaurant-bookings.todays-bookings') }}">Todays Bookings</a>
<a class="list-group-item list-group-item-action {{ Route::is('admin.restaurant-bookings.this-weeks-bookings') ? 'active' : '' }}" id="list-profile-list"
   href="{{ route('admin.restaurant-bookings.this-weeks-bookings') }}" role="tab">This Weeks
    Bookings</a>
<a class="list-group-item list-group-item-action {{ Route::is('admin.restaurant-bookings.all-bookings') ? 'active' : '' }}" id="list-messages-list"
   href="{{ route('admin.restaurant-bookings.all-bookings') }}" role="tab"
   aria-controls="list-messages">All Bookings</a>

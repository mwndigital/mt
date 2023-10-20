<a class="list-group-item list-group-item-action {{ Route::is('admin.bookings.index') ? 'active' : '' }}" id="list-latest-list" href="{{ route('admin.bookings.index') }}">Latest Bookings</a>
<a class="list-group-item list-group-item-action {{ Route::is('admin.book-a-room.todays-bookings') ? 'active' : '' }}" id="list-home-list"
   href="{{ route('admin.book-a-room.todays-bookings') }}">Todays Bookings</a>
<a class="list-group-item list-group-item-action {{ Route::is('admin.book-a-room.this-weeks-bookings-index') ? 'active' : '' }}" id="list-profile-list"
   href="{{ route('admin.book-a-room.this-weeks-bookings-index') }}">This Weeks</a>
<a class="list-group-item list-group-item-action {{ Route::is('admin.book-a-room.all-bookings-index') ? 'active' : '' }}" id="list-messages-list"
   href="{{ route('admin.book-a-room.all-bookings-index') }}" aria-controls="list-messages">All
    Bookings</a>
<a class="list-group-item list-group-item-action {{ Route::is('admin.book-a-room.deleted-bookings-index') ? 'active' : '' }}" id="list-messages-list"
   href="{{ route('admin.book-a-room.deleted-bookings-index') }}"
   aria-controls="list-messages">Deleted</a>
<a class="list-group-item list-group-item-action {{ Route::is('admin.book-a-room.incomplete-bookings') ? 'active' : '' }}" id="list-messages-list"
   href="{{ route('admin.book-a-room.incomplete-bookings') }}"
   aria-controls="list-messages">incomplete</a>

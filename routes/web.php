<?php

use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminFaqCategoryController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminGalleryCategoryController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminRestaurantBlockedDates;
use App\Http\Controllers\Admin\AdminRestaurantBlockedDatesController;
use App\Http\Controllers\Admin\AdminRestaurantBookingController;
use App\Http\Controllers\Admin\AdminRestaurantTableController;
use App\Http\Controllers\Admin\AdminSearchController;
use App\Http\Controllers\Admin\AdminUserManagementController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\Pages\AdminAboutUsPageController;
use App\Http\Controllers\Admin\Pages\AdminAboutUsPageNewController;
use App\Http\Controllers\Admin\Pages\AdminBarPageController;
use App\Http\Controllers\Admin\Pages\AdminBarRestaurantPageController;
use App\Http\Controllers\Admin\Pages\AdminCigarWhiskyPageController;
use App\Http\Controllers\Admin\Pages\AdminContactUsPageController;
use App\Http\Controllers\Admin\Pages\AdminDiningPageContent;
use App\Http\Controllers\Admin\Pages\AdminFaqsPageController;
use App\Http\Controllers\Admin\Pages\AdminHomepageController;
use App\Http\Controllers\Admin\Pages\AdminLodgePageController;
use App\Http\Controllers\Admin\Pages\AdminPolicyPagesController;
use App\Http\Controllers\Admin\Pages\AdminRoomsPageController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\WhiskyController;
use App\Http\Controllers\Customer\CustomerAccountController;
use App\Http\Controllers\Customer\CustomerIndexController;
use App\Http\Controllers\Customer\CustomerRestaurantController;
use App\Http\Controllers\Customer\CustomerRoomBookingsController;
use App\Http\Controllers\Frontend\AboutUsPageController;
use App\Http\Controllers\Frontend\BarPageController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\ContactPageController;
use App\Http\Controllers\Frontend\FrontendAboutUsPageController;
use App\Http\Controllers\Frontend\FrontendCigarWhiskyPage;
use App\Http\Controllers\Frontend\FrontendFaqController;
use App\Http\Controllers\Frontend\FrontendGalleryController;
use App\Http\Controllers\Frontend\FrontendLodgeController;
use App\Http\Controllers\Frontend\FrontendOurHistoryPageController;
use App\Http\Controllers\Frontend\FrontendPolicyPageController;
use App\Http\Controllers\Frontend\FrontendRestaurantBookingController;
use App\Http\Controllers\Frontend\FrontendRestaurantPageController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\RoomsPageController;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\SitemapGenerator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Admin Routes
Route::middleware(['auth', 'role:super admin|admin|staff'])->name('admin.')->prefix('admin')->group(function () {
    // API will move to api.php
    Route::delete('remove-image', [\App\Http\Controllers\Admin\ApiController::class, 'removeImage'])->name('remove-image');
    Route::post('upload-image', [\App\Http\Controllers\Admin\ApiController::class, 'uploadImage'])->name('upload-image');
    Route::post('sort-images', [\App\Http\Controllers\Admin\ApiController::class, 'sortImages'])->name('sort-images');

    //Dashboard
    Route::post('contact-form-submission-test-email', [AdminIndexController::class, 'formSubmissionTestEmail'])->name('contact-form-submission-test-email');
    Route::get('dashboard', [AdminIndexController::class, 'index'])->name('dashboard');

    //Rooms
    /*Route::post('/rooms/{room}/gallery', [RoomController::class, 'galleryItemStore'])->name('rooms.gallery-store');*/
    Route::resource('rooms', RoomController::class);

    // Booking status
    Route::get('booking-status/{id}', [AdminBookingController::class, 'changeStatus'])->name('booking-status');

    //FAQs
    Route::prefix('faqs')->group(function () {
        Route::resource('faq', AdminFaqController::class)->names([
            'index' => 'faq.index',
            'create' => 'faq.create',
            'store' => 'faq.store',
            'show' => 'faq.show',
            'edit' => 'faq.edit',
            'update' => 'faq.update',
            'destroy' => 'faq.destroy'
        ]);
        Route::resource('categories', AdminFaqCategoryController::class)->names([
            'index' => 'faq-category.index',
            'create' => 'faq-category.create',
            'store' => 'faq-category.store',
            'show' => 'faq-category.show',
            'edit' => 'faq-category.edit',
            'update' => 'faq-category.update',
            'destroy' => 'faq-category.destroy',
        ]);
    });

    //Menu Category
    Route::prefix('menu')->group(function () {
        Route::resource('category', MenuCategoryController::class)->names([
            'index' => 'menu-category.index',
            'create' => 'menu-category.create',
            'store' => 'menu-category.store',
            'show' => 'menu-category.show',
            'edit' => 'menu-category.edit',
            'update' => 'menu-category.update',
            'destroy' => 'menu-category.destroy',
        ]);
    });

    //Menu
    Route::resource('menu', MenuController::class);

    //Gallery
    Route::prefix('gallery')->group(function () {
        Route::resource('gallery-category', AdminGalleryCategoryController::class);
    });
    Route::resource('gallery', AdminGalleryController::class);

    //Whisky
    Route::resource('whisky', WhiskyController::class);

    //Bookings
    Route::prefix('bookings')->group(function () {
        Route::post('stepOneStore', [AdminBookingController::class, 'stepOneStore'])->name('book-a-room-step-one-store');
        Route::get('stepTwo', [AdminBookingController::class, 'stepTwoShow'])->name('book-a-room-step-two');
        Route::post('stepTwoStore', [AdminBookingController::class, 'stepTwoStore'])->name('book-a-room-step-two-store');
        Route::get('stepThree', [AdminBookingController::class, 'stepThreeShow'])->name('book-a-room-step-three');
        Route::post('stepThreeStore', [AdminBookingController::class, 'stepThreeStore'])->name('book-a-room-step-three-store');
        Route::get('stepFour', [AdminBookingController::class, 'stepFourShow'])->name('book-a-room-step-four');
        Route::post('stepFourStore', [AdminBookingController::class, 'stepFourStore'])->name('book-a-room-step-four-store');

        Route::get('upload', [AdminBookingController::class, 'csvUpload'])->name('book-a-room.csv-upload');
        Route::post('csv-store', [AdminBookingController::class, 'csvStore'])->name('book-a-room.csv-store');

        Route::get('print-today-bookings', [AdminBookingController::class, 'printTodayBooking'])->name('book-a-room.print-today-booking');
        Route::get('print-this-week-bookings', [AdminBookingController::class, 'printThisWeeksBookings'])->name('book-a-room.print-this-weeks-booking');

        Route::get('this-weeks-bookings', [AdminBookingController::class, 'thisWeeksBookingsIndex'])->name('book-a-room.this-weeks-bookings-index');
        Route::get('all-bookings', [AdminBookingController::class, 'allBookingsIndex'])->name('book-a-room.all-bookings-index');
        Route::get('deleted-bookings', [AdminBookingController::class, 'deletedIndex'])->name('book-a-room.deleted-bookings-index');
        Route::get('incomplete-bookings', [AdminBookingController::class, 'incompleteBookings'])->name('book-a-room.incomplete-bookings');
        Route::get('todays-bookings', [AdminBookingController::class, 'todaysBookings'])->name('book-a-room.todays-bookings');
    });
    Route::put('bookings/{id}/mark-as-paid', [AdminBookingController::class, 'markAsPaid'])->name('book-a-room.mark-as-paid');
    Route::put('bookings/{id}/status/{status}', [AdminBookingController::class, 'updateStatus'])->name('book-a-room.update-status');
    Route::resource('bookings', AdminBookingController::class)->name('bookings', 'bookings.index');
    Route::post('bookings/{id}/edit', [AdminBookingController::class, 'update'])->name('bookings.edit');


    //Restaurant Booking controller
    Route::prefix('restaurant-bookings')->group(function () {
        Route::get('upload', [AdminRestaurantBookingController::class, 'csvUpload'])->name('restaurant-bookings.csv-upload');
        Route::post('csv-store', [AdminRestaurantBookingController::class, 'csvStore'])->name('restaurant-bookings.csv-store');
        Route::get('print-today-bookings', [AdminRestaurantBookingController::class, 'printTodayBookings'])->name('restaurant-bookings.print-today-bookings');
        Route::get('print-this-week-bookings', [AdminRestaurantBookingController::class, 'printThisWeeksBookings'])->name('restaurant-bookings.print-this-week-bookings');
        Route::get('print-all-bookings', [AdminRestaurantBookingController::class, 'printAllBookings'])->name('restaurant-bookings.print-all-bookings');
        Route::get('this-weeks-bookings', [AdminRestaurantBookingController::class, 'thisWeeksBookingsIndex'])->name('restaurant-bookings.this-weeks-bookings');
        Route::get('all-bookings', [AdminRestaurantBookingController::class, 'allBookingsIndex'])->name('restaurant-bookings.all-bookings');
        Route::get('todays-bookings', [AdminRestaurantBookingController::class, 'todaysBookingsIndex'])->name('restaurant-bookings.todays-bookings');

        Route::resource('restaurant-blocked-dates', AdminRestaurantBlockedDatesController::class);
    });
    Route::put('restaurant-bookings/{id}/cancel-booking', [AdminRestaurantBookingController::class, 'cancelBooking'])->name('restaurant-bookings.cancel-booking');
    Route::resource('restaurant-bookings', AdminRestaurantBookingController::class);

    //Restaurant Tables
    Route::resource('restaurant-tables', AdminRestaurantTableController::class);

    //Pages
    Route::prefix('pages')->group(function () {
        Route::resource('homepage', AdminHomepageController::class);
        Route::resource('our-history', AdminAboutUsPageController::class);
        Route::resource('bar-restaurant', AdminBarRestaurantPageController::class);
        Route::resource('rooms-page', AdminRoomsPageController::class);
        Route::resource('policy-pages', AdminPolicyPagesController::class);
        Route::resource('faqs-page', AdminFaqsPageController::class);
        Route::resource('bar-page', AdminBarPageController::class);
        Route::resource('dining-page', AdminDiningPageContent::class);
        Route::resource('lodge-page', AdminLodgePageController::class);
        Route::resource('contact-page', AdminContactUsPageController::class);
        Route::resource('cigar-whisky-page', AdminCigarWhiskyPageController::class);
        Route::resource('about-us', AdminAboutUsPageNewController::class);
    });

    //Search
    Route::get('/search', [AdminSearchController::class, 'search'])->name('search');

    //User management
    Route::prefix('users')->group(function () {
        Route::get('/', [AdminUserManagementController::class, 'index'])->name('users.index');
        Route::get('/create', [AdminUserManagementController::class, 'create'])->name('users.create');
        Route::post('/store', [AdminUserManagementController::class, 'store'])->name('users.store');
    });

    //Notifications
    Route::get('mark-all-notifications-as-read', [AdminIndexController::class, 'markAllNotificationsAsRead'])->name('mark-all-notifications-as-read');
    Route::patch('mark-notification-as-read/{id}', [AdminindexController::class, 'markNotificationAsRead'])->name('mark-notification-as-read');
});

//Staff Routes
Route::middleware(['auth', 'role:staff'])->name('staff.')->prefix('staff')->group(function () {
    //Dashboard
    Route::get('dashboard', [\App\Http\Controllers\Staff\StaffIndexController::class, 'index'])->name('dashboard');
});

//Customer Routes
Route::middleware(['auth'])->name('customer.')->prefix('customer')->group(function () {
    //Dashboard
    Route::get('dashboard', [CustomerIndexController::class, 'index'])->name('dashboard');

    //Restaurant Bookings
    Route::prefix('dining-bookings')->group(function () {
        Route::get('/', [CustomerRestaurantController::class, 'index'])->name('dining-bookings');
    });

    //Room Bookings
    Route::prefix('room-bookings')->group(function () {
        Route::get('/', [CustomerRoomBookingsController::class, 'index'])->name('room-bookings');
    });

    //Account
    Route::prefix('my-account')->group(function () {
        Route::get('/{id}', [CustomerAccountController::class, 'show'])->name('my-account');
        Route::get('/edit/{id}', [CustomerAccountController::class, 'edit'])->name('my-account.edit');
        Route::put('/update/{id}', [CustomerAccountController::class, 'update'])->name('my-account.update');
        Route::get('/change-password/{id}', [CustomerAccountController::class, 'changePasswordView'])->name('my-account.change-password');
    });
});

Auth::routes();

//Frontend routes
Route::get('/', [HomepageController::class, 'index']);
Route::get('/home', function () {
    return redirect('/');
});
Route::get('about-us', [FrontendAboutUsPageController::class, 'index'])->name('about-us');
Route::get('/our-history', [FrontendOurHistoryPageController::class, 'index'])->name('our-history');
Route::get('/rooms', [RoomsPageController::class, 'index'])->name('rooms');
Route::get('lodge', [FrontendLodgeController::class, 'index'])->name('lodge.index');
Route::get('/bar', [BarPageController::class, 'index'])->name('bar');
Route::get('/contact-us', [ContactPageController::class, 'index'])->name('contact-us');
Route::post('/contact-us-submission-store', [ContactPageController::class, 'store'])->name('contact-us-submission-store');
Route::resource('/gallery', FrontendGalleryController::class);
Route::get('/dining', [FrontendRestaurantPageController::class, 'index'])->name('restaurant.index');
Route::get('/faqs', [FrontendFaqController::class, 'index'])->name('faqs.index');
Route::get('/cigar-and-whisky-shop', [FrontendCigarWhiskyPage::class, 'index'])->name('cigar-whisky-shop.index');
Route::prefix('book-a-room')->group(function () {
    Route::get('select-room/{id}', [BookingController::class, 'selectRoom'])->name('select-room');
    Route::get('step-2', [BookingController::class, 'stepTwoShow'])->name('book-a-room-step-2');
    Route::post('step-two-store', [BookingController::class, 'stepTwoStore'])->name('book-a-room-step-2-store');

    Route::get('step-3', [BookingController::class, 'stepThreeShow'])->name('book-a-room-step-3');
    Route::post('step-three-store', [BookingController::class, 'stepThreeStore'])->name('book-a-room-step-3-store');

    Route::get('step-4', [BookingController::class, 'stepFourShow'])->name('book-a-room-step-4');
    Route::post('step-four-store', [BookingController::class, 'stepFourStore'])->name('book-a-room-step-four-store');
});
Route::prefix('payment')->group(function () {
    Route::get('process-payment', [BookingController::class, 'processPayment'])->name('process-payment');
    Route::get('thank-you', [BookingController::class, 'thankYou'])->name('booking-thank-you');
    Route::get('payment-failed', [BookingController::class, 'paymentFailed'])->name('booking-payment-failed');
    Route::post('/sagepay/notify', [BookingController::class, 'sagepayNotify'])->name('sagepay-notify');
});
Route::get('/book-a-room', [BookingController::class, 'index'])->name('book-a-room-index');
Route::post('/book-room-step-one-store', [BookingController::class, 'stepOneStore'])->name('book-a-room-step-1-store');
Route::get('/{slug}', [FrontendPolicyPageController::class, 'show'])
    ->where('slug', '[A-Za-z0-9\-]+')
    ->name('policy-page.show');

//Restaurant booking
Route::prefix('book-a-table')->group(function () {
    Route::get('step-one', [FrontendRestaurantBookingController::class, 'index'])->name('book-a-table-index');
    Route::post('step-one-store', [FrontendRestaurantBookingController::class, 'indexStore'])->name('book-a-table-index-store');
    Route::get('step-two', [FrontendRestaurantBookingController::class, 'stepTwoShow'])->name('book-a-table-step-two-show');
    Route::post('step-two-store', [FrontendRestaurantBookingController::class, 'stepTwoStore'])->name('book-a-table-step-two-store');
    Route::get('thank-you', [FrontendRestaurantBookingController::class, 'thankYou'])->name('book-a-table-thank-you');

    Route::get('blocked-dates', [FrontendRestaurantBookingController::class, 'getBlockedDates'])->name('blocked-dates-check');
});


//Sitemap generation URL do not touch
Route::get('generate-sitemap', function () {
    $baseUrl = config('app.url');
    SitemapGenerator::create($baseUrl)
        ->writeToFile(public_path('sitemap.xml'));
});

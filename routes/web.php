<?php

use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\AdminGalleryCategoryController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\Pages\AdminAboutUsPageController;
use App\Http\Controllers\Admin\Pages\AdminBarRestaurantPageController;
use App\Http\Controllers\Admin\Pages\AdminContactUsPageController;
use App\Http\Controllers\Admin\Pages\AdminHomepageController;
use App\Http\Controllers\Admin\Pages\AdminPolicyPagesController;
use App\Http\Controllers\Admin\Pages\AdminRoomsPageController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\WhiskyController;
use App\Http\Controllers\Frontend\AboutUsPageController;
use App\Http\Controllers\Frontend\BarPageController;
use App\Http\Controllers\Frontend\BarRestaurantPageController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\ContactPageController;
use App\Http\Controllers\Frontend\FrontendGalleryController;
use App\Http\Controllers\Frontend\FrontendPolicyPageController;
use App\Http\Controllers\Frontend\HomepageController;
use App\Http\Controllers\Frontend\RoomsPageController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth', 'role:super admin|admin'])->name('admin.')->prefix('admin')->group(function(){
    //Dashboard
    Route::post('contact-form-submission-test-email', [AdminIndexController::class, 'formSubmissionTestEmail'])->name('contact-form-submission-test-email');
    Route::get('dashboard', [AdminIndexController::class, 'index'])->name('dashboard');

    //Rooms
    Route::resource('rooms', RoomController::class);

    //Menu Category
    Route::prefix('menu')->group(function(){
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
    Route::prefix('gallery')->group(function(){
       Route::resource('gallery-category', AdminGalleryCategoryController::class);
    });
    Route::resource('gallery', AdminGalleryController::class);

    //Whisky
    Route::resource('whisky', WhiskyController::class);

    //Bookings
    Route::prefix('bookings')->group(function(){
        Route::post('stepOneStore', [AdminBookingController::class, 'stepOneStore'])->name('book-a-room-step-one-store');
        Route::get('stepTwo', [AdminBookingController::class, 'stepTwoShow'])->name('book-a-room-step-two');
        Route::post('stepTwoStore', [AdminBookingController::class, 'stepTwoStore'])->name('book-a-room-step-two-store');
        Route::get('stepThree', [AdminBookingController::class, 'stepThreeShow'])->name('book-a-room-step-three');
        Route::post('stepThreeStore', [AdminBookingController::class, 'stepThreeStore'])->name('book-a-room-step-three-store');
        Route::get('stepFour', [AdminBookingController::class, 'stepFourShow'])->name('book-a-room-step-four');
        Route::post('stepFourStore', [AdminBookingController::class, 'stepFourStore'])->name('book-a-room-step-four-store');
    });
    Route::resource('bookings', AdminBookingController::class);

    //Pages
    Route::prefix('pages')->group(function(){
        Route::resource('homepage', AdminHomepageController::class);
        Route::resource('about-us', AdminAboutUsPageController::class);
        Route::resource('bar-restaurant', AdminBarRestaurantPageController::class);
        Route::resource('rooms-page', AdminRoomsPageController::class);
        Route::resource('contact-us', AdminContactUsPageController::class);
        Route::resource('rooms', AdminRoomsPageController::class);
        Route::resource('policy-pages', AdminPolicyPagesController::class);
    });
});

//Staff Routes
Route::middleware(['auth', 'role:staff'])->name('staff.')->prefix('staff')->group(function(){
    //Dashboard
    Route::get('dashboard', [\App\Http\Controllers\Staff\StaffIndexController::class, 'index'])->name('dashboard');

});

//Customer Routes
Route::middleware(['auth', 'role:customer'])->name('customer.')->prefix('customer')->group(function(){
    //Dashboard
    Route::get('dashboard', [\App\Http\Controllers\Customer\CustomerIndexController::class, 'index'])->name('dashboard');
});

Auth::routes();

//Frontend routes
Route::get('/', [HomepageController::class, 'index']);
Route::get('/about-us', [AboutUsPageController::class, 'index'])->name('about-us');
Route::get('/rooms', [RoomsPageController::class, 'index'])->name('rooms');
Route::get('/the-bar-restaurant', [BarPageController::class, 'index'])->name('bar-restaurant');
Route::get('/contact-us', [ContactPageController::class, 'index'])->name('contact-us');
Route::post('/contact-us-submission-store', [ContactPageController::class, 'store'])->name('contact-us-submission-store');
Route::resource('/gallery', FrontendGalleryController::class);
Route::prefix('book-a-room')->group(function(){
    Route::get('step-2', [BookingController::class, 'stepTwoShow'])->name('book-a-room-step-2');
    Route::post('step-two-store', [BookingController::class, 'stepTwoStore'])->name('book-a-room-step-2-store');

    Route::get('step-3', [BookingController::class, 'stepThreeShow'])->name('book-a-room-step-3');
    Route::post('step-three-store', [BookingController::class, 'stepThreeStore'])->name('book-a-room-step-3-store');

    Route::get('step-4', [BookingController::class, 'stepFourShow'])->name('book-a-room-step-4');
    Route::post('step-four-store', [BookingController::class, 'stepFourStore'])->name('book-a-room-step-four-store');

    Route::get('payment-step', [BookingController::class, 'paymentStep'])->name('book-a-room-payment-step');

    Route::post('process-payment', [BookingController::class, 'processPayment'])->name('book-a-room-process-payment');

    Route::get('thank-you', [BookingController::class, 'thankYou'])->name('book-a-room-thank-you');
});
Route::get('/book-a-room', [BookingController::class, 'index'])->name('book-a-room-index');
Route::post('/book-room-step-one-store', [BookingController::class, 'stepOneStore'])->name('book-a-room-step-1-store');
Route::post('/sagepay/notify', [BookingController::class, 'sagepayNotify'])->name('sagepay.notify');
Route::get('/{slug}', [FrontendPolicyPageController::class, 'show'])
    ->where('slug', '[A-Za-z0-9\-]+')
    ->name('policy-page.show');


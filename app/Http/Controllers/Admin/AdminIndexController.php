<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Mail\AdminContactFormSubmissionMail;
use App\Models\Booking;
use App\Models\ContactFormSubmissions;
use App\Models\RestaurantBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = Carbon::today()->startOfDay();
        $endOfWeek = $today->copy()->endOfWeek(Carbon::SUNDAY);

        $restaurantToday = RestaurantBooking::where('reservation_date' , '>=', $today)
            ->where('reservation_date', '<', $today->copy()->addDay())
            ->orderBy('reservation_time', 'asc')
            ->get();
        $restaurantThisWeek = RestaurantBooking::where('reservation_date', '>=', $today)
            ->where('reservation_date', '<=', $endOfWeek)
            ->orderBy('reservation_date', 'asc')
            ->get();

        $roomToday = Booking::where('checkin_date', '>=', $today)
            ->where('checkin_date', '<', $today->copy()->addDay())
            ->where('status', '!=', BookingStatus::DRAFT)
            ->orderBy('checkin_date', 'asc')
            ->get();
        $roomThisWeek = Booking::where('checkin_date', '>=', $today)
            ->where('checkin_date', '<=', $endOfWeek)
            ->where('status', '!=', BookingStatus::DRAFT)
            ->orderBy('checkin_date', 'asc')
            ->get();

        return view('admin.pages.dashboard', compact('restaurantToday', 'restaurantThisWeek', 'roomToday', 'roomThisWeek'));
    }

    public function formSubmissionTestEmail(){
        $user = Auth::user();
        $contactFormSubmissions = new ContactFormSubmissions();
        Mail::to($user->email)->send(new AdminContactFormSubmissionMail($contactFormSubmissions));

        return redirect()->back()->with('success', 'test email sent successfully');
    }

    public function markAllNotificationsAsRead() {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->back()->with('success', 'All notifications marked as read');
    }

    public function markNotificationAsRead($id){
        $notification = Auth::user()->notifications()->find($id);

        if($notification){
            $notification->markAsRead();
        }

        return redirect()->back()->with('success', 'Notification marked as read.');
    }
}

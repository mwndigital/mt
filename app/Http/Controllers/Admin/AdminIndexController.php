<?php

namespace App\Http\Controllers\Admin;

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
            ->where('checkin_date', '<', $today->copy()->addDay(), '>=', $today)
            ->orderBy('arrival_time', 'asc')
            ->get();
        $roomThisWeek = Booking::where('checkin_date', '>=', $today)
            ->where('checkin_date', '<=', $endOfWeek)
            ->orderBy('arrival_time', 'asc')
            ->get();

        return view('admin.pages.dashboard', compact('restaurantToday', 'restaurantThisWeek', 'roomToday', 'roomThisWeek'));
    }

    public function formSubmissionTestEmail(){
        $user = Auth::user();
        $contactFormSubmissions = new ContactFormSubmissions();
        Mail::to($user->email)->send(new AdminContactFormSubmissionMail($contactFormSubmissions));

        return redirect()->back()->with('success', 'test email sent successfully');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

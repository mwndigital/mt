<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNewRoomBookingNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array {
        return [
            'title' => 'A new room booking has been made',
            'message' => $this->booking->first_name . ' ' . $this->booking->last_name . ' has booked a room for ' . $this->booking->checkin_date . ' until ' . $this->booking->checkout_date
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'A new room booking has been made',
            'message' => $this->booking->first_name . ' ' . $this->booking->last_name . ' has booked a room for ' . $this->booking->checkin_date . ' until ' . $this->booking->checkout_date
        ];
    }
}

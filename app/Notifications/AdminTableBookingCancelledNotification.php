<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminTableBookingCancelledNotification extends Notification
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

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'A table booking has been cancelled',
            'message' => 'A booking for ' . $this->booking->first_name . ' ' . $this->booking->last_name . ' has been cancelled on ' . date('d/m/Y', strtotime($this->booking->reservation_date)) . ' at ' . $this->booking->reservation_time
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
            'title' => 'A table booking has been cancelled',
            'message' => 'A booking for ' . $this->booking->first_name . ' ' . $this->booking->last_name . ' has been cancelled on ' . date('d/m/Y', strtotime($this->booking->reservation_date)) . ' at ' . $this->booking->reservation_time
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTableBookingNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($table_booking)
    {
        $this->table_booking = $table_booking;
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

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'A new table booking has been made',
            'message' => $this->table_booking->first_name . ' ' . $this->table_booking->last_name . ' has made a booking for ' . $this->table_booking->joining_for . ' on ' . $this->table_booking->reservation_date . ' at ' . $this->table_booking->reservation_time
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
            'title' => 'A new table booking has been made',
            'message' => $this->table_booking->first_name . ' ' . $this->table_booking->last_name . ' has made a booking for ' . $this->table_booking->joining_for . ' on ' . date('d/m/Y', strtotime($this->table_booking->reservation_date)) . ' at ' . $this->table_booking->reservation_time
        ];
    }
}

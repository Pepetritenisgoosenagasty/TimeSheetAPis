<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Lateness extends Notification
{
    use Queueable;
    
    public $attend;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($attend)
    {
        $this->attend = $attend;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        $staff_id = $this->attend->staff_serial_code;
        $reported_time = $this->attend->reported_time;
        return (new MailMessage)
                    ->greeting('Hello!')
                    ->line('Lateness Notification')
                    ->line('Staff ID:'. ' ' . $staff_id . ' reported on ' . $reported_time);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

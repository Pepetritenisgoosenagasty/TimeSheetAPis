<?php

namespace App\Mail;

use App\Models\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StaffAdded extends Mailable
{
    use Queueable, SerializesModels;
 public $staff;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($staff)
    {
        $this->staff = $staff;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'edward@gmail.com';
        $subject = 'Welcome';
        $name = 'EDX';

        return $this->view('emails.staff_email')
                    ->from($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with(['staff' => $this->staff]);
    }
}

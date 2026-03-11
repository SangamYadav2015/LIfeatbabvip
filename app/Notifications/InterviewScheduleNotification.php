<?php 
// app/Mail/InterviewScheduleNotification.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Support\Str;

class InterviewScheduleNotification extends Notification
{
    use Queueable;

    public $name;
    public $link;

    /**
     * Create a new notification instance.
     *
     * @param  string  $applicant_name
     * @param  string  $link
     * @return void
     */
    public function __construct($name, $link)
    {
        $this->name = $name;
        $this->link = $link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database']; // We are sending a database notification
    }

    /**
     * Build the database notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toDatabase($notifiable)
    {
        // Create a unique notification ID
        $notificationId = Str::uuid();

        // Create the message that will be stored in the database
        $message = "Your status has been updated to 'Interview Schedule'. Please click the link below to select your availability for the interview.";

        return new DatabaseMessage([
            'id' => $notificationId,
            'message' => $message,
            'name' => $this->name,
            'interview_link' => $this->link, // The link to the form
        ]);
    }
}

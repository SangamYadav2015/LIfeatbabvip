<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Mail\CustomResetPasswordEmail;

class ResetPasswordNotification extends Notification
{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $user = $notifiable;
        $name = $user->name;
        $email = $user->email;

        return (new CustomResetPasswordEmail($this->token, $name, $email))
                    ->to($email);
    }
}

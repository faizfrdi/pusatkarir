<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends ResetPassword
{
    public function toMail($notifiable)
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Password - Pusat Karier UIN Jakarta')
            ->view('emails.reset-password', [
                'url' => $resetUrl,
                'name' => $notifiable->name,
                'logo' => public_path('images/logo-karier-navbar.png'),
            ]);
    }
}
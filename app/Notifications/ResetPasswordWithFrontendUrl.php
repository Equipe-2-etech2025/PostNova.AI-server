<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordWithFrontendUrl extends Notification
{
    public string $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Réinitialisation du mot de passe')
            ->line('Vous avez demandé une réinitialisation de mot de passe.')
            ->action('Réinitialiser le mot de passe', $this->url)
            ->line('Si vous n\'avez pas fait cette demande, ignorez cet email.');
    }
}

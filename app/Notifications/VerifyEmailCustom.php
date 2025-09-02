<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class VerifyEmailCustom extends VerifyEmail
{
    /**
     * Get the verification notification mail message for the given URL.
     */
    protected function buildVerificationUrl($notifiable)
    {
        $minutes = (int) config('auth.verification.expire', 60);
        $expiration = Carbon::now()->addMinutes($minutes)->timestamp;

        // Générer l'URL Laravel signée
        $temporarySignedUrl = URL::temporarySignedRoute(
            'verification.verify',
            $expiration,
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        // Extraire la query string (expires et signature)
        $parsedUrl = parse_url($temporarySignedUrl);
        parse_str($parsedUrl['query'], $queryParams);

        // Ajouter id et hash
        $allParams = array_merge($queryParams, [
            'id' => $notifiable->getKey(),
            'hash' => sha1($notifiable->getEmailForVerification()),
        ]);

        return 'http://localhost:5173/email/verify?'.http_build_query($allParams);
    }

    /**
     * Build the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->buildVerificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Vérification de votre adresse e-mail')
            ->line('Cliquez sur le bouton ci-dessous pour vérifier votre adresse e-mail.')
            ->action('Vérifier mon e-mail', $verificationUrl)
            ->line("Si vous n'avez pas créé de compte, aucune action n'est requise.");
    }
}

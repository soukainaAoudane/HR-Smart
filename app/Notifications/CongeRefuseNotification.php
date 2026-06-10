<?php

namespace App\Notifications;

use App\Models\Conge;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CongeRefuseNotification extends Notification
{
    use Queueable;

    public Conge $conge;

    public function __construct(Conge $conge)
    {
        $this->conge = $conge;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre demande de congé a été refusée - HR-Smart')
            ->view('emails.conge-refuse', [
                'conge' => $this->conge
            ]);
    }
}

<?php

namespace App\Notifications;

use App\Models\Conge;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CongeAccepteNotification extends Notification
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
        $duree = $this->conge->date_debut->diffInDays($this->conge->date_fin) + 1;

        return (new MailMessage)
            ->subject('Votre demande de congé a été acceptée - HR-Smart')
            ->view('emails.conge-accepte', [
                'conge'=>$this->conge
            ]);
    }

    private function getTypeLabel(): string
    {
        return match ($this->conge->type) {
            'paye' => 'Congé payé',
            'rtt' => 'RTT',
            'sans_solde' => 'Congé sans solde',
            'formation' => 'Congé formation',
            default => $this->conge->type,
        };
    }
}

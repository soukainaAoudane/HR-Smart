<?php

namespace App\Notifications;

use App\Models\Remplacement;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PropositionRemplacementNotification extends Notification
{
    use Queueable;

    public Remplacement $remplacement;

    public function __construct(Remplacement $remplacement)
    {
        $this->remplacement = $remplacement;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Proposition de remplacement - HR-Smart')
            ->greeting('Bonjour ' . $this->remplacement->remplacant->name . ',')
            ->line('Vous avez été proposé(e) comme **remplaçant(e)** pour :')
            ->line('Employé absent : ' . $this->remplacement->conge->user->name)
            ->line('Période : ' . $this->remplacement->conge->date_debut->format('d/m/Y') . ' → ' . $this->remplacement->conge->date_fin->format('d/m/Y'))
            ->line('Score de compatibilité : ' . $this->remplacement->score_matching . '%')
            ->action('Accepter', url('/employe/remplacement/' . $this->remplacement->id . '/accepter'))
            ->action('Refuser', url('/employe/remplacement/' . $this->remplacement->id . '/refuser'))
            ->line('Que souhaitez-vous faire ?')
            ->salutation('Cordialement, L\'équipe HR-Smart');
    }
}

<?php

namespace App\Service;

use App\Entity\Ticket;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class TicketMailer
{
    // On utilise l'injection de dépendance dans le constructeur.
    // Symfony va voir "MailerInterface" et nous donner le vrai Mailer automatiquement.
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function sendNewTicketEmail(Ticket $ticket): void
    {
        $email = (new Email())
            ->from('noreply@nexus.com') // L'expéditeur (fictif en local)
            ->to('admin@nexus.com')     // Le destinataire
            ->subject('Nouveau Ticket : ' . $ticket->getTitle())
            ->text('Un nouveau ticket a été créé. Description : ' . $ticket->getDescription());

        $this->mailer->send($email);
    }
}
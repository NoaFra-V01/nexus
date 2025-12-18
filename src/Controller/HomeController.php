<?php

namespace App\Controller;

use App\Service\TicketMailer;
use App\Entity\Ticket;
use App\Form\TicketType;
use App\Repository\TicketRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TicketRepository $repository): Response
    {
        $tickets = $repository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'tickets' => $tickets,
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return new Response('Nexus v1.0 - Créé par le meilleur dev');
    }

    #[Route('/ticket/new', name: 'app_ticket_new')]
    #[IsGranted('ROLE_USER')]
    public function create(Request $request, EntityManagerInterface $entityManager, TicketMailer $ticketMailer): Response
    {
        $ticket = new Ticket();
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $ticket->setCreatedAt(new \DateTimeImmutable());
            $ticket->setStatus('OPEN');

            $entityManager->persist($ticket);

            $entityManager->flush();

            $ticketMailer->sendNewTicketEmail($ticket);
            
            $this->addFlash('success', 'Ticket créé et envoyé !');
            return $this->redirectToRoute('app_home');
        }
        
        return $this->render('ticket/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/ticket/{id}/edit', name: 'app_ticket_edit')]
    #[IsGranted('ROLE_USER')]
    public function edit(Ticket $ticket, Request $request, EntityManagerInterface $entityManager): Response
    {
        // On crée le formulaire en le liant au ticket existant
        $form = $this->createForm(TicketType::class, $ticket);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Le ticket est déjà connu de Doctrine, juste besoin de flush
            $entityManager->flush();

            // Message flash (le bandeau vert)
            $this->addFlash('success', 'Le ticket a bien été modifié !');
            
            return $this->redirectToRoute('app_home');
        }

        return $this->render('ticket/new.html.twig', [
            'form' => $form->createView(),
            'is_edit' => true
        ]);
    }
    
}
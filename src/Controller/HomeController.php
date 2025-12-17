<?php

namespace App\Controller;

use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

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
}
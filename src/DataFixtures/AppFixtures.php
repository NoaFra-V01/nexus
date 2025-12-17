<?php

namespace App\DataFixtures;

use App\Entity\Ticket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $ticket = new Ticket();
            $ticket->setTitle("Ticket n°$i");
            $ticket->setDescription("Le ticket $i il faut régler le soucis.");
            $status = (mt_rand(0, 1) === 1) ? 'OPEN' : 'DONE';
            //Sert à créer une variable qui si c'est 1 écrit DONE dans $status et si c'est 0 OPEN
            $ticket->setStatus($status);
            $ticket->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($ticket);
        }

        $manager->flush();
    }
}

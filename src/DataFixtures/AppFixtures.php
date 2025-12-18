<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Ticket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@nexus.com');

        $password = $this->hasher->hashPassword($admin, 'password');
        $admin->setPassword($password);

        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);


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

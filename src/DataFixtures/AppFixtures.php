<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



use App\Entity\Domain;
use App\Entity\User;
use App\Entity\Station;
use App\Entity\Slope;
use App\Entity\Lift;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i <= 5; $i++) {
            $user = new User();
            $user->setEmail('user' . $i . '@example.com');
            $user->setName('User ' . $i);
            $user->setPassword(
                $this->passwordHasher->hashPassword($user, 'password')
            );

            if ($i === 1) {
                $user->setRoles(['ROLE_ADMIN']);
            }

            $manager->persist($user);
        }

        for($i = 0; $i <=2; $i++) {
            $domain = new Domain();
            $domain->setName('Domain ' . $i);
            $domain->setLogo('https://picsum.photos/200/300');
            $manager->persist($domain);
        }

        $manager->flush();

        $domain = $manager->getRepository(Domain::class);
        $domains = $domain->findAll();
        $user = $manager->getRepository(User::class);
        $users = $user->findAll();

        for($i = 0; $i <= 4; $i++) {
            $station = new Station();
            $station->setName('Station ' . $i);
            $station->setLogo('https://picsum.photos/200/300');
            $station->setDomain($domains[rand(0, 2)]);
            $station->setUser($users[rand(0, 5)]);
            $manager->persist($station);
        }

        $manager->flush();

        $station = $manager->getRepository(Station::class);
        $stations = $station->findAll();

        for($i = 0; $i <= 3; $i++) {
            $slope = new Slope();
            $slope->setName('Slope ' . $i);
            $slope->setStation($stations[rand(0, 3)]);
            $slope->setType(['alpin', 'nordic'][rand(0, 1)]);
            $slope->setLevel(['red', 'blue', 'black', 'green'][rand(0, 3)]);
            $slope->setIsOpen([true, false][rand(0, 1)]);
            $slope->setMessage('Message ' . $i);

            $manager->persist($slope);
        }

        $manager->flush();

        for($i = 0; $i <= 3; $i++) {
            $lift = new Lift();
            $lift->setName('Lift ' . $i);
            $lift->setStation($stations[rand(0, 3)]);
            $lift->setType(['gondola', 'chairlift', 'draglift', 't-bar'][rand(0, 3)]);
            $lift->setIsOpen([true, false][rand(0, 1)]);
            $lift->setMessage('Message ' . $i);

            $manager->persist($lift);
        }


        $manager->flush();
    }
}

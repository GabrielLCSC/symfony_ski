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
        // Create users
        $superAdmin = new User();
        $superAdmin->setEmail('admin@example.com');
        $superAdmin->setName('Admin');
        $superAdmin->setPassword(
            $this->passwordHasher->hashPassword($superAdmin, 'password')
        );
        $superAdmin->setRoles(['ROLE_SUPER_ADMIN']);
        $manager->persist($superAdmin);

        $lesSaisiesAdmin = new User();
        $lesSaisiesAdmin->setEmail('les-saisies@example.com');
        $lesSaisiesAdmin->setName('Les Saisies Admin');
        $lesSaisiesAdmin->setPassword(
            $this->passwordHasher->hashPassword($lesSaisiesAdmin, 'password')
        );
        $lesSaisiesAdmin->setRoles(['ROLE_ADMIN']);
        $manager->persist($lesSaisiesAdmin);

        $crestVolandAdmin = new User();
        $crestVolandAdmin->setEmail('crest-voland@example.com');
        $crestVolandAdmin->setName('Crest-Voland Admin');
        $crestVolandAdmin->setPassword(
            $this->passwordHasher->hashPassword($crestVolandAdmin, 'password')
        );
        $crestVolandAdmin->setRoles(['ROLE_ADMIN']);
        $manager->persist($crestVolandAdmin);

        $notreDameDeBellecombeAdmin = new User();
        $notreDameDeBellecombeAdmin->setEmail('notre-dame@example.com');
        $notreDameDeBellecombeAdmin->setName('Notre-Dame Admin');
        $notreDameDeBellecombeAdmin->setPassword(
            $this->passwordHasher->hashPassword($notreDameDeBellecombeAdmin, 'password')
        );
        $notreDameDeBellecombeAdmin->setRoles(['ROLE_ADMIN']);
        $manager->persist($notreDameDeBellecombeAdmin);

        $prazSurArlyAdmin = new User();
        $prazSurArlyAdmin->setEmail('praz-sur-arly@example.com');
        $prazSurArlyAdmin->setName('Praz-sur-Arly Admin');
        $prazSurArlyAdmin->setPassword(
            $this->passwordHasher->hashPassword($prazSurArlyAdmin, 'password')
        );
        $prazSurArlyAdmin->setRoles(['ROLE_ADMIN']);
        $manager->persist($prazSurArlyAdmin);

        $flumetAdmin = new User();
        $flumetAdmin->setEmail('flumet@example.com');
        $flumetAdmin->setName('Flumet Admin');
        $flumetAdmin->setPassword(
            $this->passwordHasher->hashPassword($flumetAdmin, 'password')
        );
        $flumetAdmin->setRoles(['ROLE_ADMIN']);
        $manager->persist($flumetAdmin);


        // Create domains
        $espaceDiamant = new Domain();
        $espaceDiamant->setName('Espace Diamant');
        $espaceDiamant->setLogo('https://picsum.photos/200/300');
        $manager->persist($espaceDiamant);

        // Create stations
        $station1 = new Station();
        $station1->setName('Les Saisies');
        $station1->setLogo('https://example.com/les-saisies-logo.png');
        $station1->setDomain($espaceDiamant);
        $station1->setUser($lesSaisiesAdmin);
        $manager->persist($station1);

        $station2 = new Station();
        $station2->setName('Crest-Voland Cohennoz');
        $station2->setLogo('https://example.com/crest-voland-cohennoz-logo.png');
        $station2->setDomain($espaceDiamant);
        $station2->setUser($crestVolandAdmin);
        $manager->persist($station2);

        $station3 = new Station();
        $station3->setName('Notre-Dame-de-Bellecombe');
        $station3->setLogo('https://example.com/notre-dame-de-bellecombe-logo.png');
        $station3->setDomain($espaceDiamant);
        $station3->setUser($notreDameDeBellecombeAdmin);
        $manager->persist($station3);

        $station4 = new Station();
        $station4->setName('Praz-sur-Arly');
        $station4->setLogo('https://example.com/praz-sur-arly-logo.png');
        $station4->setDomain($espaceDiamant);
        $station4->setUser($prazSurArlyAdmin);
        $manager->persist($station4);

        $station5 = new Station();
        $station5->setName('Flumet');
        $station5->setLogo('https://example.com/flumet-logo.png');
        $station5->setDomain($espaceDiamant);
        $station5->setUser($flumetAdmin);
        $manager->persist($station5);

        $manager->flush();

        $station = $manager->getRepository(Station::class);
        $stations = $station->findAll();

        for($i = 0; $i <= 50; $i++) {
            $slope = new Slope();
            $slope->setName('Piste ' . $i);
            $slope->setStation($stations[rand(0, 4)]);
            $slope->setType(['Alpine', 'Nordique'][rand(0, 1)]);
            $slope->setLevel(['Rouge', 'Blue', 'Noir', 'Verte'][rand(0, 3)]);
            $slope->setIsOpen([true, false][rand(0, 1)]);
            $slope->setMessage('Message ' . $i);
            $slope->setIsSeason([true, false][rand(0, 1)]);
            $slope->setOpening(new \DateTime('08:30:01'));
            $slope->setClosing(new \DateTime('08:30:01'));

            $manager->persist($slope);
        }

        $manager->flush();

        for($i = 0; $i <= 30; $i++) {
            $lift = new Lift();
            $lift->setName('Remontée ' . $i);
            $lift->setStation($stations[rand(0, 4)]);
            $lift->setType(['Télésièges', 'Télécabines', 'Téléski', 'Télécorde'][rand(0, 3)]);
            $lift->setIsOpen([true, false][rand(0, 1)]);
            $lift->setMessage('Message ' . $i);
            $lift->setIsSeason([true, false][rand(0, 1)]);
            $lift->setOpening(new \DateTime('08:30:01'));
            $lift->setClosing(new \DateTime('18:30:01'));

            $manager->persist($lift);
        }

        $manager->flush();
    }
}

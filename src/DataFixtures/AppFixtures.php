<?php

namespace App\DataFixtures;

use App\Entity\Note;
use App\Entity\User;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Création d'un générateur de données Faker en français
        $faker = Factory::create('fr_FR');

        // Création d'un utilisateur de test
        $user = new User();
        $user->setEmail('hello@codeshare.fr')
        ->setUsername('codeshare')
        ->setPassword('$2y$13$4UbZtgjJ2J0JSmY45CZs4uGbUbckq1R.N64JltRbz7JTVpuo3YJzi') // mdp = admin
        ->setRoles(["ROLE_ADMIN"])
        ->setSummary('Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequuntur ut cumque quisquam reprehenderit nam provident velit quibusdam consectetur incidunt quo! Atque enim quod dolorum iste molestiae fugit beatae molestias explicabo.')
        ->setTitle('FULSTACK DEV')
        ->setCity('Paris')
        ->setCountry('France')
        ->setIsVerified(true)
        ;

        // Enregistrement de l'utilisateur en base de données
        $manager->persist($user);

        // Boucle pour créer 200 notes de test
        for ($i=0; $i < 200; $i++) {
            $note = new Note();
            $note->setTitle($faker->word(2))
            ->setContent($faker->text(200))
            ->setUser($user)
            ->setCreatedAt($faker->dateTimeBetween('-7 months'))
            ->setIsPublished(true)
            ;

            $manager->persist($note);
        }

        $manager->flush();
    }
}
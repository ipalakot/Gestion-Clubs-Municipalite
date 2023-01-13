<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;


class AuteursFixtures extends Fixture  implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);


        $faker = \Faker\Factory::create('fr_FR');

        // Creation de mes auteurs
            for ($k=0; $k<5; $k++) {
                $auteur = new Auteur();
                $auteur ->setNoms($faker->lastname)
                        ->setPrenoms($faker->firstname)
                        ->setPrenoms($faker->firstname)
                        ->setAdresse($faker->address)
                        ->setMail($faker->email)
                        ->setPhone($faker->phoneNumber);

                $manager->persist($auteur);
        }

        $manager->flush();
    }

    public static function getGroups(): array
     {
        return ['group2'];
     }
}

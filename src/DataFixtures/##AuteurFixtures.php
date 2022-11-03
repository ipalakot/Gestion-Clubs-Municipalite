<?php

namespace App\DataFixtures;


use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i=0; $i<10; $i++){
            $auteur = new Auteur();
            $auteur ->setNoms($faker->name)
                    ->setPrenoms($faker->lastname)
                    ->setAdresse($faker->address)
                    ->setMail($faker->email)
                    ->setPhone($faker->numberBetween(111111, 999999));

                $manager->persist($auteur);
        }

        $manager->flush();
    }
}

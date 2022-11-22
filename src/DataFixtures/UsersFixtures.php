<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);


        $faker = \Faker\Factory::create('fr_FR');

        for ($i=0; $i<10; $i++){
            $users= new Users();
            $users ->setNoms($faker->name)
                    ->setPrenoms($faker->lastname)
                    ->setPseudo($faker->text)
                    ->setAge($faker->numberBetween(18, 90))
                    ->setAdresse($faker->address)
                    ->setMail($faker->email)
                    ->setPhone($faker->numberBetween(111111, 999999));

                $manager->persist($users);
        }

        $manager->flush();
    }
}

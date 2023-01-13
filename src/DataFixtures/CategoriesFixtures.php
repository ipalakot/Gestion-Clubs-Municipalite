<?php

namespace App\DataFixtures;
use App\Entity\Categorie;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

use Faker; 
use Faker\Factory;

/** 
 * @codeCoverageIgnore
 * 
*/
class CategoriesFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
// $product = new Product();
        // $manager->persist($product);

            $faker = Faker\Factory::create('fr_FR');
            
            for ($i = 0; $i < 20; $i++) 
            {
                $categorie = new Categorie();

                $categorie -> setTitre($faker->sentence($nb = 5, $asText = false))
                ->setResume($faker->text());

                $manager->persist($categorie);
            }
            $manager->flush();
    }
    public static function getGroups(): array
     {
        return ['group1'];
     }
}

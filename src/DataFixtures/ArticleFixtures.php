<?php

namespace App\DataFixtures;

use App\Entity\Article;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void

    {
        // Utiliser la Bibliotheque Fakar
        $faker = \Faker\Factory::create('fr_FR');

        
        // Creation de 10 Article
        for ($i=0; $i<12; $i++){
            $article = new Article();
            $article->setTitre($faker->sentence($nb = 5, $asText = false))
                    ->setAuteur($faker->name)
                    ->setImage($faker->imageUrl(350, 350))
                    ->setResume($faker->text())
                    ->setContenu($faker->realText($maxNbChars = 2000, $indexSize = 2));
            
                $manager->persist($article);
        }

    $manager->flush();
    }
}
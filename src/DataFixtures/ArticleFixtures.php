<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Commentaire;

use PhpParser\Node\Expr\New_;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class ArticleFixtures extends Fixture  implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        // Utiliser la Bibliotheque Fakar
        $faker = \Faker\Factory::create('fr_FR');

        // je mets en place 5 categories
        for ($i=0; $i<4; $i++) {
            $categorie = new Categorie();
            $categorie -> setTitre($faker->sentence($nb = 5, $asText = false))
                       ->setResume($faker->text());
            $manager->persist($categorie);

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

                // Creation de 10 Article
                for ($j=0; $j<3; $j++) {
                    $article = new Article();
                    $article->setTitre($faker->realText($maxNbChars = 60, $indexSize = 2))
                        ->setAuteur($auteur)
                        ->setCreatedAt(new \DateTime())
                        ->setCategorie($categorie)
                        ->setImageName($faker->image(null, 360, 360, 'animals', true, true, 'cats', true, 'jpg'))
                        //->setResume($faker->realText(rand(null, 10, 100)))
                        //->setContenu($faker->realText($maxNbChars = 5000, $indexSize = 2))
                        ;
                       // ->setCommentaire($faker->text());
                    $manager->persist($article);

                    //Creer 5 commentaire pour 1 Article

                    for ($c=1; $c<5; $c++ ){
                        $commentaire = New Commentaire();

                        $days =(new \DateTime());

                        $commentaire->setAuteur($faker->name)
                                    ->setCreatedAt($faker->dateTime())
                                    ->setContenu($faker->sentence)
                                    ->setArticle($article);
                                    
                        $manager-> persist($commentaire);
                                    
                    }
                }
            }
        }
        $manager->flush();
    }

    
    public static function getGroups(): array
     {
        return ['group1'];
     }
}
}
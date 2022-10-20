<?php

namespace App\DataFixtures;

use App\Entity\Article;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void

    {
        for ($i=0; $i<20; $i++){
            $article = new Article();
            $article->setTitre(('Titre de larticle'))
                    ->setAuteur('Auteur Article')
                    ->setImage('image')
                    ->setResume('What is Lorem Ipsum?')
                    ->setContenu('What is Lorem Ipsum?What is Lorem Ipsum?');
            $manager->persist($article);
        }

    $manager->flush();
    }
}
<?php

namespace App\Tests\Entity;


use App\Entity\Article;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Commentaire;

use DateTime;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ArticleUniTest extends KernelTestCase
{
   
    public function testValide(): void
    {
        $auteur = new Auteur();
        $categorie = new Categorie();
        $dateTime = New DateTime();
        
        $article = new Article();
                    
        $article->setTitre('Titlr')
                // ->setImageName('imageName')
                 ->setSlug('slug') 
                 ->setResume('resume')
                 ->setContenu('contenu') 
                 ->setUpdatedAt($dateTime)
                 ->setCategorie($categorie)
                 ->setAuteur($auteur);

        $this->assertTrue($article->getTitre()==='Titlr');
        $this->assertTrue($article->getSlug()==='slug');
      //  $this->assertTrue($articles->getImageName()==='imageName');
        $this->assertTrue($article->getResume()==='resume');
        $this->assertTrue($article->getContenu()==='contenu'); 
        $this->assertTrue($article->getUpdatedAt()===$dateTime);
        $this->assertTrue($article->getCategorie()===$categorie);
        $this->assertTrue($articles>getAuteur()===$auteur);
    }
}

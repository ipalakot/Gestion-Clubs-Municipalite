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
   
    public function testEntityValide(): void
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
                 ->setCreatedAt($dateTime)
                 ->setCategorie($categorie)
                 ->setAuteur($auteur);

        $this->assertTrue($article->getTitre()==='Titlr');
        $this->assertTrue($article->getSlug()==='slug');
        $this->assertTrue($article->getResume()==='resume');
        $this->assertTrue($article->getContenu()==='contenu'); 
        $this->assertTrue($article->getCreatedAt()===$dateTime);
        $this->assertTrue($article->getUpdatedAt()===$dateTime);
        $this->assertTrue($article->getCategorie()===$categorie);
        $this->assertTrue($article->getAuteur()===$auteur);
    }
    public function testEntityFalse(): void
    {
      $auteur = new Auteur();
      $categorie = new Categorie();
      $dateTime = New DateTime();
      
      $article = new Article();
                    
        $article->setTitre('Titlr')
                ->setSlug('slug') 
                ->setResume('resume')
                ->setContenu('contenu') 
                ->setUpdatedAt($dateTime)
                ->setCreatedAt($dateTime)
                ->setCategorie($categorie)
                ->setAuteur($auteur);

        $this->assertFalse($article->getTitre()!=='Titlr');
        $this->assertFalse($article->getSlug()!=='slug');
        $this->assertFalse($article->getResume()!=='resume');
        $this->assertFalse($article->getContenu()!=='contenu');
        $this->assertFalse($article->getCreatedAt()!==$dateTime);
        $this->assertFalse($article->getUpdatedAt()!==$dateTime);
        $this->assertFalse($article->getCategorie()!==$categorie);
        $this->assertFalse($article->getAuteur()!==$auteur);
    }

    public function testVide(): void
    {
        $auteur = new Auteur();
        $categorie = new Categorie();
        $dateTime = new DateTime();
        
        $article = new Article();
                
        $this->assertEmpty($article->getId());
        $this->assertEmpty($article->getTitre());
        $this->assertEmpty($article->getSlug());
        $this->assertEmpty($article->getResume());
        $this->assertEmpty($article->getContenu());
        $this->assertEmpty($article->getUpdatedAt());
        $this->assertEmpty($article->getCategorie());
        $this->assertEmpty($article->getAuteur());
    }

    public function testAddCommentaire(){
        
      $article = new Article();
      $commentaire = new Commentaire();

      $this->assertEmpty($article->getCommentaires());

      $article->addCommentaire($commentaire);
      $this->assertContains($commentaire, $article->getCommentaires());

      $article->RemoveCommentaire($commentaire);
      $this->assertEmpty($article->getCommentaires());

  }
    
}

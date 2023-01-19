<?php

namespace App\Tests\Entity;

use App\Entity\Article;
use App\Entity\Categorie;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Loader\Configurator\validator;

class CategorieUniTest extends KernelTestCase
{
	public function testEntityValid()
    {
        $categorie = new Categorie();
        $categorie -> setTitre('Titre')
                    ->setResume('Resume');
        $this->assertTrue($categorie->getTitre()==='Titre');
        $this->assertTrue($categorie->getResume()==='Resume');
    }

    public function testEntityInvalid()
    {
        $categorie = new Categorie();
        $categorie->setTitre('Titre')
                   ->setResume('Resume');
        $this->assertFalse($categorie->getTitre() !=='Titre');
        $this->assertFalse($categorie->getResume() !=='Resume');
    }

    public function testIsEmpty()
    {
        $categorie = new Categorie();
        
        $this->assertEmpty($categorie->getTitre());
        $this->assertEmpty($categorie->getResume() );
        $this->assertEmpty($categorie->getId());
    }

    public function testAddremoveSetArticles()
    {        
        
        $categorie = new Categorie();
        $article = new Article();

        $this->assertEmpty($categorie->getArticles());

        $categorie->addArticle($article);
        $this->assertContains($article, $categorie->getArticles());

        $categorie->removeArticle($article);
        $this->assertEmpty($categorie->getArticles());
    }
    
}
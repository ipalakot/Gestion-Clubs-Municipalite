<?php

namespace App\Tests\Entity;
use App\Entity\Categorie;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Loader\Configurator\validator;

class CategorieTestPhpTest extends KernelTestCase
{
	public function testIsTrue()
    {
        $categorie = new Categorie();
        
        $categorie->setTitre('Titre')
                   ->setResume('Resume');
    
        $this->assertTrue($categorie->getTitre()==='Titre');
        $this->assertTrue($categorie->getResume()==='Resume');
    }

    public function testIsFalse()
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
        $article = new Articles();

        $this->assertEmpty($categorie->getArticle());

        $categorie->addArticle($article);
        $this->assertContains($article, $categorie->getArticle());

        $categorie->removeArticle($article);
        $this->assertEmpty($categorie->getArticle());
    }
}
}

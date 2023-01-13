<?php

namespace App\Tests\Entity;
use App\Entity\Categorie;
use App\Entity\Article;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Loader\Configurator\validator;

class CategorieTest extends KernelTestCase
{
    public function getCategorie(): Categorie
    {
        return (new Categorie())
                -> setTitre('Titre')
                ->setResume('Resume');
    }
    
    public function testEntityValid()
    {
        $categorie = $this->getCategorie();

        self::bootKernel();
        $errors = self::$container->get('validator')->validate($categorie);
        $this->assertCount(0, $errors);
    }
    
    
    public function testEntityInValid()
    {
        $categorie = $this->getCategorie()-> setTitre(12/12/12);

        self::bootKernel();
        $errors = self::$container->get('validator')->validate($categorie);
        $this->assertCount(1, $errors);
    }



}
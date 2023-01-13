<?php

namespace App\Tests\Entity;
use App\Entity\Categorie;
use App\Entity\Article;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Loader\Configurator\validator;

class CategorieTest extends KernelTestCase
{
    public function testEntityValid()
    {
        $categorie = new Categorie();

        $categorie -> setTitre('Titre')
                    ->setResume('Resume');
        
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($categorie);
        $this->assertCount(0, $errors);
    }
    
    
    public function testEntityInValid()
    {
        $categorie = new Categorie();

        $categorie -> setTitre('12/12/2023')
                    ->setResume('Resume');
        
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($categorie);
        $this->assertCount(1, $errors);
    }



}
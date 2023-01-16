<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoriesFunctionalTest extends WebTestCase
{
    public function testIndexcategories(): void
    {
        $client = static::createClient();
        $client->request('GET', 'categorie/'); //Pas besoin de Scrawler

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
       // $this->assertclsertSelectorTextContains('', '');
    }

    public function testListCategorie(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', 'categorie/'); // utilisation du scrawler
        $this->assertclsertSelectorTextContains('h1', 'Liste des Categories');
    }


    public function testNewcategories(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', 'categorie/new');

        $this->assertResponseIsSuccessful();
       // $this->assertSelectorTextContains('', '');
    }
}
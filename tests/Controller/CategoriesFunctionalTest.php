<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoriesFunctionalTest extends WebTestCase
{
    /**
     * Categorie / List
     *
     * @return void
     */
    public function testIndexcategories(): void
    {
        $client = static::createClient();
        $client->request('GET', 'categorie/'); //Pas besoin de Scrawler

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
       // $this->assertclsertSelectorTextContains('', '');
    }

    /**
     * Categorie / Trie Asc
     *
     * @return void
     */
    public function testTriTitreAsc(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/categorie/triTitreAsc'); // utilisation du scrawler
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        //$this->assertclsertSelectorTextContains('h1', 'Liste des Categories');
    }

    
    /**
     * Categorie / triResumeAsc
     *
     * @return void
     */
    public function testTriResumeAsc(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/categorie/triResumeAsc/');

        $this->assertResponseIsSuccessful();
       // $this->assertSelectorTextContains('', '');
    }
    
    /**
     * Categorie / Nouvel article
     *
     * @return void
     */
    public function testNewcategories(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/categorie/new/');

        $this->assertResponseIsSuccessful();
       // $this->assertSelectorTextContains('', '');
    }
}
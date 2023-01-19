<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeFunctionnalTest extends WebTestCase
{
    public function testPageAccueil(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        //$this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testPageAccueilTitre(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        //$this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h3', 'Projet / Gestion Municipalité');
    }

    public function testHomeAprpos(): void
    {
        $client = static::createClient();
        $client->request('GET', '/apropos');
        $this->assertResponseIsSuccessful();
        //$this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testHomeActivites(): void
    {
        $client = static::createClient();
        $client->request('GET', '/activites');
        $this->assertResponseIsSuccessful();
        //$this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testHomeContact(): void
    {
        $client = static::createClient();
        $client->request('GET', '/contact');
        $this->assertResponseIsSuccessful();
        //$this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testHomeActualites(): void
    {
        $client = static::createClient();
        $client->request('GET', '/actualites');
        $this->assertResponseIsSuccessful();
        //$this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testHomeMunicipalites(): void
    {
        $client = static::createClient();
        $client->request('GET', '/municipalites');
        $this->assertResponseIsSuccessful();
        //$this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    public function testHomeTools(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/tools');
        $this->assertResponseIsSuccessful();
        //$this->assertResponseStatusCodeSame(Response::HTTP_OK);
    }

    

}

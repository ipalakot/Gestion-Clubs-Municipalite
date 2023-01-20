<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthorsFunctionalTest extends WebTestCase
{
    /**
     * Liste des Auteurs,
     * Not Working for Now
     *
     * @return void
     */
    public function testIndexAuteurs(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/auteur/');

        $this->assertResponseIsSuccessful();
     //   $this->assertSelectorTextContains('', '');
    }

    /**
     * Liste des Auteurs / Restreint pour Admin,
     * 
     *
     * @return void
     */
    public function testIndexAuteursAdmin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/auteur/admi');

        $this->assertResponseIsSuccessful();
     //   $this->assertSelectorTextContains('', '');
    }

    /**
     * Auteurs / Nouvel auteur,
     * 
     * @return void
     */
    public function testIndexAuteursNouveau(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/auteur/new');

        $this->assertResponseIsSuccessful();
     //   $this->assertSelectorTextContains('', '');
    }

    /**
     * Auteurs /Affichage,
     * 
     * @return void
     */
    public function testIndexAuteursAffichage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/auteur/1');

        $this->assertResponseIsSuccessful();
     //   $this->assertSelectorTextContains('', '');
    }

        /**
     * Auteurs / Edition,
     * 
     * @return void
     */
    public function testAuteursEdit(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/auteur/1/edit');

        $this->assertResponseIsSuccessful();
     //   $this->assertSelectorTextContains('', '');
    }

            /**
     * Auteurs / Suppression,
     * 
     * @return void
     */
    public function testAuteursSuppression(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/auteur/1');

        $this->assertResponseIsSuccessful();
     //   $this->assertSelectorTextContains('', '');
    }


}

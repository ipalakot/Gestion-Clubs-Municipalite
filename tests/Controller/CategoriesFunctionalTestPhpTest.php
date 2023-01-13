<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoriesFunctionalTest extends WebTestCase
{
    public function testIndexcategories(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', 'categorie/');

        $this->assertResponseIsSuccessful();
       // $this->assertSelectorTextContains('', '');
    }

    public function testNewcategories(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', 'categorie/new');

        $this->assertResponseIsSuccessful();
       // $this->assertSelectorTextContains('', '');
    }
}
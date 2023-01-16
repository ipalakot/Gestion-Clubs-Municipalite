<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoriesFunctionalTest extends WebTestCase
{
    public function testIndexcategories(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', 'categorie/');

        //$this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
       // $this->assertclsertSelectorTextContains('', '');
    }
}
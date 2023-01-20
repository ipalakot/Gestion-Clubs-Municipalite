<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsersFunctionalTest extends WebTestCase
{
    /**
     * Users / Liste
     *
     * @return void
     */
    public function testIndexUsers(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/users/');

        $this->assertResponseIsSuccessful();
      //  $this->assertSelectorTextContains('h1', 'Hello World');
    }

    /**
     * Users / New
     *
     * @return void
     */
    public function testUsersNew(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/users/new');

        $this->assertResponseIsSuccessful();
      //  $this->assertSelectorTextContains('h1', 'Hello World');
    }
}

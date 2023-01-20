<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminFunctionalTest extends WebTestCase
{
    public function testAdminPage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();
    //    $this->assertSelectorTextContains('', '');
    }
}

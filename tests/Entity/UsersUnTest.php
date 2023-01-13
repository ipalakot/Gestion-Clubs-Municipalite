<?php

namespace App\Tests\Entity;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UsersUnTest extends KernelTestCase
{
    public function testIsTrue(): void
    {

        $users = new Users();
        $dateTime = New DateTime();
        
        $users->setNoms('noms')
                    ->setPrenoms('prenoms')
                    ->setPseudo('pseo')
                    ->setAdresse('adresse')
                    //->setPassword('password')
                    ->setMail('ipalakot@mail.com')
                    ->setAge('0');

        $this->assertTrue($users->getNoms()==='nom');
        $this->assertTrue($users->getPrenoms()==='prenoms');
        $this->assertTrue($users->getPseudo())===('pseo');
        $this->assertTrue($users->getAdresse()==='adresse');
        //$this->assertTrue($users->getPassword()==='password');
        $this->assertTrue($users->getMail()==='ipalakot@mail.com');
        $this->assertTrue($users->getAge()==='0');
    }
}

<?php

namespace App\Tests\Entity;


use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UsersUnitTest extends KernelTestCase
{
    public function getEntityUsers(): Users
    {
        return (new Users())
                ->setPseudo('username') 
                ->setNoms('noms')
                ->setPrenoms('prenoms')
                ->setAdresse('rue de la joie')
                ->setPhone('1212121212')
                ->setMail('ipalakot@mail.com')
                ->setAge('90');
    }
    
    public function testIsUsersTrue(): void
    {
        $users = $this->getEntityUsers();        
            
        $this->assertTrue($users->getPseudo()==='username');
        $this->assertTrue($users->getNoms()==='noms');
        $this->assertTrue($users->getPrenoms()==='prenoms');
        $this->assertTrue($users->getMail()==='ipalakot@mail.com');
        $this->assertTrue($users->getAdresse()==='rue de la joie');
        $this->assertTrue($users->getPhone()==='1212121212');
        $this->assertTrue($users->getAge()=== '90');
    }

    public function testIsUsersFalse(): void
    {
        $user = $this->getEntityUsers();        
            
        $this->assertFalse($user->getPseudo()!=='username');
        $this->assertFalse($user->getNoms()!=='noms');
        $this->assertFalse($user->getPrenoms()!=='prenoms');
        $this->assertFalse($user->getMail()!=='ipalakot@mail.com');
        $this->assertFalse($user->getAdresse()!=='rue de la joie');
        $this->assertFalse($user->getPhone()!=='1212121212');
        $this->assertFalse($user->getAge()!== '90');
    }

    public function testIsUsersEmpty(): void
    {
        $user = $this->getEntityUsers();        
            
        $this->assertEmpty($user->getPseudo());
        $this->assertEmpty($user->getNoms());
        $this->assertEmpty($user->getPrenoms());
        $this->assertEmpty($user->getMail());
        $this->assertEmpty($user->getAdresse());
        $this->assertEmpty($user->getAge());
        $this->assertEmpty($user->getId());
    }


}

<?php

namespace App\Tests\Entity;

use App\Entity\User;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserUnitTest extends KernelTestCase
{
    public function testIsUserTrue(): void
    {
        $user = new User();
        
        $user->setLogin('username') 
             ->setNoms('noms')
             ->setPrenoms('prenoms')
             ->setEmail('ipalakot@mail.com')
             ->setPassword('password')
             ->setRoles(['ROLE_ADMIN']);
            
        $this->assertTrue($user->getLogin()==='username');
        $this->assertTrue($user->getNoms()==='noms');
        $this->assertTrue($user->getPrenoms()==='prenoms');
        $this->assertTrue($user->getEmail()==='ipalakot@mail.com');
        $this->assertTrue($user->getPassword()==='password');
        $this->assertTrue($user->getRoles()===['ROLE_ADMIN']);
    }

    

}

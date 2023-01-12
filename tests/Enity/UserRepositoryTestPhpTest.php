<?php

namespace App\Tests\Repository;

use Liip\TestFixturesBundle\Test\FixturesTrait;
use App\DataFixtures\UsersFixtures;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserRepositoryTest extends KernelTestCase
{
   // use FixturesTrait;
    
    public function testCalcul(): void
    {
        # Le besoin ici est de de recuperer mon Repo 
        # Pour cela, je je Lance le kermel afin d'avoir le noyau
        // $kernel = self::bootKernel();
            self::bootKernel();
           // $this->loadFixtures([UserFixtures::class]);

        # Maintenant que j'ai le noyau je peux acceder au Container
         // $kermel->getContainer();
            $user = self::$container->get(UsersRepository::class)->count([]);
            $this ->assertEquals(10, $user);
    }
}
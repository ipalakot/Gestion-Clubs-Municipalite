<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;

class FirstTest extends TestCase
{
    public function myFisrtTest(): void
    {
        // $this->assertTrue(true);
       // $this->assertEquals(4, 2*2); 
        $this->assertEquals('10', 2*5);

    }
}

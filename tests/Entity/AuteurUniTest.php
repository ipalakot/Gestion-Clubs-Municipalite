<?php

namespace App\Tests\Entity;

use App\Entity\Auteur;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AuteurUniTest extends KernelTestCase
{
    public function testAuteurValid(): void
    {
        $auteur = new Auteur();
        $articles = new Article();

        $auteur->setNoms('noms')
                ->setPrenoms('prenoms')
                ->setAdresse('rue de la joie')
                ->setMail('mail.mail.com')
                ->setPhone('1212121212');
                     
        $this->assertTrue($auteur->getNoms()==='noms');
        $this->assertTrue($auteur->getPrenoms()==='prenoms');
        $this->assertTrue($auteur->getAdresse()==='rue de la joie');
        $this->assertTrue($auteur->getMail()==='mail.mail.com');
        $this->assertTrue($auteur->getPhone()==='1212121212');
    }

    public function testAuteurFalse(): void
    {
        $auteur = new Auteur();
        $articles = new Article();

        $auteur->setNoms('noms')
                ->setPrenoms('prenoms')
                ->setAdresse('rue de la joie')
                ->setMail('mail.mail.com')
                ->setPhone('1212121212');
                     
        $this->assertFalse($auteur->getNoms()!=='noms');
        $this->assertFalse($auteur->getPrenoms()!=='prenoms');
        $this->assertFalse($auteur->getAdresse()!=='rue de la joie');
        $this->assertFalse($auteur->getMail()!=='mail.mail.com');
        $this->assertFalse($auteur->getPhone()!=='1212121212');
    }

    public function testAuteurVide(): void
    {
        $auteur = new Auteur();
        $this->assertEmpty($auteur->getNoms());
        $this->assertEmpty($auteur->getPrenoms());
        $this->assertEmpty($auteur->getAdresse());
        $this->assertEmpty($auteur->getMail());
        $this->assertEmpty($auteur->getPhone());
        $this->assertEmpty($auteur->getId());
        
    }

    public function testAddremoveSetArticles()
    {        
        $auteur = new Auteur();
        $article = new Article();

        $this->assertEmpty($auteur-> getArticles());

        $auteur->addArticle($article);
        $this->assertContains($article, $auteur-> getArticles());

        $auteur->removeArticle($article);
        $this->assertEmpty($auteur-> getArticles());
    }

}

<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticlesFunctionalTest extends WebTestCase
{
    public function testArticleIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/');

        $this->assertResponseIsSuccessful();
        
        //$this->assertSelectorTextContains('h3', 'Liste des Articles');
    }

    public function testArticleNew(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/new');

        $this->assertResponseIsSuccessful();
        
        //$this->assertSelectorTextContains('h3', 'Liste des Articles');
    }

    /**
     * Affichage des articles avec le Slug
     *
     * @return void
     */
    public function testAffichageSlug(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/titre/{slug}/');

        $this->assertResponseIsSuccessful();
        
        //$this->assertSelectorTextContains('h3', 'Liste des Articles');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function testAffichageArticles(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/{slug}/');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('', '');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function testAArticlegetArticleTitle(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/gettitle/test');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('', '');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function testAArticlegetAll(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/gettest/all');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('', '');
    }

        /**
     * Undocumented function
     *
     * @return void
     */
    public function testArticlegetAllWithCrit(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/gettest/articritere');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('', '');
    }

    /**
     * Edition d'un Article
     *      
     * @return void
     */
    public function testArticleEdition(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/1/edit');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('', '');
    }

    /**
     * Suppression d'article
     *      
     * @return void
     */
    public function testArticleSupprimer(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/1/');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('', '');
    }

    /**
     * Trouver des categories
     *      
     * @return void
     */
    public function testArticlefindCat(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/list/categ');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('', '');
    }

    /**
     * Trouver des catalogues
     *      
     * @return void
     */
    public function testArticleCatalogue(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/catalogue');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('', '');
    }

    /**
     * Trouver des Abonnements
     *      
     * @return void
     */
    public function testArticleAbonnements(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/abonnements/');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('', '');
    }

    /**
     * Trie des Articles
     *      
     * @return void
     */
    public function testArticleTriCatAsc(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/triCatAsc');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('', '');
    }

        /**
     * Trie des Auteurs
     *      
     * @return void
     */
    public function testArticleTriAuteurs(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/tridateAsc');
        $this->assertResponseIsSuccessful();
        //$this->assertSelectorTextContains('', '');
    }


}

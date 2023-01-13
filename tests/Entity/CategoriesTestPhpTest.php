?php

namespace App\Tests\Entity;

use App\Entity\Article;
use App\Entity\Articles;
use App\Entity\categorie;
use PHPUnit\Framework\TestCase;

class CategoriesTest extends TestCase
{
    public function testIsTrue()
    {
        $categorie = new categorie();
        
        $categorie->setTitre('Titre')
                   ->setResume('Resume');
    
        $this->assertTrue($categorie->getTitre()==='Titre');
        $this->assertTrue($categorie->getResume()==='Resume');
    }

    public function testIsFalse()
    {
        $categorie = new categorie();
        
        $categorie->setTitre('Titre')
                   ->setResume('Resume');
    
        $this->assertFalse($categorie->getTitre() !=='Titre');
        $this->assertFalse($categorie->getResume() !=='Resume');
    }

    public function testIsEmpty()
    {
        $categorie = new categorie();
        
        $this->assertEmpty($categorie->getTitre());
        $this->assertEmpty($categorie->getResume() );
        $this->assertEmpty($categorie->getId());
    }
    
    
    public function testAddremoveSetArticles()
    {        
        
        $categorie = new categorie();
        $article = new Articles();

        $this->assertEmpty($categorie->getArticle());

        $categorie->addArticle($article);
        $this->assertContains($article, $categorie->getArticle());

        $categorie->removeArticle($article);
        $this->assertEmpty($categorie->getArticle());
    }
}
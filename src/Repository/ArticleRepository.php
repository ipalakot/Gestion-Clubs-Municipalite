<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function add(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Articles[] Returns an array of Articles objects
     */
    public function findCategorie()
    {
        return $this->createQueryBuilder('a')
            ->Where('a.categorie = 1')
            ->getQuery()
            ->getResult();
    }

    
    /**
     * @return Articles[] Returns an array of Articles objects
     */
    public function findArtAsc()
    {
        return $this->createQueryBuilder('a')
            ->Where('a.categorie = 1')
            ->getQuery()
            ->getResult();
    }

    

    /**
    * @return Articles[] Returns an array of Users objects
    */
    public function getTriTitreAsc(): array
    {
        $query = $this->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.titre', 'ASC')
            ->getQuery();
        return $query->getResult();
    }


    /**
    * @return Articles[] Returns an array of Users objects
    */
    public function getTriCatAsc(): array
    {
        // $categorie = new Categorie();
        $query = $this->createQueryBuilder('a')
            ->leftJoin('a.categorie' , 'c')
            ->addselect('c')
            ->from('App\Entity\Categorie','cat')
            ->where('c.id = a.categorie')
            ->orderBy('c.titre', 'ASC')
            ->getQuery();
        return $query->getResult();
    }


    /**
    * @return Articles[] Returns an array of Users objects
    */
    public function getTriDateAsc(): array
    {
        $query = $this->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.createdAt', 'ASC')
            ->getQuery();
        return $query->getResult();
    }


    
    /**
    * @return Articles[] Returns an array of Users objects
    */
    public function getTriAutAsc(): array
    {
        // $categorie = new Categorie();
        $query = $this->createQueryBuilder('a')
            ->leftJoin('a.auteur' , 'o')
            ->addselect('o')
            ->from('App\Entity\Auteur','aut')
            ->where('o.id = a.auteur')
            ->orderBy('o.noms', 'ASC')
            ->getQuery();
        return $query->getResult();
    }



//    /**
//     * @return Article[] Returns an array of Article objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
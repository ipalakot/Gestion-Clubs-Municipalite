<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @extends ServiceEntityRepository<Users>
 *
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function add(Users $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Users $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


/**
* @return Users[] Returns an array of Users objects
*/
    public function getUsersBetween($ageMin, $ageMax): array
    {
        $query = $this->createQueryBuilder('u')
         // ->select('u')
            ->where('u.age <= :agemax')
            ->andWhere('u.age >= :agemin')
            ->setParameters(
                array('agemin'=> $ageMin,
                    'agemax'=> $ageMax,
                    )
            )
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery();
        return $query->getResult();
    }

    /**
    * @return Users[] Returns an array of Users objects
    */
    public function getTriAsc(string $champ): array
    {
        $query = $this->createQueryBuilder('u')
            ->select('u')
            ->orderBy('u.' . $champ, 'ASC')
            ->getQuery();
        return $query->getResult();
    }



//    /**
//     * @return Users[] Returns an array of Users objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder()
//            ->fro
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Users
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

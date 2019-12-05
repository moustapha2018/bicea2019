<?php

namespace App\Repository;

use App\Entity\BuArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method BuArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuArticle[]    findAll()
 * @method BuArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuArticle::class);
    }

    // /**
    //  * @return BuArticle[] Returns an array of BuArticle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BuArticle
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @return Query
     */
    public function findAllByNameAscQuery(): Query
    {

        return $this->findByNameAscQuery()
            ->getQuery();


    }

    /**
     * @param $array
     * @return BuArticle[]
     */
    public function findArray($array): array
    {

        return $this->findByNameAscQuery()
            ->andWhere('a.id IN (:array)')
            ->setParameter('array', $array)
            ->getQuery()
            ->getResult();

    }

    /**
     * @return QueryBuilder
     */
    private function findByNameAscQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.articleName', 'ASC');



    }
}

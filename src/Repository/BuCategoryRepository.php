<?php

namespace App\Repository;

use App\Entity\BuCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuCategory[]    findAll()
 * @method BuCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuCategory::class);
    }

    // /**
    //  * @return BuCategory[] Returns an array of BuCategory objects
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
    public function findOneBySomeField($value): ?BuCategory
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

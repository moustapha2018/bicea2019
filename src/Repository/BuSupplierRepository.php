<?php

namespace App\Repository;

use App\Entity\BuSupplier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuSupplier|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuSupplier|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuSupplier[]    findAll()
 * @method BuSupplier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuSupplierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuSupplier::class);
    }

    // /**
    //  * @return BuSupplier[] Returns an array of BuSupplier objects
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
    public function findOneBySomeField($value): ?BuSupplier
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

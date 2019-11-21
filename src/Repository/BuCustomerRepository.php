<?php

namespace App\Repository;

use App\Entity\BuCustomer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BuCustomer|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuCustomer|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuCustomer[]    findAll()
 * @method BuCustomer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuCustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuCustomer::class);
    }

    // /**
    //  * @return BuCustomer[] Returns an array of BuCustomer objects
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
    public function findOneBySomeField($value): ?BuCustomer
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

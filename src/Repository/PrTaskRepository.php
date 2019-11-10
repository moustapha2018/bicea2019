<?php

namespace App\Repository;

use App\Entity\PrTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PrTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrTask[]    findAll()
 * @method PrTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrTask::class);
    }

    // /**
    //  * @return PrTask[] Returns an array of PrTask objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrTask
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

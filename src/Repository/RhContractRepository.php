<?php

namespace App\Repository;

use App\Entity\RhContract;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RhContract|null find($id, $lockMode = null, $lockVersion = null)
 * @method RhContract|null findOneBy(array $criteria, array $orderBy = null)
 * @method RhContract[]    findAll()
 * @method RhContract[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RhContractRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RhContract::class);
    }

    // /**
    //  * @return RhContract[] Returns an array of RhContract objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RhContract
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\RhFunction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RhFunction|null find($id, $lockMode = null, $lockVersion = null)
 * @method RhFunction|null findOneBy(array $criteria, array $orderBy = null)
 * @method RhFunction[]    findAll()
 * @method RhFunction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RhFunctionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RhFunction::class);
    }

    // /**
    //  * @return RhFunction[] Returns an array of RhFunction objects
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
    public function findOneBySomeField($value): ?RhFunction
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

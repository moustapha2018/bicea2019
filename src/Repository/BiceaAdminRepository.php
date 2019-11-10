<?php

namespace App\Repository;

use App\Entity\BiceaAdmin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BiceaAdmin|null find($id, $lockMode = null, $lockVersion = null)
 * @method BiceaAdmin|null findOneBy(array $criteria, array $orderBy = null)
 * @method BiceaAdmin[]    findAll()
 * @method BiceaAdmin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiceaAdminRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BiceaAdmin::class);
    }

    // /**
    //  * @return BiceaAdmin[] Returns an array of BiceaAdmin objects
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
    public function findOneBySomeField($value): ?BiceaAdmin
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

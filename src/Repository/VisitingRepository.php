<?php

namespace App\Repository;

use App\Entity\Visiting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Visiting|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visiting|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visiting[]    findAll()
 * @method Visiting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visiting::class);
    }

    // /**
    //  * @return Visiting[] Returns an array of Visiting objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Visiting
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Civilian;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Civilian|null find($id, $lockMode = null, $lockVersion = null)
 * @method Civilian|null findOneBy(array $criteria, array $orderBy = null)
 * @method Civilian[]    findAll()
 * @method Civilian[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CivilianRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Civilian::class);
    }

    // /**
    //  * @return Civilian[] Returns an array of Civilian objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Civilian
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

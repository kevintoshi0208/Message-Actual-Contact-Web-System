<?php

namespace App\Repository;

use App\Entity\Bussiness;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bussiness|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bussiness|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bussiness[]    findAll()
 * @method Bussiness[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BussinessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bussiness::class);
    }

    // /**
    //  * @return Bussiness[] Returns an array of Bussiness objects
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
    public function findOneBySomeField($value): ?Bussiness
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

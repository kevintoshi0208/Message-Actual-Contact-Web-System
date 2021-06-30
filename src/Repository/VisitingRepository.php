<?php

namespace App\Repository;

use App\Entity\Visiting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
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

    /**
     * @throws Exception
     */
    public function findByInfectedPhone($phone): array
    {
        $sql = "
            select 
                visiting.phone,
                visiting.visit_time,
                LPAD(visiting.business_id, 15, '0') code
            from visiting
            join (
                select
                    business_id,
                    visit_time
                from visiting
                where phone = ?
                and visit_time > DATE_SUB(NOW(),INTERVAL 2 WEEK)
            ) visiting_view on 
                visiting.business_id = visiting_view.business_id
                and visiting.visit_time between 
                    DATE_SUB(visiting_view.visit_time, INTERVAL 4 HOUR) and
                    DATE_ADD(visiting_view.visit_time, INTERVAL 4 HOUR)   
            where visiting.phone <> ? 
        ";

        return $this
            ->getEntityManager()
            ->getConnection()
            ->fetchAllAssociative($sql,[$phone,$phone])
            ;
    }

    /**
     * @throws Exception
     */
    public function findByCodeAndTime($code,$time): array
    {
        $sql = "
            select 
                visiting.phone,
                visiting.visit_time,
                LPAD(visiting.business_id, 15, '0') code
            from visiting
            where visiting.business_id = ? 
            and visiting.visit_time > DATE_SUB(?, INTERVAL 1 WEEK) 
        ";

        return $this
            ->getEntityManager()
            ->getConnection()
            ->fetchAllAssociative($sql,[$code,$time])
            ;
    }
}

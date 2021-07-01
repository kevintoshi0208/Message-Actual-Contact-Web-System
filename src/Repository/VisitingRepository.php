<?php

namespace App\Repository;

use App\Entity\Business;
use App\Entity\Visiting;
use App\Service\CalculateWGSDistanceService;
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


    private CalculateWGSDistanceService $calculator;

    public function __construct(
        ManagerRegistry $registry,
        CalculateWGSDistanceService $calculator
    ) {
        parent::__construct($registry, Visiting::class);
        $this->calculator = $calculator;
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

    public function findByCodeAndTimeEnhance($code,$time)
    {
        /**
         * 在台灣 WGS84 向東溪偏移0.005度分秒 約為51公尺
         * 向南北偏移0.005度分秒 約為56公尺
         * 因此先篩選該場所東西哪北相差0.005的場所
         * 取得這個方球面上場所 縮小目標
         * 在實際的去跟這個場所作距離計算判斷
         */

        /** @var Business $business */
        $infectedBusiness = $this
            ->getEntityManager()
            ->getRepository(Business::class)
            ->findOneBy(['id'=>$code])
        ;

        $north = $infectedBusiness->getWgs84N() +0.005;
        $south = $infectedBusiness->getWgs84N() -0.005;
        $east = $infectedBusiness->getWgs84E() + 0.005;
        $west = $infectedBusiness->getWgs84E() - 0.005;

        $sql = "
            select
                id,
                wgs84_n,
                wgs84_e
            from business
            where wgs84_n between ? and ?
            and wgs84_e between  ? and ?
        ";

        $businesses =  $this
            ->getEntityManager()
            ->getConnection()
            ->fetchAllAssociative($sql,[
                $south,
                $north,
                $west,
                $east,
            ])
        ;

        $set = [];
        $params=[];
        foreach ($businesses as &$business){
            $distance = $this->calculator
                ->calculateWGSDistanceService(
                    $business["wgs84_n"] ,
                    $business["wgs84_e"],
                    $infectedBusiness->getWgs84N(),
                    $infectedBusiness->getWgs84E()
                )
            ;
            if ($distance < 50){
                $set[] = "?";
                $params[] = $business["id"];
            }
        }

        if (count($set)>0){
            $sql = "
                select 
                    visiting.phone,
                    visiting.visit_time,
                    LPAD(visiting.business_id, 15, '0') code
                from visiting
                where visiting.business_id in (".implode(",",$set).") 
                and visiting.visit_time > DATE_SUB(?, INTERVAL 1 WEEK) 
            ";

            $data = $this
                ->getEntityManager()
                ->getConnection()
                ->fetchAllAssociative($sql,[...$params,$time])
            ;

            return $data;

        } else {
            return [];
        }
    }
}

<?php

namespace App\Repository;

use App\Entity\ReportVehicle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReportVehicle|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReportVehicle|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReportVehicle[]    findAll()
 * @method ReportVehicle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportVehicleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReportVehicle::class);
    }

    // /**
    //  * @return ReportVehicle[] Returns an array of ReportVehicle objects
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
    public function findOneBySomeField($value): ?ReportVehicle
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

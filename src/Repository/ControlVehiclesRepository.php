<?php

namespace App\Repository;

use App\Entity\ControlVehicles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ControlVehicles|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControlVehicles|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControlVehicles[]    findAll()
 * @method ControlVehicles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControlVehiclesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ControlVehicles::class);
    }

    // /**
    //  * @return ControlVehicles[] Returns an array of ControlVehicles objects
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
    public function findOneBySomeField($value): ?ControlVehicles
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

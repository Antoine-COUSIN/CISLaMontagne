<?php

namespace App\Repository;

use App\Entity\RoleCenter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RoleCenter|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoleCenter|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoleCenter[]    findAll()
 * @method RoleCenter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoleCenterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoleCenter::class);
    }

    // /**
    //  * @return RoleCenter[] Returns an array of RoleCenter objects
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
    public function findOneBySomeField($value): ?RoleCenter
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

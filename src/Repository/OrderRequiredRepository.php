<?php

namespace App\Repository;

use App\Entity\OrderRequired;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderRequired|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderRequired|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderRequired[]    findAll()
 * @method OrderRequired[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRequiredRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderRequired::class);
    }

    // /**
    //  * @return OrderRequired[] Returns an array of OrderRequired objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OrderRequired
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

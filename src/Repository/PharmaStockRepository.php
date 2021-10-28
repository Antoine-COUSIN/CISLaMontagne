<?php

namespace App\Repository;

use App\Entity\PharmaStock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PharmaStock|null find($id, $lockMode = null, $lockVersion = null)
 * @method PharmaStock|null findOneBy(array $criteria, array $orderBy = null)
 * @method PharmaStock[]    findAll()
 * @method PharmaStock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PharmaStockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PharmaStock::class);
    }

    // /**
    //  * @return PharmaStock[] Returns an array of PharmaStock objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PharmaStock
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

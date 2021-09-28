<?php

namespace App\Repository;

use App\Entity\AmicaleNews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AmicaleNews|null find($id, $lockMode = null, $lockVersion = null)
 * @method AmicaleNews|null findOneBy(array $criteria, array $orderBy = null)
 * @method AmicaleNews[]    findAll()
 * @method AmicaleNews[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AmicaleNewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AmicaleNews::class);
    }

    // /**
    //  * @return AmicaleNews[] Returns an array of AmicaleNews objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AmicaleNews
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

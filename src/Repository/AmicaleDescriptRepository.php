<?php

namespace App\Repository;

use App\Entity\AmicaleDescript;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AmicaleDescript|null find($id, $lockMode = null, $lockVersion = null)
 * @method AmicaleDescript|null findOneBy(array $criteria, array $orderBy = null)
 * @method AmicaleDescript[]    findAll()
 * @method AmicaleDescript[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AmicaleDescriptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AmicaleDescript::class);
    }

    // /**
    //  * @return AmicaleDescript[] Returns an array of AmicaleDescript objects
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
    public function findOneBySomeField($value): ?AmicaleDescript
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

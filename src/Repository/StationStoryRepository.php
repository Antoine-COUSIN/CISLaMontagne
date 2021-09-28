<?php

namespace App\Repository;

use App\Entity\StationStory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StationStory|null find($id, $lockMode = null, $lockVersion = null)
 * @method StationStory|null findOneBy(array $criteria, array $orderBy = null)
 * @method StationStory[]    findAll()
 * @method StationStory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StationStoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StationStory::class);
    }

    // /**
    //  * @return StationStory[] Returns an array of StationStory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StationStory
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

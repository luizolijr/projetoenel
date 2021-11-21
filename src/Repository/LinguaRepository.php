<?php

namespace App\Repository;

use App\Entity\Lingua;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lingua|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lingua|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lingua[]    findAll()
 * @method Lingua[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinguaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lingua::class);
    }

    // /**
    //  * @return Lingua[] Returns an array of Lingua objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lingua
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

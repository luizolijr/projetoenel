<?php

namespace App\Repository;

use App\Entity\CargoDesejado;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CargoDesejado|null find($id, $lockMode = null, $lockVersion = null)
 * @method CargoDesejado|null findOneBy(array $criteria, array $orderBy = null)
 * @method CargoDesejado[]    findAll()
 * @method CargoDesejado[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CargoDesejadoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CargoDesejado::class);
    }

    // /**
    //  * @return CargoDesejado[] Returns an array of CargoDesejado objects
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
    public function findOneBySomeField($value): ?CargoDesejado
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

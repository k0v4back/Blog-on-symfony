<?php

namespace App\Repository;

use App\Entity\DateCreate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DateCreate|null find($id, $lockMode = null, $lockVersion = null)
 * @method DateCreate|null findOneBy(array $criteria, array $orderBy = null)
 * @method DateCreate[]    findAll()
 * @method DateCreate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateCreateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DateCreate::class);
    }

    // /**
    //  * @return DateCreate[] Returns an array of DateCreate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DateCreate
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

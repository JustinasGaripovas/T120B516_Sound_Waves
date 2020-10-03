<?php

namespace App\Repository;

use App\Entity\SoundPackage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SoundPackage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SoundPackage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SoundPackage[]    findAll()
 * @method SoundPackage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoundPackageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SoundPackage::class);
    }

    // /**
    //  * @return SoundPackage[] Returns an array of SoundPackage objects
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
    public function findOneBySomeField($value): ?SoundPackage
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

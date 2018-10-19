<?php

namespace App\Repository;

use App\Entity\Font;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Font|null find($id, $lockMode = null, $lockVersion = null)
 * @method Font|null findOneBy(array $criteria, array $orderBy = null)
 * @method Font[]    findAll()
 * @method Font[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FontRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Font::class);
    }

//    /**
//     * @return Font[] Returns an array of Font objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Font
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

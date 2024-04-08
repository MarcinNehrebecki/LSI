<?php

namespace App\Repository;

use App\Entity\Locals;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Locals>
 *
 * @method Locals|null find($id, $lockMode = null, $lockVersion = null)
 * @method Locals|null findOneBy(array $criteria, array $orderBy = null)
 * @method Locals[]    findAll()
 * @method Locals[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocalsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Locals::class);
    }

    //    /**
    //     * @return Locals[] Returns an array of Locals objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Locals
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

<?php

namespace App\Repository;

use App\Entity\MyLists;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MyLists>
 *
 * @method MyLists|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyLists|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyLists[]    findAll()
 * @method MyLists[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyListsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyLists::class);
    }

    //    /**
    //     * @return MyLists[] Returns an array of MyLists objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MyLists
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

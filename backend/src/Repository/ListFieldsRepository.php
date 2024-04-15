<?php

namespace App\Repository;

use App\Entity\ListFields;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListFields>
 *
 * @method ListFields|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListFields|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListFields[]    findAll()
 * @method ListFields[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListFieldsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListFields::class);
    }

    //    /**
    //     * @return ListFields[] Returns an array of ListFields objects
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

    //    public function findOneBySomeField($value): ?ListFields
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

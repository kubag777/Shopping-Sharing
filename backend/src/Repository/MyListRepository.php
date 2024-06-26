<?php

namespace App\Repository;

use App\Entity\MyList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @extends ServiceEntityRepository<MyList>
 *
 * @method MyList|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyList|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyList[]    findAll()
 * @method MyList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyList::class);
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

  
    public function findByUserId($userId)
    {
        $queryBuilder = $this->createQueryBuilder('ml');
    
        $queryBuilder->join('ml.UserID', 'u')
                     ->where('u.id = :userId')
                     ->setParameter('userId', $userId)
                     ->setFirstResult(0)
                     ->setMaxResults(100);
    
        $query = $queryBuilder->getQuery();

        return new Paginator($query);
    }
    
}

<?php

namespace App\Repository;

use App\Entity\Groupes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Groupes>
 *
 * @method Groupes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Groupes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Groupes[]    findAll()
 * @method Groupes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupes::class);
    }


    public function findByUser($idUser): array
    {
        $id = htmlspecialchars($idUser);

        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT groupes.name FROM users_groupes INNER JOIN groupes WHERE users_id = :id AND groupes_id = groupes.id';

        $resultSet = $conn->executeQuery($sql, ['id' => $id]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
    //    /**
    //     * @return Groupes[] Returns an array of Groupes objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Groupes
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

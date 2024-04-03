<?php

namespace App\Repository;

use App\Entity\Cities;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cities>
 *
 * @method Cities|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cities|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cities[]   //findAll()
 * @method Cities[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CitiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cities::class);
    }

    public function findAll(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * FROM cities';

        $resultSet = $conn->executeQuery($sql);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
    public function findById($id): array
    {
        $idParam = htmlspecialchars($id);

        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * FROM cities WHERE id = :id';

        $resultSet = $conn->executeQuery($sql, ['id' => $idParam]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
}

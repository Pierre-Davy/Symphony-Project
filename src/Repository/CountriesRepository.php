<?php

namespace App\Repository;

use App\Entity\Countries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Countries>
 *
 * @method Countries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Countries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Countries[]    findAll()
 * @method Countries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Countries::class);
    }

    public function findById($id): array
    {
        $idParam = htmlspecialchars($id);

        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * FROM countries WHERE id = :id';

        $resultSet = $conn->executeQuery($sql, ['id' => $idParam]);

        // returns an array of arrays (i.e. a raw data set)
        return $resultSet->fetchAllAssociative();
    }
}

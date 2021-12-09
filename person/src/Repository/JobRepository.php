<?php

namespace App\Repository;

use App\Entity\Job;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Job|null find($id, $lockMode = null, $lockVersion = null)
 * @method Job|null findOneBy(array $criteria, array $orderBy = null)
 * @method Job[]    findAll()
 * @method Job[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Job::class);
    }

    /**
     * @return job[]
     */
    // public function searchJob ($min, $max) {
    //     $connection = $this->getEntityManager()->getConnection();
    //     $query = "
    //             SELECT * FROM Job j
    //             WHERE j.Salary >= :min AND j.Salary <= :max
    //             ORDER BY j.Salary DESC
    //     ";
    //     $statement = $connection->prepare($query);
    //     $statement->execute(['min' => $min, 'max' => $max]);

    //     return $statement->fetchAll();
    // }
}

<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    /**
     * @return Car[]
     */
    public function sortPriceAsc() {
        return $this->getEntityManager()
                    ->createQuery(
                        "
                            SELECT c
                            FROM App\Entity\Car c
                            ORDER BY c.CarPrice ASC
                        ")
                    ->getResult();
    }

    /**
     * @return Car[]
     */
    public function sortModelAsc() {
        return $this->createQueryBuilder('car')
                    ->orderBy('car.CarModel','asc')
                    ->getQuery()
                    ->getResult();
    }

     /**
     * @return Car[]
     */
    public function sortModelDesc() {
        return $this->createQueryBuilder('car')
                    ->orderBy('car.CarModel','desc')
                    ->getQuery()
                    ->getResult();
    }

    /**
     * @return Car[]
     */
    public function searchByName ($name) {
        return $this->createQueryBuilder('c')
                    ->andWhere('c.CarName LIKE :name')
                    ->setParameter('name', '%' . $name . '%')
                    ->orderBy('c.CarPrice','asc')
                    ->setMaxResults(3)
                    ->getQuery()
                    ->getResult()
                    ;
    }
}

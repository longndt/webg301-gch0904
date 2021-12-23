<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }
    
    /**
     * @return Book[]
     */
    public function sortBookIdAsc() {
        return $this->createQueryBuilder('book')
                    ->orderBy('book.id', 'ASC')
                    ->getQuery()
                    ->getResult()
        ;
    }

     /**
     * @return Book[]
     */
    public function sortBookIdDesc() {
        return $this->createQueryBuilder('book')
                    ->orderBy('book.id', 'DESC')
                    ->getQuery()
                    ->getResult()
        ;
    }

    /**
     * @return Book[]
     */
    public function searchByTitle ($title) {
        return $this->createQueryBuilder('book')
                    ->andWhere('book.title LIKE :title')
                    ->setParameter('title', '%' . $title . '%')
                    ->orderBy('book.title','asc')
                    ->setMaxResults(5)
                    ->getQuery()
                    ->getResult()
                    ;
    }
}

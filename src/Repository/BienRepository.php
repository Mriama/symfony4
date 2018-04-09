<?php

namespace App\Repository;

use App\Entity\Bien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bien::class);
    }

//    /**
//     * @return Bien[] Returns an array of Bien objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bien
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


    public function findByValues($localite, $typebien, $prix){
        $query = $this->createQueryBuilder('b')
    ->join('b.localite', 'l')
    ->join('b.typebien', 't')
    ->addSelect('l')
    ->addSelect('t')    
    ->andWHERE('l.id = :localite OR t.id = :typebien OR b.prix BETWEEN :prixMin and :prixMax')
    ->setParameters(array('localite' => $localite, 'typebien' => $typebien,'prixMin'=>$prix-10000,'prixMax'=>$prix+10000));

    return $query->getQuery()->getResult();
}
}

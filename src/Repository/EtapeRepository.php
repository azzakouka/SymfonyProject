<?php

namespace App\Repository;

use App\Entity\Etape;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etape|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etape|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etape[]    findAll()
 * @method Etape[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtapeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etape::class);
    }

    // /**
    //  * @return Etape[] Returns an array of Etape objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etape
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /*
 * @return Etape[]
      */
    public function findOrdre():array {
        return $this->createQueryBuilder('c')
            ->where('c.ordre_etape=1')
            ->groupBy(c.ville_etape)
            ->getQuery()
            ->getResult();
    }

    public function findCircuit():array {
        return $this->createQueryBuilder('c')
            ->where('c.ordre_etape=11')
            ->orderBy('c.ordre_etape', 'DESC')
            ->getQuery()
            ->getResult();
    }
    public function modify(){
        $entityManager = $this->getEntityManager();
        $product = $entityManager->getRepository(Etape::class)->findOneBy(array('ville_etape'=>'1'));
        $product->setDureeEtape(3);
        $entityManager->flush();
    }

}

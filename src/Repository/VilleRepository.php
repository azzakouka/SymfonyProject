<?php

namespace App\Repository;

use App\Entity\Ville;
use App\Entity\Etape;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ville|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ville|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ville[]    findAll()
 * @method Ville[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VilleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ville::class);
    }

     /**
      * @return Ville[] Returns an array of Ville objects
      */

    public function find_ville_etape()
    {
        $res=$this->getEntityManager();
        $query=$res->createQuery('SELECT DISTINCT v,e FROM App\Entity\Ville v LEFT JOIN v.etapes e');
        return $query->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Ville
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function RemoveVille(){
        $entityManager = $this->getEntityManager();
        $re=$this->find_ville_etape();
        foreach($re as $valeur)
        {
            if($valeur->getEtapes()->count()==0)
                $entityManager->remove($valeur);
            $entityManager->flush();
        }
}


}

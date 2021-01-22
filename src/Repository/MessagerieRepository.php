<?php

namespace App\Repository;

use App\Entity\Messagerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Messagerie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Messagerie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Messagerie[]    findAll()
 * @method Messagerie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Messagerie::class);
    }

     /**
      * @return Messagerie[] Returns an array of Messagerie objects
      */
    public function getMessagesRecus($email)
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.users', 'u')
            ->addSelect('u')
            ->where('u.email != :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getResult();
    }
     /**
      * @return Messagerie[] Returns an array of Messagerie objects
      */
    public function getMessagesEnvoyes($email)
    {
        return $this->createQueryBuilder('m')
            ->leftJoin('m.users', 'u')
            ->addSelect('u')
            ->where('u.email != :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Messagerie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

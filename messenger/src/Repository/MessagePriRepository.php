<?php

namespace App\Repository;

use App\Entity\MessagePri;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MessagePri|null find($id, $lockMode = null, $lockVersion = null)
 * @method MessagePri|null findOneBy(array $criteria, array $orderBy = null)
 * @method MessagePri[]    findAll()
 * @method MessagePri[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagePriRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MessagePri::class);
    }

    // public function findByMessage(int $id, int $idr) {
    //     $query = $this->createQueryBuider('m')
    //     // ->leftJoin('user.id_user', 'id_user')
    //     ->select('m.message')
    //     ->from('m.message_pri')
    //     ->leftJoin('user.id_user', 'id_user')
    //     ->where('m.id_user = :id_user')
    //     ->setParameter(':id_user', $id)
    //     ->andWhere('m.id_user_recevoir = :id_user_recevoir')
    //     ->setParameter(':id_user_recevoir', $idr)
    //     ->getQuery()
    //     ;

    //     try {
    //         return $query->getOneOrNullResult();
    //     }
    //     catch (\Exception $e) {
    //         throw new \Exception('Problème' . $e->getMessage() . $e->getLine());
    //     }
    // }

    // /**
    //  * @return MessagePri[] Returns an array of MessagePri objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

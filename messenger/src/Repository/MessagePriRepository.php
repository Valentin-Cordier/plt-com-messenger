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
    
    public function findByUsers($receiver, $sender)
    {
        $query = $this->getEntityManager()->createQuery('
                SELECT m FROM App\Entity\MessagePri m
                WHERE
                m.idUserRecevoir = :receiver AND m.idUser = :sender
                OR m.idUserRecevoir = :sender AND m.idUser = :receiver
            ')
            ->setParameters([
                'receiver' => $receiver,
                'sender'   => $sender
            ]);
        ;
        return $query->getResult();
    }
    // SELECT * FROM `message_pri` WHERE `id_user_recevoir`=5 AND `id_user` = 2 OR id_user_recevoir=2 AND id_user = 5

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('m')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\MessagePri;
use App\Repository\UserRepository;
use App\Repository\MessagePriRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PltComMessengerController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function base()
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'PltComMessengerController',
        ]);
    }

    /**
     * @Route("/index", name="accueil")
     */
    public function index(MessagePriRepository $repo, UserRepository $repo2)
    {
        $users = $this->getUser();

        $message = $repo->findByIdUserRecevoir(array(['id' => 'ASC', 5]));
        $user = $repo2->findByIdUser($users);

        return $this->render('plt_com_messenger/index.html.twig', [
            'message' => $message,
            'user' => $user,
        ]);
        
        }
    
    /**
     * @Route("/profil", name="profil")
     */
    public function profil()
    {
        return $this->render('plt_com_messenger/profil.html.twig');
    }


    /**
     * @Route("/musique", name="musique")
     */
    public function musique()
    {
        return $this->render('plt_com_messenger/musique.html.twig');
    }


    /**
     * @Route("/groupe", name="groupe")
     */
    public function groupe()
    {
        return $this->render('plt_com_messenger/groupe.html.twig');
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConversationController extends AbstractController
{
    /**
     * @Route("/conversation", name="conversation")
     */
    public function index(UserRepository $repo)
    {
        $repo = $this->getDoctrine()->getRepository(User::class);

        $username = $repo->findAll();

        return $this->render('conversation/index_conv.html.twig', [
            'users' => $username
        ]);
    }

    /**
     * Permet l'affiche de la conversation avec l'utiilisateur
     * 
     * @Route("/conversation_show/{id}", name="conversation_show")
     * 
     * @return Response
     */
    public function show(UserRepository $repo)
    {
        $repo = $this->getDoctrine()->getRepository(User::class);

        $username = $repo->findAll();

        return $this->render('conversation/conversation_show.html.twig', [
            'users' => $username
        ]);

    }
}

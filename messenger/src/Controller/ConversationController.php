<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\MessagePri;
use App\Form\MessagePriType;
use App\Repository\MessagePriRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
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
        $username = $repo->findAll();
         
        

        return $this->render('conversation/conversation.html.twig', [
            'users' => $username
        ]);  
    }

    /**
     * Permet l'affiche de la conversation avec l'utiilisateur
     * 
     * @Route("/conversation/{id}", name="conversation_show")
     * 
     * @return Response
     */
    public function show(Request $request, UserRepository $repo, MessagePriRepository $repo2, int $id): Response
    {

        $username = $this->getUser();
        
        $user = $repo->find($id);
        
        $message = new MessagePri();

          $form = $this->createForm(MessagePriType::class, $message);

        $form->handleRequest($request);

        if($form->isSubmitted()  && $form->isValid()) {

            $message->setIdUserRecevoir($user);
            $message->setIdUser($this->getUser());


            //Verifie ce qu'il envoi avec un dump
            dump($message);

           $em = $this->getDoctrine()->getManager();

           $em->persist($message);

           $em->flush();

        }
        $messages = $repo2->findByIdUser(array($id));
        $messages2 = $repo2->findByIdUserRecevoir(array($id));

        return $this->render('conversation/conversation_show.html.twig', [
            'controller_name' => 'Administrateur',
            'form' => $form->createView(),
            'users' => $user,   
            'messages' => $messages2,   
            'messages2' => $messages,
        ]);
        // }
        



        // Création du message envoyé dans la table 'message_pri'
        

        
      

    }
}
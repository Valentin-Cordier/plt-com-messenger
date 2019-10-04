<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\MessagePri;
use App\Form\MessPriType;
use App\Repository\MessagePriRepository;
use App\Repository\UserRepository;
use App\Repository\AmisRepository;
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
    public function index(UserRepository $repo2, AmisRepository $repo)
    {
        $user = $this->getUser();
        
        
       $amis = $repo->findBy(["idUser" => $user],[]);

        // $amis = $repo->findByIdUser(array('id' => $user));
        
        // $users = $repo2->findByIdUser(array('id' => $amis));  
        return $this->render('conversation/conversation.html.twig', [
            'amis' => $amis,
            // 'users' => $users,
        ]);  
    }

    /**
     * Permet l'affiche de la conversation avec l'utiilisateur
     * 
     * @Route("/conversation/{id}", name="conversation_show")
     * 
     * @return Response
     */
    public function show(Request $request, UserRepository $repo, MessagePriRepository $repo2, AmisRepository $repo3, $id): Response
    {

        $username = $this->getUser();
   
        
        $user = $repo->find($id);
        // Création du message envoyé dans la table 'message_pri'
        // Mais avant on génére la conversation via le formulaire 
        //(enfin une partie car le rest ce fais dans le template)
        $message = new MessagePri();
        

        $form = $this->createForm(MessPriType::class, $message);

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



        //Récupération des messages depuis le repository lier à l'entity MessagePri

        if($user != $username) {
                
        $messages = $repo2->findByUsers($username,$user);
        // $messages2 = $repo2->findByIdUserRecevoir($id);
        $amis = $repo3->findByIdUser($id);

        } else{
            return $this->redirectToRoute('conversation');
        }
        
        

        return $this->render('conversation/conv_show.html.twig', [
            'controller_name' => 'Administrateur',
            'form' => $form->createView(),
            'users' => $user,
            'amis' => $amis,      
            'messages' =>  $messages,
            // 'messages2' =>  $messages2,   
        ]);
        
        



        // Création du message envoyé dans la table 'message_pri'
        

        
      

    }
}
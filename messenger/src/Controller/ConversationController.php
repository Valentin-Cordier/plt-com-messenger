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
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $repo = $this->getDoctrine()->getRepository(User::class);
        $username->setIdUser($this->getUser());
        $username = $repo->findAll();


        return $this->render('conversation/conversation.html.twig', [
            'users' => $username
        ]);  
            
    }

    //      /**
    //   * Permet l'affiche de la conversation avec l'utilisateur après un envoye de message
    //   * 
    //   * @Route("/conversation_show/{id}", name="envoi_message")
    //   * 
    //   */
    //   public function envoi_message(Request $request,ObjectManager $manager)
    //   {
    //      $message = new MessagePri();
 
    //      $form = $this->createForm(MessagePriType::class, $message);
 
    //      $form->handleRequest($request);
 
    //      if($form->isSubmitted()) {
 
    //         $em = $this->getDoctrine()->getManager();
            
    //         $em->persist($message);
 
    //         $em->flush();
 
    //         return new Response('Message envoyé !');
    //      }
 
    //      return $this->render('conversation_show.html.twig', [
    //          'form' => $form->createView(),
    //          'message' => $message
    //      ]);
         
    //   }

    /**
     * Permet l'affiche de la conversation avec l'utiilisateur
     * 
     * @Route("/conversation/{id}", name="conversation_show")
     * 
     * @return Response
     */
    public function show(Request $request, ObjectManager $manager, UserRepository $repo, MessagePriRepository $repo2, $id)
    {
        
        $message = new MessagePri();

        
        $form = $this->createForm(MessagePriType::class, $message);

        $form->handleRequest($request);

        if($form->isSubmitted()) {

           $em = $this->getDoctrine()->getManager();

           $message->setIdUserRecevoir($this->getUser());
           $message->setIdUser($this->getUser());

           $em->persist($message);

           $em->flush();

           return new Response('Message envoyé !');

           return $this->redirectToRoute('conversation_show', ['id' => $message->getIdUser()]);
        }




        $repo = $this->getDoctrine()->getEntityManager()->getRepository(User::class);

        $username = $repo->findAll();



        



        $repo2 = $this->getDoctrine()->getRepository(MessagePri::class);

        
         $mess = $repo2->findAll();



        

        return $this->render('conversation/conversation_show.html.twig', [
            'form' => $form->createView(),
            'users' => $username,   
            'message' => $mess, 
        ]);

    }
}
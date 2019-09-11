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
        $repo = $this->getDoctrine()->getRepository(User::class);
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
    public function show(Request $request, ObjectManager $manager, UserRepository $repo, MessagePriRepository $repo2, int $id): Response
    {


        $username = $this->getUser();
        $user = $repo->find($id);
        $mess = $repo2->findByIdUserRecevoir($id);
        

        // if(!$article){
        //     // Si aucun article n'est trouvé, nous créons une exception
        //     throw $this->createNotFoundException('L\'article n\'existe pas');
        // }


        // Création du message envoyé dans la table 'message_pri'
        $message = new MessagePri();

        
        $form = $this->createForm(MessagePriType::class, $message);

        $form->handleRequest($request);


        if($form->isSubmitted()  && $form->isValid()) {

            $message->setIdUserRecevoir($user);
            $message->setIdUser($this->getUser());

            dump($message);

           $em = $this->getDoctrine()->getManager();

           $em->persist($message);

           $em->flush();

        //    return new Response('Message envoyé !');
        }


        return $this->render('conversation/conversation_show.html.twig', [
            'controller_name' => 'Administrateur',
            'form' => $form->createView(),
            'users' => $user,   
            'message' => $mess,

        ]);

    }
}
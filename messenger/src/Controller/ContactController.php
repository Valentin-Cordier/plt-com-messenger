<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Amis;
use App\Repository\UserRepository;
use App\Repository\AmisRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, UserRepository $repo): Response
    {
        $users = $this->getUser();           

        $username = $repo->findAll();
        $user = $repo->find($users);

        // $amis = new Amis();


        // $form = $this->createForm(MessagePri1Type::class, $messagePri);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        // $entityManager = $this->getDoctrine()->getManager();
        // $entityManager->persist($amis);
        // $entityManager->flush();

        // return $this->redirectToRoute('contact');
        // }


        return $this->render('contact/contact.html.twig', [
            'username' => $username,
            'user' => $user,
        ]);
    }



}
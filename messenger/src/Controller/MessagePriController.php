<?php

namespace App\Controller;

use App\Entity\MessagePri;
use App\Entity\User;
use App\Form\MessagePri1Type;
use App\Repository\MessagePriRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/gestion")
 */
class MessagePriController extends AbstractController
{
    /**
     * @Route("/", name="gestion", methods={"GET"})
     */
    public function gestion(): Response
    {
        return $this->render('gestion_compte/gestion.html.twig');

    }

    /**
     * @Route("/entity_message_pri", name="entity_message_pri")
     * 
     */
    public function gestionUser(MessagePriRepository $MessagePriRepository): Response
    {
        return $this->render('gestion_compte/gestion_message_pri/entity_messagePri.html.twig', [
            'message_pris' => $MessagePriRepository->findAll(),
        ]);
    }

    // /**
    //  * @Route("/new", name="message_pri_new", methods={"GET","POST"})
    //  */
    // public function new(Request $request): Response
    // {
    //     $messagePri = new MessagePri();
    //     $form = $this->createForm(MessagePri1Type::class, $messagePri);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($messagePri);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('message_pri_index');
    //     }

    //     return $this->render('message_pri/new.html.twig', [
    //         'message_pri' => $messagePri,
    //         'form' => $form->createView(),
    //     ]);
    // }

    // /**
    //  * @Route("/{idMessage}", name="message_pri_show", methods={"GET"})
    //  */
    // public function show(MessagePri $messagePri): Response
    // {
    //     return $this->render('message_pri/show.html.twig', [
    //         'message_pri' => $messagePri,
    //     ]);
    // }

    /**
     * @Route("/entity_message_pri/{idMessage}/edit", name="message_pri_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MessagePri $messagePri): Response
    {
        $form = $this->createForm(MessagePri1Type::class, $messagePri);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entity_message_pri');
        }

        return $this->render('gestion_compte/gestion_message_pri/edit.html.twig', [
            'message_pri' => $messagePri,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/entity_message_pri/{idMessage}", name="message_pri_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MessagePri $messagePri): Response
    {
        if ($this->isCsrfTokenValid('delete'.$messagePri->getIdMessage(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($messagePri);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entity_message_pri');
    }
}

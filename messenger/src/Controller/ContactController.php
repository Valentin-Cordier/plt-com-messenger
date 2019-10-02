<?php

namespace App\Controller;

use App\Entity\Amis;
use App\Entity\User;
use App\Form\AmisType;
use App\Repository\AmisRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * 
     *  @return int id
     *  @return Response
     */
    public function contact(Request $request, UserRepository $repo2, AmisRepository $repo)
    {
        $users = $this->getUser();
        

        


                   

        $username = $repo2->findAll();
        $user = $repo2->find($users);

        $amis = $repo->findByIdUser(array('id', $users));


        return $this->render('contact/contact.html.twig', [
            'username' => $username,
            'user' => $user,
            'amis' => $amis,
        ]);
    }



    /**
     * @Route("/contact/{id}", name="add_contact")
     * 
     *
     *
     * @return Response
     */
    public function AddAmis(Request $request, userRepository $repo, $id): Response
    {

        $users = $this->getUser();

        $amis = new Amis();

        $username = $repo->find($id);

        

        $form = $this->createForm(AmisType::class, $amis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             
            $amis->setIdUserAmis($username);
            $amis->setIdUser($users);

        dump($amis);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($amis);
        $entityManager->flush();

        return $this->redirectToRoute('contact');

        }

        return $this->render('contact/add_contact.html.twig', [
            'username' => $username,
            
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contact/{idAmis}/amis_edit", name="amis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Amis $ami): Response
    {
        $form = $this->createForm(AmisType::class, $ami);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/amis_edit.html.twig', [
            'ami' => $ami,
            'form' => $form->createView(),
        ]);
    }




     /**
     * @Route("/contact/delete/{idAmis}", name="amis_delete")
     */
    public function delete(Request $request, Amis $ami): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ami->getIdAmis(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ami);
            $entityManager->flush();
        }
        return $this->redirectToRoute('contact');
    }



}
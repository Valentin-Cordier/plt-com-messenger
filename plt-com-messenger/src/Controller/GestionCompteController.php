<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class GestionCompteController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription( Request $request, ObjectManager $manager,UserPasswordEncoderInterface $encoder){
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);


            $manager->persist($user);
            $manager->flush();

            $this->addFlash('success', 'Tu es bien enregistré !');

            return $this->redirectToRoute('connexion');

        }

        


        return $this->render('gestion_compte/inscription.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion()
    {
        return $this->render('gestion_compte/connexion.html.twig',[
            'controller_name' => 'PltComMessengerController',
        ]);
    }

            /**
       * @Route("/deconnexion", name="deconnexion")
       */
      public function logout() 
      {
        return $this->redirectToRoute('base');
      }

    /**
     * @Route("/gestion", name="gestion")
     */
    public function gestion()
    {
        return $this->render('gestion_compte/gestion.html.twig');
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Security\LoginAuthenticator;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

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
        return $this->render('gestion_compte/connexion.html.twig');
        return $this->redirectToRoute('accueil');
        
    }



    /**
     * @Route("/gestion", name="gestion")
     */
    public function gestion()
    {
        return $this->render('gestion_compte/gestion.html.twig');
    }

    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
        
    }
}

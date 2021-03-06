<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\RegistrationType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\LoginAuthenticator;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

/**
 * @Route("/gestion")
 */
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
    public function connexion(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('gestion_compte/connexion.html.twig', [
            'error' => $error,
        ]);
        return $this->redirectToRoute('accueil');
        
    }



    /**
     * @Route("/", name="gestion")
     */
    public function gestion()
    {
        return $this->render('gestion_compte/gestion.html.twig');

    }

    /**
     * @Route("/panel_admin", name="panel_admin")
     */
    public function gestionPA()
    {
        return $this->render('gestion_compte/panel_admin.html.twig');
    }

    /**
     * @Route("/entity_user", name="entity_user")
     * 
     */
    public function gestionUser(UserRepository $userRepository): Response
    {
        return $this->render('gestion_compte/entity_user.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/entity_user/{idUser}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function editUser(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('entity_user');
        }

        return $this->render('gestion_compte/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idUser}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getIdUser(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entity_user');
    }


    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
        
    }
}

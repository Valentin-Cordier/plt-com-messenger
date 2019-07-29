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
    public function inscription(){
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
    
        return $this->render('gestion_compte/inscription.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion()
    {
        return $this->render('gestion_compte/connexion.html.twig');
    }

    /**
     * @Route("/gestion", name="gestion")
     */
    public function gestion()
    {
        return $this->render('gestion_compte/gestion.html.twig');
    }
}

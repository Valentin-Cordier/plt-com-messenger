<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PltComMessengerController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function base()
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'PltComMessengerController',
        ]);
    }

    /**
     * @Route("/inde", name="inde")
     */
    public function index()
    {
        return $this->render('plt_com_messenger/index.html.twig', [
            
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('plt_com_messenger/contact.html.twig');
    }

    /**
     * @Route("/musique", name="musique")
     */
    public function musique()
    {
        return $this->render('plt_com_messenger/musique.html.twig');
    }
    /**
     * @Route("/groupe", name="groupe")
     */
    public function groupe()
    {
        return $this->render('plt_com_messenger/groupe.html.twig');
    }
}

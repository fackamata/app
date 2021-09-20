<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfoController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('info/contact.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    #[Route('/apropos', name: 'apropos')]
    public function apropos(): Response
    {
        return $this->render('info/apropos.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    #[Route('/histoire', name: 'histoire')]
    public function histoire(): Response
    {
        return $this->render('info/histoire.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    #[Route('/aide', name: 'aide')]
    public function aide(): Response
    {
        return $this->render('info/aide.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    #[Route('/faq', name: 'faq')]
    public function faq(): Response
    {
        return $this->render('info/faq.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    #[Route('/equipe', name: 'equipe')]
    public function equipe(): Response
    {
        return $this->render('info/equipe.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }
}

    


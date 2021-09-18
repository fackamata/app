<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AnnonceController extends AbstractController
{
    #[Route('/annonces', name: 'annonces')]
    public function show(): Response
    {
        return $this->render('annonce/index.html.twig', [
            'controller_name' => 'AnnonceController',
        ]);
    }

    #[Route('/accept-cookie', name:'accept_cookie')]
    public function acceptCookie(Request $request) : Response
    {
        $session = $request->getSession();
        $session->set('acceptCookie', true);

        return $this->json(['error' => false]);
    }
}

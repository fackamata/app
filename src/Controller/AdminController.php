<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use App\Repository\AvisRepository;
use App\Repository\ConseilRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin_index')]
    public function index(): Response
    {
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/admin/user', name: 'admin_user')]
    public function user(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
    #[Route('/admin/annonce', name: 'admin_annonce')]
    public function annonce(AnnonceRepository $annonceRepository): Response
    {
        return $this->render('admin/annonce/index.html.twig', [
            'annonces' => $annonceRepository->findAll(),
        ]);
    }
    #[Route('/admin/conseil', name: 'admin_conseil')]
    public function conseil(ConseilRepository $conseilRepository): Response
    {
        return $this->render('admin/conseil/index.html.twig', [
            'conseils' => $conseilRepository->findAll(),
        ]);
    }
    #[Route('/admin/avis', name: 'admin_avis')]
    public function avis(AvisRepository $avisRepository): Response
    {
        return $this->render('admin/avis/index.html.twig', [
            'avis' => $avisRepository->findAll(),
        ]);
    }
}

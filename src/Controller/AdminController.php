<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use App\Repository\AvisRepository;
use App\Repository\ConseilRepository;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use App\Service\AdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'admin_index')]
    public function index(AdminService $adminService): Response
    {
        return $this->render('admin/admin.html.twig', [
            'annonce' => $adminService->countAllAnnonce(),
            'conseil' => $adminService->countAllConseil(),
            'avis' => $adminService->countAllAvis(),
            'user' => $adminService->countAllUser(),
            'message' => $adminService->countAllMessage(),
        ]);
    }

    #[Route('/user', name: 'admin_user')]
    public function user(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/annonce', name: 'admin_annonce')]
    public function annonce(AnnonceRepository $annonceRepository): Response
    {
        return $this->render('admin/annonce/index.html.twig', [
            'annonces' => $annonceRepository->findAll(),
        ]);
    }

    #[Route('/conseil', name: 'admin_conseil')]
    public function conseil(ConseilRepository $conseilRepository): Response
    {
        return $this->render('admin/conseil/index.html.twig', [
            'conseils' => $conseilRepository->findAll(),
        ]);
    }

    #[Route('/avis', name: 'admin_avis')]
    public function avis(AvisRepository $avisRepository): Response
    {
        return $this->render('admin/avis/index.html.twig', [
            'avis' => $avisRepository->findAll(),
        ]);
    }

    #[Route('/message', name: 'admin_message')]
    public function message(MessageRepository $messageRepository): Response
    {
        return $this->render('admin/message/index.html.twig', [
            'messages' => $messageRepository->findAll(),
        ]);
    }
}

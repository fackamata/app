<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Type;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use App\Service\FileService;
use App\Service\CounterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/')]
class AnnonceController extends AbstractController
{

    #[Route('/', name: 'annonce_index', methods: ['GET'])]
    public function index(AnnonceRepository $annonceRepository): Response
    {
        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonceRepository->findAll(),
        ]);
    }

    #[Route('annonce/new', name: 'annonce_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FileService $fileService): Response
    {
        $annonce = new Annonce();

        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $annonce->setUser($this->getUser());
            $annonce = $form->getData();

            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();
            if ($file != null) {
                $fileService->upload($file, $annonce, 'photo');
            }        

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonce/new.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('annonce/{id}', name: 'annonce_show', methods: ['GET'])]
    public function show(Annonce $annonce, CounterService $counterService): Response
    {
        $idUserConnected = 0;
        $user  = $this->getUser();
        $username = "";

        $idAnnonce = $annonce->getId();
        $idAnnonceUser = $annonce->getUser()->getId();
        
        if($user  != null){
            $role = $user->getRoles();
            $username = $user->getUsername();
            $idUserConnected = $this->getUser()->getId();            
        }

        if($user  === null || $user ->getUsername() != $annonce->getUser()->getUsername() 
        && in_array("ROLE_ADMIN", $role) != true){
            $nbView = $counterService->countView($annonce->getNombreVue());
            $annonce->setNombreVue($nbView);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($annonce);
            $entityManager->flush();
        }
        
        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
            'username' => $username,
            'idUserConnected' => $idUserConnected,
            'idAnnonceUser' => $idAnnonceUser,
            'idAnnonce' => $idAnnonce,
            'userId' => $idUserConnected
        ]);
    }

    #[Route('annonce/{id}/edit', name: 'annonce_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Annonce $annonce, FileService $fileService): Response
    {
        
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Annonce $annonce */
            $annonce = $form->getData();

            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();

            if ($file) {
                $fileService->upload($file, $annonce, 'photo');
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonce/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    #[Route('annonce/{id}/delete', name: 'annonce_delete', methods: ['POST'])]
    public function delete(Request $request, Annonce $annonce, FileService $fileService): Response
    {
        if ($this->isCsrfTokenValid('delete' . $annonce->getId(), $request->request->get('_token'))) {
            //remove the image file
            $fileService->remove($annonce, 'photo');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($annonce);
            $entityManager->flush();
        }

        return $this->redirectToRoute('annonce_index', [], Response::HTTP_SEE_OTHER);
    }
}

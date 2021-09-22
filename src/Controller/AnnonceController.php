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
    private $username = "";

    #[Route('/', name: 'annonce_index', methods: ['GET'])]
    public function index(AnnonceRepository $annonceRepository): Response
    {
        $user = $this->getUser();

        if ($user != null) {
            $user = $this->getUser()->getId();
            // on récupère l'username de la personne loguer
            $this->username = $this->getUser()->getUsername();
        }

        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonceRepository->findAll(),
            'username' => $this->username
        ]);
    }

    #[Route('annonce/new', name: 'annonce_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FileService $fileService): Response
    {
        $annonce = new Annonce();
        /* on récupère l'entité user */
        $user = $this->getUser();

        /* on récupère les différents type d'annonce possible */
        /* $type = $this->getType(); */

        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /* on set l'user de l'annonce avec l'user récupèrer plus haut */
            $annonce->setUser($user);

            //getData retourne l'entitée annonce
            /** @var Annonce $annonce */
            $annonce = $form->getData();

            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();

            $fileService->upload($file, $annonce, 'photo');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonce/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    #[Route('annonce/{id}', name: 'annonce_show', methods: ['GET'])]
    public function show(Annonce $annonce, CounterService $counterService): Response
    {
        $user = $this->getUser();

        if($user === null || $user->getUsername() != $annonce->getUser()->getUsername()){
            
            $nbView = $counterService->countView($annonce->getNombreVue());
            $annonce->setNombreVue($nbView);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($annonce);
            $entityManager->flush();
        }
        

        if ($user != null) {
            $user = $this->getUser()->getId();
            // on récupère l'username de la personne loguer
            $this->username = $this->getUser()->getUsername();
            
            // on regarde qui est l'utilisateur pour savoir si on incrémente les vues
            // if ($this->username != annonce.user)
        }
        // dd($user);
        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
            'username' => $this->username
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

    #[Route('annonce/{id}', name: 'annonce_delete', methods: ['POST'])]
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

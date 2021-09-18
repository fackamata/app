<?php

namespace App\Controller;

use App\Entity\Conseil;
use App\Form\ConseilType;
use App\Repository\ConseilRepository;
use App\Service\FileService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/conseil')]
class ConseilController extends AbstractController
{
    #[Route('/', name: 'conseil_index', methods: ['GET'])]
    public function index(ConseilRepository $conseilRepository): Response
    {
        return $this->render('conseil/index.html.twig', [
            'conseils' => $conseilRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'conseil_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FileService $fileService): Response
    {
        $conseil = new Conseil();
        /* on récupère l'id de l'utilisateur */
        $userId = $this->getUser()->getId();
        $form = $this->createForm(ConseilType::class, $conseil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* on set l'user du conseil avec l'id de l'user récupèrer plus haut */
            $conseil->setUser($userId);

            //getData retourne l'entitée Conseil
            /** @var Conseil $conseil */
            $conseil = $form->getData();

            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();

            $fileService->upload($file, $conseil, 'photo');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($conseil);
            $entityManager->flush();

            return $this->redirectToRoute('conseil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conseil/new.html.twig', [
            'conseil' => $conseil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'conseil_show', methods: ['GET'])]
    public function show(Conseil $conseil): Response
    {
        return $this->render('conseil/show.html.twig', [
            'conseil' => $conseil,
        ]);
    }

    #[Route('/{id}/edit', name: 'conseil_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conseil $conseil): Response
    {
        $form = $this->createForm(ConseilType::class, $conseil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('conseil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conseil/edit.html.twig', [
            'conseil' => $conseil,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'conseil_delete', methods: ['POST'])]
    public function delete(Request $request, Conseil $conseil): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conseil->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($conseil);
            $entityManager->flush();
        }

        return $this->redirectToRoute('conseil_index', [], Response::HTTP_SEE_OTHER);
    }
}

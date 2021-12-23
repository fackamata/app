<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Service\FileService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface ;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, FileService $fileService): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            //getData retourne l'entitée User
            /** @var User $user */
            $user = $form->getData();

            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();
            if ($file != null) {
                $filename = $fileService->upload($file, $user, 'photo');
            }
            // $fileService->upload($file, $user, 'photo');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);

        
    }

    #[Route('/register/{id}', name: 'app_compte')]
    public function compte( $id, UserInterface $userConnected, UserService $userService): Response
    {
        if($userConnected->getId() != $id){
            return $this->redirectToRoute('annonce_index');
        }
        return $this->render('registration/compte.html.twig', [
            'user' => $userConnected,
            'nbAnnonce' => $userService->countAnnonce($userConnected),
            'nbConseil' => $userService->countConseil($userConnected),
            'nbAvis' => $userService->countAvis($userConnected),
            'msgNonLu' => $userService->countMsgNonLu($userConnected),
        ]);
    }

    #[Route('/register/{id}/edit', name: 'app_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserPasswordEncoderInterface $passwordEncoder, UserInterface $user, FileService $fileService): Response
    {
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

             //getData retourne l'entitée User
            /** @var User $user */
            $user = $form->getData();

            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();
            
            if ($file != null) {
                $fileService->upload($file, $user, 'photo');
               
            }
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('app_compte', ['id'=> $user->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('registration/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/register/annonce/{id}', name:'app_annonce')]
    public function annonce( UserService $userService) : Response
    {
        return $this->render('annonce/index.html.twig', [
            'annonces' => $userService->findAnnonceByUser( $this->getUser())
        ]);
    }

    #[Route('/register/conseil/{id}', name:'app_conseil')]
    public function conseil( UserService $userService) : Response
    {
        return $this->render('conseil/index.html.twig', [
            'conseils' => $userService->findConseilByUser( $this->getUser())
        ]);
    }

    #[Route('/register/avis/{id}', name:'app_avis')]
    public function avis( UserService $userService) : Response
    {
        return $this->render('avis/index.html.twig', [
            'avis' => $userService->findAvisByUser( $this->getUser())
        ]);
    }

    #[Route('/register/message/{id}', name:'app_message_recu')]
    public function messageRecu( UserService $userService) : Response
    {   
        return $this->render('message/recu.html.twig', [
            'messages' => $userService->findMessageByUser( $this->getUser()),
            'user' => $this->getUser()
        ]);
    }
    
    #[Route('/register/message/envoye/{id}', name:'app_message_envoye')]
    public function messageEnvoye( UserService $userService) : Response
    {   
        return $this->render('message/envoye.html.twig', [
            'messages' => $userService->findMessageBySender($this->getUser()),
            'user' => $this->getUser()
        ]);
    }
}

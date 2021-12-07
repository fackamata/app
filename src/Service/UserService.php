<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Annonce;
use App\Entity\Avis;
use App\Entity\Conseil;
use App\Entity\Message;
use App\Repository\AnnonceRepository;
use Symfony\Component\Console\Command\Command;

class UserService extends Command
{

    private $user;
    private $entityManager;
    private $requestStack;

    public function __construct(EntityManagerInterface $entityManager, RequestStack $requestStack)
    {
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;

        parent::__construct();
    }

    // public function someMethod()
    // {
    //     // $session = $this->requestStack->getSession()->getBag();
    //     // dd($session);
    //     // stores an attribute in the session for later reuse
    //     $session->set('attribute-name', 'attribute-value');

    //     // gets an attribute by name
    //     $foo = $session->get('foo');

    //     // the second argument is the value returned when the attribute doesn't exist
    //     $filters = $session->get('filters', []);

    //     // ...
    // }

    public function countAllAnnonce(): int
    {
        $em = $this->entityManager;
        $repo = $em->getRepository(Annonce::class);
        $result = $repo->findAll();

        return count($result);
    }
    public function countAllConseil(): int
    {
        $em = $this->entityManager;
        $repo = $em->getRepository(Conseil::class);
        $result = $repo->findAll();

        return count($result);
    }
    public function countAllUser(): int
    {
        $em = $this->entityManager;
        $repo = $em->getRepository(User::class);
        $result = $repo->findAll();

        return count($result);
    }
    public function countAllAvis(): int
    {
        $em = $this->entityManager;
        $repo = $em->getRepository(Avis::class);
        $result = $repo->findAll();

        return count($result);
    }
    
    public function countAllMessage(): int
    {
        $em = $this->entityManager;
        $repo = $em->getRepository(Message::class);
        $result = $repo->findAll();

        return count($result);
    }

    public function findAnnonceByUser(User $user): array
    {
        $em = $this->entityManager;
        $this->user = $user;
        $repo = $em->getRepository(Annonce::class);
        $result = $repo->findByUser($user);
        
        return $result;
    }

    public function countAnnonce(User $user): int
    {
        $this->user = $user;
        $res = $this->findAnnonceByUser($user);

        return count($res);
    }
    public function findConseilByUser(User $user): array
    {
        $em = $this->entityManager;
        $this->user = $user;
        $repo = $em->getRepository(Conseil::class);
        $result = $repo->findByUser($user);
        
        return $result;
    }

    public function countConseil(User $user): int
    {
        $this->user = $user;
        $res = $this->findConseilByUser($user);

        return count($res);
    }
    public function findAvisByUser(User $user): array
    {
        $em = $this->entityManager;
        $this->user = $user;
        $repo = $em->getRepository(Avis::class);
        $result = $repo->findByUser($user);
        
        return $result;
    }

    public function countAvis(User $user): int
    {
        $this->user = $user;
        $res = $this->findAvisByUser($user);

        return count($res);
    }
    public function findMessageByUser(User $user): array
    {
        $em = $this->entityManager;
        $this->user = $user;
        $repo = $em->getRepository(Message::class);
        $result = $repo->findByUser($user);
        
        return $result;
    }

    public function findMessageBySender(User $user): array
    {
        $em = $this->entityManager;
        $this->user = $user;
        $repo = $em->getRepository(Message::class);
        $result = $repo->findBySender($user);
        
        return $result;
    }

    public function countMessage(User $user): int
    {
        $this->user = $user;
        $res = $this->findMessageByUser($user);

        return count($res);
    }

    public function findByUserNotRead(User $user): array
    {
        $em = $this->entityManager;
        $this->user = $user;
        $repo = $em->getRepository(Message::class);
        $result = $repo->findByUserNotRead($user);
        
        return $result;
    }

    public function countMsgNonLu(User $user): int
    {
        $this->user = $user;
        $res = $this->findByUserNotRead($user);

        return count($res);
    }
}
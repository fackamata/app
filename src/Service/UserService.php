<?php

namespace App\Service;

use App\Entity\Annonce;
use App\Entity\Avis;
use App\Entity\Conseil;
use App\Entity\Message;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserService 
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function findAnnonceByUser(User $user): array
    {
        return $this->em->getRepository(Annonce::class)->findByUser($user);
    }

    public function countAnnonce(User $user): int
    {
        return count($this->findAnnonceByUser($user));
    }

    public function findConseilByUser(User $user): array
    {
        return $this->em->getRepository(Conseil::class)->findByUser($user);
    }

    public function countConseil(User $user): int
    {
        return count($this->findConseilByUser($user));
    }

    public function findAvisByUser(User $user): array
    {
        return $this->em->getRepository(Avis::class)->findByUser($user);
    }

    public function countAvis(User $user): int
    {
        return count($this->findAvisByUser($user));
    }

    public function findMessageByUser(User $user): array
    {
        return $this->em->getRepository(Message::class)->findByUser($user);
    }

    public function findMessageBySender(User $user): array
    {
        return $this->em->getRepository(Message::class)->findBySender($user);
    }

    public function findByUserNotRead(User $user): array
    {
        return $this->em->getRepository(Message::class)->findByUserNotRead($user);;
    }

    public function countMsgNonLu(User $user): int
    {
        return count($this->findByUserNotRead($user));
    }
    
    public function countMessage(User $user): int
    {
        return count($this->findMessageByUser($user));
    }
}
<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Annonce;
use App\Entity\Avis;
use App\Entity\Conseil;
use App\Entity\Message;

class AdminService 
{
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function countAllAnnonce(): int
    {
        return count($this->em->getRepository(Annonce::class)->findAll());
    }

    public function countAllConseil(): int
    {
        return count($this->em->getRepository(Conseil::class)->findAll());
    }

    public function countAllUser(): int
    {
        return count($this->em->getRepository(User::class)->findAll());
    }

    public function countAllAvis(): int
    {
        return count($this->em->getRepository(Avis::class)->findAll());
    }
    
    public function countAllMessage(): int
    {
        return count($this->em->getRepository(Message::class)->findAll());
    }
}
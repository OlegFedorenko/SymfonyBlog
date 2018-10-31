<?php

namespace App\Service;

use App\Entity\Comment;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class Comments
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var EntityRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em =$em;
        $this->repo = $em->getRepository(Comment::class);
    }

    /**
     * @return Comment[]
     */
    public function getAll()
    {
        return $this->repo->findAll();
    }

}
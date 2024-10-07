<?php

namespace App\Repository;

use App\Entity\Todo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Todo>
 */
class TodoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todo::class);
    }

    public function persist(Todo $todo): void
    {
        $em = $this->getEntityManager();
        $em->persist($todo);
        $em->flush();
    }

    public function remove(Todo $todo): void
    {
        $em = $this->getEntityManager();
        $em->remove($todo);
        $em->flush();
    }
}

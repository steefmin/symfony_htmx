<?php

namespace App\Entity;

use App\Repository\TodoRepository;
use App\ViewModel\TodoViewable;
use Assert\Assert;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TodoRepository::class)]
class Todo implements TodoViewable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    public static function createNew(string $title, DateTimeImmutable $now): self
    {
        Assert::that($title)->betweenLength(1, 255);

        $todo = new self();
        $todo->title = $title;
        $todo->created_at = $now;
        return $todo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function removable(): bool
    {
        return true;
    }
}

<?php

declare(strict_types=1);

namespace App\ViewModel;

interface TodoViewable
{
    public function removable(): bool;

    public function getId(): ?int;

    public function getTitle(): ?string;
}

<?php

declare(strict_types=1);

namespace App\ViewModel;

final class RemovedTodo implements TodoViewable
{
    public function removable(): false
    {
        return false;
    }

    public function getId(): null
    {
        return null;
    }

    public function getTitle(): null
    {
        return null;
    }
}

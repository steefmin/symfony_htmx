<?php

declare(strict_types=1);

namespace App\Controller\Htmx;

final readonly class Template
{
    public function __construct(
        private string $view,
        private array $context,
    ) {
    }

    public function getTemplateFileName(): string
    {
        return $this->view;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}

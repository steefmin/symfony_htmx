<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\Htmx\Template;
use Htmxfony\Controller\HtmxControllerTrait;
use Htmxfony\Response\HtmxResponse;
use Htmxfony\Template\TemplateBlock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\TemplateWrapper;

abstract class HtmxController extends AbstractController
{
    use HtmxControllerTrait;

    protected function htmxRenderTemplate(Template ...$templates): HtmxResponse
    {
        $content = '';
        foreach ($templates as $template) {
            $content .= $this->renderView($template->getTemplateFileName(), $template->getContext());
        }

        return new HtmxResponse($content);
    }

}

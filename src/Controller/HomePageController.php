<?php

namespace App\Controller;

use Htmxfony\Request\HtmxRequest;
use Htmxfony\Template\TemplateBlock;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomePageController extends HtmxController
{
    #[Route('/', name: 'app_home_page')]
    public function index(HtmxRequest $request): Response
    {
        try {
            $counter = $request->query->getInt('counter', 0);
        } catch (\UnexpectedValueException $e) {
            $counter = 0;
        }

        if ($request->isMethod('POST')) {
            ++$counter;

            return $this->htmxRenderBlock(
                new TemplateBlock('home_page/index.html.twig', 'body', ['counter' => $counter]),
            )->setPushUrl('/?counter=' . $counter);
        }

        return $this->htmxRender(
            'home_page/index.html.twig',
            [
                'counter' => $counter,
            ],
        );
    }
}

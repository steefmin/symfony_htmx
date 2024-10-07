<?php

namespace App\Controller;

use App\Controller\Htmx\Template;
use App\Entity\Todo;
use App\Repository\TodoRepository;
use App\Service\ClockInterface;
use App\ViewModel\RemovedTodo;
use Htmxfony\Request\HtmxRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TodoController extends HtmxController
{
    public function __construct(
        private readonly TodoRepository $repository,
        private readonly ClockInterface $clock,
    ) {
    }

    #[Route('/todo', name: 'app_todo')]
    public function index(): Response
    {
        $todos = $this->repository->findAll();

        return $this->htmxRender(
            'todo/index.html.twig',
            [
                'todos' => $todos,
            ],
        );
    }

    #[Route('/todo/new', name: 'app_todo_new')]
    public function new(HtmxRequest $request): Response
    {
        sleep(1);
        $title = $request->request->getString('title');

        $todo = Todo::createNew($title, $this->clock->now());
        $this->repository->persist($todo);

        return $this->htmxRenderTemplate(
            new Template('todo/todo.html.twig', ['todo' => $todo]),
            new Template('todo/form/input.html.twig', ['field' => 'title']),
            new Template('todo/form/submit.html.twig', ['error' => 'empty input']),
        );
    }

    #[Route('/todo/{id}/delete', name: 'app_todo_delete')]
    public function delete(HtmxRequest $request): Response
    {
        sleep(2);
        $id = $request->get('id');
        $todo = $this->repository->find($id);
        if ($todo instanceof Todo) {
            $this->repository->remove($todo);
        }

        return $this->htmxRender('todo/todo.html.twig', ['todo' => new RemovedTodo()]);
    }

    #[Route('/todo/validate/{field}', name: 'app_todo_validate')]
    public function validate(HtmxRequest $request): Response
    {
        $validate = $request->get('field');
        $title = $request->request->getString($validate);
        try {
            Todo::createNew($title, $this->clock->now());
        } catch (\Exception $e) {
            return $this->htmxRenderTemplate(
                new Template('todo/form/error.html.twig', ['target' => $validate, 'error' => $e->getMessage()]),
                new Template('todo/form/submit.html.twig', ['error' => $e->getMessage()]),
            );
        }

        return $this->htmxRenderTemplate(
            new Template('todo/form/error.html.twig', ['target' => $validate, 'error' => '']),
            new Template('todo/form/submit.html.twig', []),
        );
    }
}

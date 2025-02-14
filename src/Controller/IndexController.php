<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\GetListModel;
use App\Model\PostMessageModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/index', name: 'index.')]
class IndexController extends AbstractController
{
    #[Route('', name: 'get_list', methods: [Request::METHOD_GET])]
    public function index(GetListModel $model): Response
    {
        return $this->render(
            'index.html.twig',
            [
                'posts' => $model->getList(),
            ]
        );
    }

    #[Route('', name: 'add_post', methods: [Request::METHOD_POST])]
    public function post(Request $request, PostMessageModel $model, GetListModel $modelList): Response
    {
        if ($model->validate($data = $model->beforeDecorator($request->request->all()))) {
            $model->post($data);
        }

        return $this->render(
            'index.html.twig',
            [
                'posts' => $modelList->getList(),
            ]
        );
    }
}

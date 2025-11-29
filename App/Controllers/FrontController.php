<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Interfaces\PostRepositoryInterface;
use App\Views\FrontView;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FrontController
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private FrontView $frontView
    ) {}

    public function index(ServerRequestInterface $request): ResponseInterface
    {
        return $this->response($this->frontView->index());
    }

    public function showAllPosts(ServerRequestInterface $request): ResponseInterface
    {
        $posts = $this->postRepository->all();
        return $this->response($this->frontView->posts($posts));
    }

    public function showPost(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $post = $this->postRepository->find((int)$args['id']);

        if (!$post) {
            return $this->response($this->frontView->error404(), 404);
        }

        return $this->response($this->frontView->post($post));
    }
    private function response(string $content, int $status = 200): ResponseInterface
    {
        $response = new Response();
        $response->getBody()->write($content);
        return $response->withStatus($status);
    }
}
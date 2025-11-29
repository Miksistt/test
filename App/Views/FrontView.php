<?php
declare(strict_types=1);

namespace App\Views;

use Twig\Environment;

class FrontView
{
    public Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function index(): string
    {
        return $this->twig->render('/auth/login.php');
    }

    public function posts(array $posts): string
    {
        return $this->twig->render('/front/posts/post_list.twig', [
            'articles' => $posts,
            'show_pagination' => count($posts) > 12
        ]);
    }

    public function post(object $post): string
    {
        return $this->twig->render('/front/posts/post_content.twig', ['post' => $post]);
    }

    public function error404(): string
    {
        return $this->twig->render('/front/errors/404.twig');
    }
}
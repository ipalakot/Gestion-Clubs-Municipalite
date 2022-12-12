<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiArticleContollerController extends AbstractController
{
    /**
     * @Route("/api/article/contoller", name="app_api_article_contoller")
     */
    public function index(): Response
    {
        return $this->render('api_article_contoller/index.html.twig', [
            'controller_name' => 'ApiArticleContollerController',
        ]);
    }
}

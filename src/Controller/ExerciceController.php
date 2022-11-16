<?php

namespace App\Controller;

use App\Repository\ArticleRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/exoclass")
 */

class ExerciceController extends AbstractController
{
    /**
     * Undocumented function
     * @Route("/find", name="cls_find")
     * @param ArticleRepository $articlerepo
     * @return Response
     */
    public function index(ArticleRepository $articlerepo ): Response
    {
        
        $articles = $articlerepo->find(	
            200);
        
        return $this->renderForm('exercice/query.html.twig', [
            'articles' => $articles,

        ]);
    }

    /**
     * @Route("/find", name="app_findoneby")
     * @param ArticleRepository $articlerep
     * @return Response
     */
    public function findoneby(ArticleRepository $articlerep):Response
    {
        return $this->render('exercice/findoneby.html.twig', [

        ]);
    }
        
}
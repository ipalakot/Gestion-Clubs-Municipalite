<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use Knp\Component\Pager\PaginatorInterface;

use Symfony\Component\Routing\Annotation\Route;

// use Doctrine\Common\Persistance\ObjectManager;



    class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="app_article")
     */
    public function index(PaginatorInterface $paginator, Request $request, ArticleRepository $articlesRepository): Response
    {

        $donnees = $articlesRepository->findAll();

        $articles = $paginator->paginate(
            $donnees, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        25 /*limit per page*/
    );

        return $this->render('article/index.html.twig', [

            'articles' => $articles,
        ]);
    }


    /**
     * @Route("/article/{id}", name="app_article_affichage")
     * 
     */
    public function affichage($id)
    {    
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles= $repo->find($id);
        
        return $this->render('article/affichage.html.twig', [

            'articles'=>$articles

        ]);

    }

    /**
     * @Route("/catalogue", name="app_catalogue")
     */
    public function catalogue(): Response
    {
        return $this->render('article/catalogue.html.twig', [

        ]);
    }
    /**
     * @Route("/abonnements", name="app_abonnements")
     */
    public function abonnements(): Response
    {
        return $this->render('article/abonnement.html.twig', [

        ]);
    }

}

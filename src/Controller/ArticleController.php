<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;

use App\Form\ArticleType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\Form;

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
        10 /*limit per page*/
    );

        return $this->render('article/index.html.twig', [

            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/newart", name="app_articles_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArticleRepository $articleRepository): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->add($article, true);

            return $this->redirectToRoute('app_articles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
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

<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Entity\Commentaire;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="app_article", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request, ArticleRepository $articleRepository): Response
    {
        $donnees = $articleRepository->findAll();

        $articles = $paginator->paginate(
            $donnees, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        30 /*limit per page*/
    );
    
    return $this->render('article/index.html.twig', [
           'articles' => $articles,
        ]);
    }

    /**
     * Affichage des ARticles dans l'ordre Ascendant
     * Afficher les article dans l'ordre ASC
     * @Route("/asc", name="app_article_asc", methods={"GET"})
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function listArtAsc(PaginatorInterface $paginator, Request $request, ArticleRepository $articleRepository): Response
    {
        $donnees = $articleRepository->findBy([],['titre' => 'asc']);

        $articles = $paginator->paginate(
            $donnees, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        30 /*limit per page*/
    );
    
    return $this->render('article/index.html.twig', [
           'articles' => $articles,
        ]);
    }
    
    /**
     * Afficher les article dans l'ordre Desc
     * @Route("/desc", name="app_article_desc", methods={"GET"})
     */
    public function listArtDesc(PaginatorInterface $paginator, Request $request, ArticleRepository $articleRepository): Response
    {
        $donnees = $articleRepository->findBy([],['titre' => 'desc']);

        $articles = $paginator->paginate(
            $donnees, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        30 /*limit per page*/
    );
    
    return $this->render('article/index.html.twig', [
           'articles' => $articles,
        ]);
    }




    /**
     * @Route("/new", name="app_articles_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArticleRepository $articleRepository): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->add($article, true);

            return $this->redirectToRoute('app_article', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/new.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

   /**
    * Affichage d'un article avec Slug & ID 
    * @Route("/titre/{slug}", name="app_article_affichage_slug", requirements={"slug":"[a-z0-9\-]*"})
    * @param Article $article
    * @param Request $request
    * @return void
    */
   public function affichageSlug(Article $article, Request $request){

    return $this->render('article/affichage_slug.html.twig',
    ['article' => $article]);

   }


    /**
     * Affichage d'un article avec Slug & ID 
     * @Route("/{slug}-{id}", name="app_article_affichage", methods={"GET"}, requirements={"slug":"[a-z0-9\-]*"})
     * @param Article $article
     * @param Request $request
     */
    public function affichage(EntityManagerInterface $entityManager, Article $articles, string $slug, Request $request, $id)
    {    
        if($articles->getSlug() !==$slug){
            return $this->redirectToRoute('app_article_affichage',
            ['id'=>$articles->getId(),
            'slug'=>$articles->getslug()],
            301);
        }
        $commentaire = new Commentaire();
        //$commentairesForm = $this->createForm(CommentairesType::class, $commentaires);

        $form = $this->createFormBuilder($commentaire)
                ->add('auteur')
                ->add('contenu') 
                ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $commentaire->setCreatedAt(new \DateTime())
                     ->setArticle($articles);
            $entityManager->persist($commentaire);
            $entityManager->flush();
            return $this->redirectToRoute('app_article_affichage',  ['id' => $articles->getId()
            ]);
    }
        return $this->render('article/affichage.html.twig', [
        'articles'=>$articles,
        'form'=> $form->createView()
        //'commentaires '=> $commentaires ,
        ]);

    }


    /**
     * Afficher 1 Article à partir de son ID
     * @Route("/get/{id}", name="app_article_affichage2")
     * @param [type] $id
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function getArticle($id, ArticleRepository $artrepo)
    {
        //$artrepo = $this->getDoctrine()->getRepository(Article::class);
        
        $articles = $artrepo->find($id);

        return $this->render('article/affichage2.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Afficher 1 Article à partir de son Titre
     * @Route("/gettitle/test", name="app_article_affichage3")
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function getArticleTitle(ArticleRepository $artrepo)
    {
        //$artrepo = $this->getDoctrine()->getRepository(Article::class);
        
        $articles = $artrepo->findOneBy(array('titre' => 'programmation'));

        return $this->render('article/affichage3.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Afficher 1 Article tous les Article sans fair ede Trie
     * @Route("/gettest/all", name="app_article_All", methods={"GET"})
     * @return Response
     */
    public function getAll(Request $request, ArticleRepository $articleRepository): Response
    {
        //$articles = $articleRepository->findAll();

    return $this->render('article/index_all.html.twig', [
           'articles' => $articleRepository->findAll(),
        ]);
    }

    
    /**
     * Afficher 1 Article tous les Article avec des critères
     * @Route("/gettest/articritere", name="app_article_All", methods={"GET"})
     * @return Response
     */
    public function getAllWithCrit(Request $request, ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findBy(
            ['titre' => 'developpement'],
            ['id' => 'ASC']
        );

    return $this->render('article/index_all.html.twig', [
           'articles' => $articles,
        ]);
    }
    
    /**
     * @Route("/{id}/edit", name="app_article_edit", methods={"GET", "POST"})
     */
    public function editer(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->add($article, true);

            return $this->redirectToRoute('app_article', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('article/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_articles_suppr", methods={"POST"})
     */
    public function supprimer(Request $request, Article $article, ArticleRepository $articleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $articleRepository->remove($article, true);
        }

        return $this->redirectToRoute('app_article', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * Undocumented function
     * @Route("/list/categ", name="app_categaf", methods={"GET"})
     * @return void
     */
    public function findCat(ArticleRepository $articles)
    {   
        $articles = $articles->findCategorie();
        return $this->render('article/index_cat.html.twig', [
            'articles' => $articles,
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

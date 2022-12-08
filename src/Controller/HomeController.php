<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Knp\Component\Pager\PaginatorInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(PaginatorInterface $paginator, Request $request, ArticleRepository $articlesRepository): Response
    {
        $donnees = $articlesRepository->findAll();

        $articles = $paginator->paginate(
            $donnees, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
       8 /*limit per page*/
    );
        
            return $this->render('home/index.html.twig', [

            'articles' => $articles,
        ]);
    }


    /**
     * @Route("/apropos", name="app_apropos")
     */
    public function apropos(): Response
    {
        return $this->render(
            'home/apropos.html.twig',
            [
               
            ]
        );
    }
    
    /**
     * Liste des Activités proposées aux Users
     * @Route("/activites", name="home_activites")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @param ArticleRepository $articleRepository
     * @return Response
     */
    public function activites(PaginatorInterface $paginator, Request $request, ArticleRepository $articleRepository): Response
    {
        $donnees = $articleRepository->findAll();

        $articles = $paginator->paginate(
            $donnees, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        30 /*limit per page*/
    );
    
    return $this->render('home/activites.html.twig', [
           'articles' => $articles,
        ]);
    }


    
    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact(): Response
    {
        
       //Affiche du contact avec balise HTML
        return new Response(
            "

            <html>
                <body>
                    <h1> PAGE CONTACT</h1>
                </body>
            </html>"
        );
    }

    /**
     * @Route("/actualites", name="app_actuality")
     */
    public function actualites(): Response
    {
        $response1 = $this->forward('Controller: App\Controller\HomeController::index', [
                'num_matricule'=>'2022-23',
                'note_recu'=>'10/20',
    ]);

        // return $response;
        return new Response($response1);
    }

    /**
     * @Route("/municipalites", name="app_apr")
     */
    public function municipalites()
    {
        //redirection sur une Route de mon application
        return $this->redirectToRoute('app_apropos');

        // return $this->generateUrl('https://fr.wikipedia.org/wiki/Listes_des_communes_de_Francehome');
    }

    /**
     * @Route("/admin/tools", name="admin_tools")
     */
    public function tools()
    {
        //listing des outils pour la Gestion de l'applcation
        return $this->render('admin/tools.html.twig', [

        ] );

        // return $this->generateUrl('https://fr.wikipedia.org/wiki/Listes_des_communes_de_Francehome');
    }
}
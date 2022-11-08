<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/categorie")
 */

 class CategorieController extends AbstractController
{
    /**
     * @Route("/", name="app_categorie_index", methods={"GET"})
     */
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="adm_categorie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CategorieRepository $categorieRepository): Response
    {
         // Nouvelle Categorie
         $categorie = new Categorie();
        
        // Creation du Gabarit du Formulaire
        $form = $this->createFormBuilder($categorie)
                    
        // Ajouter les prop de mon formulaire
                ->add('titre')
                ->add('resume')

            // Demande le résultat
            ->getForm();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieRepository->add($categorie, true);

            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

}

<?php

namespace App\Controller;

use App\Repository\CategorieRepository; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiCategorieController extends AbstractController
{
   /**
     * @Route("/api/categorie", name="app_api_categorie", methods={"GET"}) // J'affiche ici la liste des methodes
     */

     public function listeCategorie(CategorieRepository $categorieRepository, NormalizerInterface $normalizer): Response
     {
 
    # Récupération des categories 
        /* $categories = $categorieRepository -> findAll();
    
    # Utiliser les TAG dont on a besoin et utiliser Normalizer
         $catNormalises = $normalizer->normalize($categories, null, [
                 'groups'=>'categorie:api'
             ]);
         
     # Encode Auteur avec Json_Encode 
         $categoriesJson = json_encode($catNormalises);
         dd($categoriesJson);*/

    # Reduire tout le code en 1 seul
        return $this-> json(
            $categorieRepository->findAll(),
            200,
            [],
            [
                        "groups"=> "categorie:api",
                    ],
        );
 
     }
 }
 
<?php

namespace App\Controller;

use App\Repository\CommentaireRepository; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiCommentaireController extends AbstractController
{
  /**
     * @Route("/api/commentaire", name="app_api_commentaire", methods={"GET"}) // J'affiche ici la liste des methodes
     */

     public function listeCommentaire(CommentaireRepository $commentaireRepository, NormalizerInterface $normalizer): Response
     {
    # Récupération des commentaires
        /* $commentaires = $commentaireRepository -> findAll();

    # Utiliser les TAG dont on a besoin et utiliser Normalizer   
         $comNormalises = $normalizer->normalize($commentaires, null, [
                 'groups'=>'commentaire:api'
             ]);
         
     
    # Encode Auteur avec Json_Encode 
         $commentairesJson = json_encode($comNormalises);
         dd($commentairesJson);*/
    
    # Reduire tout le code en 1 seul
        return $this-> json(
            $commentaireRepository->findAll(),
            200,
            [],
            [
                        "groups"=> "categorie:api",
                    ],
        );
 
     }
 }
 
<?php

namespace App\Controller;

use App\Repository\AuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ApiAuteurController extends AbstractController
{
    /**
     * @Route("/api/auteur", name="app_api_auteur", methods={"GET"}) // J'affiche ici la liste des methodes
     */

    public function listeAuteur(AuteurRepository $auteurRepository, NormalizerInterface $normalizer): Response
    {

    # Récupération des auteurs
        /*$auteurs = $auteurRepository -> findAll();

    # Utiliser les TAG dont on a besoin et utiliser Normalizer
        $autNormalises = $normalizer->normalize($auteurs, null, [
                'groups'=>'auteur:api'
            ]);
        
    
    # Encode Auteur avec Json_Encode 
        $auteursJson = json_encode($autNormalises);
        dd($auteursJson);*/

    # Reduire tout le code en 1 seul
        return $this-> json(
            $auteurRepository->findAll(),
            200,
            [],
            [
                        "groups"=> "auteur:api",
                    ],
        );

    }

}

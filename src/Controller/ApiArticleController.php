<?php

namespace App\Controller;

use FOS\UserBundle\Model\Group;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/api", name="api_")
 * 
 */
class ApiArticleController extends AbstractController
{
    /**
     * @Route("/", name="article", methods={"GET"}) // J'affiche ici la liste des methodes
     */
    public function liste(ArticleRepository $articleRepo, NormalizerInterface $normalizer): Response
    {
        #_1 Recupération des Articles
            // On récupère la liste des articles et on les affiche comme nous savons dejà faire
            // $article = $articleRepo -> findAll();
            //dd($article);

       
         #_2 Json_Encode 
            // j'utilise du Json pour l'affichage de mon tableau
            //  Je vais utiliser l'encodeur JSON1 l'affiche du Tableau
                        
           /* $testJson = json_encode([
                'Test1 ' => 'Sport et action publique locale1 \\n\\n',
                'Test2' => 'Guinot Dance School, Cours de danse et Ecole',
                'Test3' => 'Cours de musique et de chant à domicile !!',
                'Test4' => 'Atelier Yoga – Association Loi 1901 dans la commune'
            ]); */

            //$article = $articleRepo -> findAll();
            //$articlejson = json_encode($article);
            //dd($articlejson);
        
        #_3 Utiliser le Normalizer
            //$articles = $articleRepo -> findAll();
            //$articlesnormalises = $normalizer -> normalize($articles);
            // dd( $articlesnormalises);
        

        #_4 Tagger les arttibuts dont a besoin

            $articles = $articleRepo -> findAll();
            $articlNormalises = $normalizer->normalize($articles, null, [
                    'groups'=>'article:api'
                ]);
            //dd($articlNormalises);
        
        #_5 Encode Article avec Json_Encode 
            $articlesJson = json_encode($articlNormalises);
            dd($articlesJson);
            


       /* $response = new Response();
        $response -> headers->set('Content-Type', 'application/json');
        
        return $this->json($articleRepo->findAll(), 200, [], [
            "groups"=> "article:api"],
        ); */
        
        #_3  utiliser le TAG pour choisir les attributs que l'on veut afficher
        




        
    }
}

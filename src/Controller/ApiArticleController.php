<?php

namespace App\Controller;

use App\Entity\Article;

use FOS\UserBundle\Model\Group;


use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;

//use Symfony\Component\Messenger\Transport\Serialization\Serializer;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api", name="api_")
 *
 */
class ApiArticleController extends AbstractController
{
    /**
     * @Route("/list", name="article_list", methods={"GET"}) // J'affiche ici la liste des methodes
     */
    public function liste(ArticleRepository $articleRepo, NormalizerInterface $normalizer, SerializerInterface $serializer): Response
    {
        #_1 Recupération des Articles
        // On récupère la liste des articles et on les affiche comme nous savons dejà faire
        //$articles = $articleRepo -> findAll();

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
        //$articles = $articleRepo -> findAll();
        /* $articlNormalises = $normalizer->normalize($articles, null, [
                     'groups'=>'article:api'
                 ]);*/
        //dd($articlNormalises);
        
        #_5 Encode Article avec Json_Encode
        //$articlesJson = json_encode($articlNormalises);
        //dd($articlesJson);
            
        #_6 Retourner le Tableau avec une reponse HTTP
        // creer une nouvelle Response
        //Passer $articlesJson
        // Utiliser 1 Content-Type pour signifier que l'application va s'afficher en Json
        
        //$articlesJson = json_encode($articlNormalises);
        /*$response = new Response($articlesJson, 200, [
            "content-type"=>"application/json"
         ]);

        return $response; */

        #_6 La serialization
        //Regrouper les #3 & #5
        // Le Serializer embarque avec lui Le Normalizer et l'Encodage

       
        /* $articleSerialises  =$serializer->serialize($articles, 'json', [
                                     'groups'=> 'article:api']);

         $response = new Response($articleSerialises, 200, [], true);

         return $response; */

        
        #_7_ reduire tout le code en 1 seul
        return $this-> Json(
            $articleRepo->findAll(),
            200,
            [],
            [
                "groups"=> "article:api",
                /*'circular_reference_handler' => function ($object) {
                    return $object->getId();
                }*/
            ]
        );

        

        #_8_ ajouter dans l'articles les données des Auteurs/Categories/Commentaire

        /* $response = new Response();
         $response -> headers->set('Content-Type', 'application/json');

         return $this->json($articleRepo->findAll(), 200, [], [
             "groups"=> "article:api"],
         ); */
        
        #_3  utiliser le TAG pour choisir les attributs que l'on veut afficher
    }

    /**
     * Affichage dun article
     * @Route("/lire/{id}", name="article_display", methods={"GET"})
     */
    public function getArticle(Article $article)
    {
        return $this-> Json(
            $article,
            200,
            [],
            [
                "groups"=> "article:api"

            ],
        );
    }

    /**
     *
     * @Route("/add", name="artcle_ajout", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serialializer, EntityManagerInterface $manager)
    {
        
     #_1 Lecture de Contenu
        //Lecture du contenu de la requete HTTP
        // c'set bien sur du Json
        $articleSent = $request->getContent();
        //dd($articleSent);

        #_2 deserialisation
        // Prendre el Json et le tranformer en Entity
        // deserialiser sur la forme de la class Article
        // En partant du format Json
        $articles  = $serialializer->deserialize($articleSent, Article::class, 'json');
        // dd($articles);
        
        #_3 Appel de Mon Entity Managr
        //Je persite alors le contenu dans la BD
        // Sans oublier de setter la date
        $articles->setCreatedAt(new\DateTime());
        $manager->persist($articles);
        $manager->flush();
        dd($articles);

    
        #_3 Envoi de reponse
       // return $this-> json($articles, 200, [], ['groups'=> 'article:api']);
    }
}
<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Repository\AuteurRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\request;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends AbstractController
{
    /**
     * @Route("/auteur", name="app_auteur")
     */
    public function index(AuteurRepository $auteurRepository): Response
    {
        return $this->render('auteur/index.html.twig', [
            'controller_name' => 'AuteurController',
            'auteurs' => $auteurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/auteur", name="adm_index_auteur")
     */
    public function index_adm(AuteurRepository $auteurRepository): Response
    {
        return $this->render('auteur/index_adm.html.twig', [
            'controller_name' => 'AuteurController',
            'auteurs' => $auteurRepository->findAll(),
        ]);
    }

    /**
    * @Route("/new", name="app_auteur_new", methods={"GET", "POST"})
    */
    public function nouveau(AuteurRepository $auteurRepository): Response
    {
        $auteur = New Auteur();

        $form = $this->createFormBuilder($auteur)
        
        //Ajouter les prop de mon formulaire

            ->add('noms')
            ->add('prenoms')
            ->add('adresse')
            ->add('mail')
            ->add('phone')

            ->getForm();

        return $this->render('auteur/new.html.twig', [
            'form' => $form, 
            'auteur'=>$auteur       
        ]);
    }
    /**
     * @Route("/auteur/{id}", name="app_auteur_affichage")
     *
     */
    public function affichage($id)
    {
        $repo = $this->getDoctrine()->getRepository(Auteur::class);
        $auteurs= $repo->find($id);
        
        return $this->render('auteur/affichage.html.twig', [

            'auteurs'=>$auteurs
        ]);
    }
}
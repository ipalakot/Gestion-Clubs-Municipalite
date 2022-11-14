<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Repository\AuteurRepository;
use App\Form\AuteurType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auteur")
 */
class AuteurController extends AbstractController
{
    /**
     * @Route("/", name="app_auteur")
     */
    public function index(AuteurRepository $auteurRepository): Response
    {
        return $this->render('auteur/index.html.twig', [
            'controller_name' => 'AuteurController',
            'auteurs' => $auteurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin", name="adm_index_auteur")
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
    public function nouveau(Request $request, AuteurRepository $auteurRepository): Response
    {
        // Nouvel Auteur
        $auteur = New Auteur();

        // Creation du Gabarit du Formulaire
        $form = $this->createFormBuilder($auteur)
        
        // Ajouter les prop de mon formulaire
            ->add('noms')
            ->add('prenoms')
            ->add('adresse')
            ->add('mail')
            ->add('phone')

            // Demande le résultat
            ->getForm();

           // Analyse des Requetes & Traitement des information 
            $form->handleRequest($request);

           // Test sur le Formulaire
            if ($form->isSubmitted() &&  $form->isValid()){
                $auteurRepository->add($auteur, true);

                //Redirection
                return $this->redirectToRoute('adm_index_auteur');
            }
            
        return $this->render('auteur/new.html.twig', [
            'form' => $form->createView(), 
            'auteur'=>$auteur       
        ]);
    }
   
    
    /**
     * @Route("/{id}/edit", name="adm_auteur_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Auteur $auteur, AuteurRepository $auteurRepository): Response
    {
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $auteurRepository->add($auteur, true);

            return $this->redirectToRoute('adm_index_auteur', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('auteur/edit.html.twig', [
            'auteur' => $auteur,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="app_auteur_affichage")
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

    
    /**
     * @Route("/{id}", name="app_autor_test_delete", methods={"POST"})
     */
    public function delete(Request $request, Auteur $auteurs, AuteurRepository $auteurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$auteurs->getId(), $request->request->get('_token'))) {
            $auteurRepository->remove($auteurs, true);
        }

        return $this->redirectToRoute('adm_index_auteur', [], Response::HTTP_SEE_OTHER);
    }

}
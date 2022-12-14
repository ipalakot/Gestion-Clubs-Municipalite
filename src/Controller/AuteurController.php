<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\AuteurType;
use App\Repository\AuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auteur")
 */
class AuteurController extends AbstractController
{
    /**
     * @Route("/", name="app_auteur", methods={"GET"})
     */
    public function index(AuteurRepository $auteurRepository): Response
    {
        return $this->render('auteur/index.html.twig', [
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
        $auteur = new Auteur();
        
        // Creation du Gabarit du Formulaire
        $form = $this->createForm(AuteurType::class, $auteur);
        
        // Creation du Gabarit du Formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $auteurRepository->add($auteur, true);

            return $this->redirectToRoute('adm_index_auteur', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('auteur/new.html.twig', [
            'auteur' => $auteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_auteur_affichage", methods={"GET"})
     */
    public function affichage(Auteur $auteur): Response
    {
        return $this->render('auteur/affichage.html.twig', [
            'auteur' => $auteur,
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
     * @Route("/{id}", name="app_auteur_delete", methods={"POST"})
     */
    public function delete(Request $request, Auteur $auteur, AuteurRepository $auteurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$auteur->getId(), $request->request->get('_token'))) {
            $auteurRepository->remove($auteur, true);
        }

        return $this->redirectToRoute('adm_index_auteur', [], Response::HTTP_SEE_OTHER);
    }
}

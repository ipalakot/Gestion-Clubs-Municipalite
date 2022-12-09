<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\RegistrationFormType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    
    /**
     * Afficher tous les Users enreistrés
     * @Route("/user", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('registration/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }


    /**
     * Enregistrement dans la table USER
     *
     * @Route("/register", name="user_enregistrement")
     * @param Request $request
     * @param UserPasswordHasherInterface $userPasswordHasher
     * @param UserAuthenticatorInterface $userAuthenticator
     * @param UserAuthenticator $authenticator
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
    * @Route("/reg/{id}", name="adm_user_affichage", methods={"GET"})
    */
    public function affichage(User $user): Response
    {
       return $this->render('registration/affichage.html.twig', [
           'user' => $user,
       ]);
    }

    /**
     * @Route("{id}/edit", name="adm_user_edit", methods={"GET", "POST"})
     */
    public function edit(EntityManagerInterface $em, Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //$usersRepository->add($user, true);
            $em->persist($user);
            $em->flush();
           

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('registration/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);

    }

    /**
     * @Route("/{id}", name="adm_user_suppr", methods={"POST"})
     */
    public function suppr(Request $request, User $user, UserRepository $userRepository): Response
    
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            
             $userRepository->remove($user, true);
            
            //$manager= $this->getDoctrine()-getManager();
                
            //    $this->$manager->remove(user);
            //    $manager->flush();
        }
        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
}
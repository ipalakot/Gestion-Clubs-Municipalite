<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use App\Form\UsersType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/users")
 */
class UsersController extends AbstractController
{
    /**
     * @Route("/", name="adm_users")
     */
    public function index(UsersRepository $usersRepository): Response
    {
        return $this->render('users/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="adm_users_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UsersRepository $usersRepository): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usersRepository->add($user, true);

            return $this->redirectToRoute('adm_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/nouveau.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="adm_users_display", methods={"GET"} )
     *
     */
    public function displayUsers(Users $users)
    {
        //$repo = $this->getDoctrine()->getRepository(Users::class);
        //$users= $repo->find($id);
        
        return $this->render('users/affichage.html.twig', [

            'users'=>$users

        ]);
    }
}
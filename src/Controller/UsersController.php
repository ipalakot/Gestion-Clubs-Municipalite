<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Common\Persistence\ObjectManager;

class UsersController extends AbstractController
{
    /**
     * @Route("/admin/users", name="adm_users")
     */
    public function index(UsersRepository $usersRepository): Response
    {
        return $this->render('users/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/users/{id}", name="adm_users_display", methods={"GET"} )
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
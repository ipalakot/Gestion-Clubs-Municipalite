<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use App\Form\UsersType;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;




/**
 * @Route("/users")
 */
class UsersController extends AbstractController
{
    /**
     * Afficher tous les Users
     * @Route("/", name="adm_users", methods={"GET"})
     */
    public function index(UsersRepository $usersRepository): Response
    {
        return $this->render('users/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/triAsc/{champ}", name="app_users_tri_asc")
     */
    public function triAsc(PaginatorInterface $paginator, Request $request, UsersRepository $usersRepository): Response
    {
        $champ = $request->attributes->get('champ');
        $donnees = $usersRepository->getTriAsc($champ);

        $users = $paginator->paginate(
            $donnees, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        30 /*limit per page*/
    );
        return $this->render('users/index.html.twig', [
        'users' => $users,
        ]);
    }

    /**
     * @Route("/new", name="adm_users_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UsersRepository $usersRepository, EntityManagerInterface $em): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usersRepository->add($user, true);
          
           //$em->persist($user);
           //$em->flush();
           
           return $this->redirectToRoute('adm_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/nouveau.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

   /**
     * Afficher les Users par le Nom
     * @Route("/list/", name="app_user_names", methods={"GET"})
     * @return Response
     */
    public function getAllWithCrit(Request $request, UsersRepository $users): Response
    {
        $users = $users->findByNoms('');

    return $this->render('users/index2.html.twig', [
           'users' => $users,
        ]);
    }

     /**
     * Afficher les Users entre une tranche d'age
     * @Route("/list2/", name="app_user_tranchesage", methods={"GET"})
     * @return Response
     */
    public function listAgeBetween(Request $request, UsersRepository $users)
    {
        $users = $users->getUsersBetween(30, 40);

    return $this->render('users/index2.html.twig', [
           'users' => $users,
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

    
    
    /**
     * @Route("/{id}/edit", name="adm_users_edit", methods={"GET", "POST"})
     */
    public function edit( EntityManagerInterface $em, Request $request, Users $user, UsersRepository $usersRepository): Response
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            //$usersRepository->add($user, true);
            $em->persist($user);
            $em->flush();
           

            return $this->redirectToRoute('adm_users', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="adm_users_suppr", methods={"POST"})
     */
    public function suppr(Request $request, Users $user, UsersRepository $usersRepository): Response
    
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            
             $usersRepository->remove($user, true);
            
            //$manager= $this->getDoctrine()-getManager();
                
            //    $this->$manager->remove(user);
            //    $manager->flush();
        }
        return $this->redirectToRoute('adm_users', [], Response::HTTP_SEE_OTHER);
    }

}
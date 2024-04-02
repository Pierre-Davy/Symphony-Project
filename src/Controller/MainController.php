<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/users', name: 'index')]
    public function index(UsersRepository $repository): Response
    {
        $users = $repository->findAll();

        shuffle($users);

        return $this->render(
            'main/index.html.twig',
            [
                'users' => $users,
            ]
        );
    }

    #[Route('/users/{id}', name: 'show')]
    public function show(Users $user): Response
    {
        return $this->render('main/show.html.twig', [
            'user' => $user
        ]);
    }
}

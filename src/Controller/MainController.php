<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\CitiesRepository;
use App\Repository\CountriesRepository;
use App\Repository\GroupesRepository;
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
        $cities = $repository->findAll();

        shuffle($users);



        return $this->render(
            'main/index.html.twig',
            [
                'users' => $users,
                'cities' => $cities
            ]
        );
    }

    #[Route('/users/{id}', name: 'show')]
    public function show(Users $user, CitiesRepository $citiesRepository, CountriesRepository $countriesRepository, GroupesRepository $groupesRepository): Response
    {


        $city = $citiesRepository->findOneById($user->getCity());

        $country = $countriesRepository->findOneById($city->getCountry());

        $groupes = $groupesRepository->findByUser($user->getId());

        return $this->render('main/show.html.twig', [
            'user' => $user,
            'city' => $city,
            'country' => $country,
            'groupes' => $groupes
        ]);
    }
}

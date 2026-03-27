<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PokemonController extends AbstractController
{
    #[Route('/pokemon', name: 'app_pokemon')]
    public function index(): Response
    {
        return $this->render('pokemon/index.html.twig', [
            'controller_name' => 'PokemonController',
        ]);
    }

    #[Route('/pokemon/create', name: 'app_pokemon_create')]
    public function create(): Response
    {
        return $this->render('pokemon/create.html.twig', [
            
        ]);
    }
}

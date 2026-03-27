<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        if($request->isMethod('POST')){
        $strPokemonName     = $request->request->get('name');
        $strPokemonNumber   = $request->request->get('number');

        $objPokemon = new Pokemon();

        $objPokemon->setName($strPokemonName)
                   ->setNumber($strPokemonNumber);

        $entityManager->persist($objPokemon);
        $entityManager->flush();
        dd($objPokemon);
        }

        return $this->render('pokemon/create.html.twig',[]);
    }
}

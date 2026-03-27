<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PokemonController extends AbstractController
{
    #[Route('/pokemon', name: 'app_pokemon')]
    public function index(PokemonRepository $pokemonRepository): Response
    {
        return $this->render('pokemon/index.html.twig', [
            'controller_name' => 'PokemonController',
        ]);
    }

    #[Route('/pokemon/create', name: 'app_pokemon_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
         if($request->isMethod('POST')){

                $onError = false;//<Flag qui verifie si tout est OK

                $strPokemonName     = $request->request->get('name');
                $strPokemonNumber   = $request->request->get('number');

                    if($strPokemonNumber < 0){

                        $onError = true;


                        //Je stock un message "Flash" dans la session 
                        //$this->addFlash('danger','Le numéro du Pokémon doit être supérieur à 0');
                    }

                if(!$onError){
                        $objPokemon = new Pokemon();

                        $objPokemon->setName($strPokemonName)
                                ->setNumber($strPokemonNumber);

                        $entityManager->persist($objPokemon);
                        $entityManager->flush();
                        return $this->redirectToRoute('app_pokemon_show', [
                            'id' => $objPokemon->getId() 
                        ]);
                    
            }

            return $this->render('pokemon/create.html.twig',[]);
        }
    }

    #[Route('/pokemon/{id<\d+>}', name: 'app_pokemon_show')]
    public function show(int $id, PokemonRepository $pokemonRepository): Response

    {
        $objPokemon = $pokemonRepository->findById($id);

        return $this->render('pokemon/show.html.twig', [
            'pokemon_id'=>$id,
            'pokemon' => $objPokemon
        ]);
    }
}
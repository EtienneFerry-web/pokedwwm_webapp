<?php

namespace App\Controller;

use PHPUnit\TextUI\XmlConfiguration\RemoveConversionToExceptionsAttributes;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(Request $request): Response
    {
        
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    //Défini la methode http de la route
    //#[Route('/pokemon/{id}', name: 'app_pokemon_show', methods: ['GET'])]

    //Valide le format du paramétre en URL
    //#[Route('/pokemon/{id}', name: 'app_pokemon_show',condition: "params['id']>0")]

}

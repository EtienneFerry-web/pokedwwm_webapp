<?php

namespace App\Command;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(name: 'app:import-pokemon', description: 'Importe les Pokémon 1 à 13 en Français')]
class ImportPokemonCommand extends Command
{
    public function __construct(
        private HttpClientInterface $client,
        private EntityManagerInterface $entityManager
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Importation des Pokémon n°1 à n°13');

        // On change la boucle : de 1 à 13
        for ($i = 1; $i <= 13; $i++) {
            try {
                $response = $this->client->request('GET', "https://pokeapi.co/api/v2/pokemon-species/$i");

                if ($response->getStatusCode() === 200) {
                    $data = $response->toArray();

                    // Extraction du nom français
                    $frenchName = $data['name']; // Nom par défaut (anglais) au cas où
                    foreach ($data['names'] as $nameEntry) {
                        if ($nameEntry['language']['name'] === 'fr') {
                            $frenchName = $nameEntry['name'];
                            break;
                        }
                    }

                    $pokemon = new Pokemon();
                    $pokemon->setName($frenchName);
                    // Assure-toi que ton entité a bien la méthode setNumber()
                    $pokemon->setNumber($i); 

                    $this->entityManager->persist($pokemon);
                    $io->text("N°$i : $frenchName ajouté !");
                }
            } catch (\Exception $e) {
                $io->error("Erreur sur le n°$i : " . $e->getMessage());
            }
        }

        $this->entityManager->flush();
        $io->success('Les 13 premiers Pokémon sont maintenant en base !');

        return Command::SUCCESS;
    }
}
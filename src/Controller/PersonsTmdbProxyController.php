<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;

class PersonsTmdbProxyController extends AbstractController {

  #[Route('api/detailsPerson/{id}', name: 'app_details_person')]
    public function getDetailsPerson($id)
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            
            'https://api.themoviedb.org/3/person/' . $id . '?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr'
        );
        $detailsPerson = json_decode($response->getBody()->getContents(), true);
        return $this->json($detailsPerson);
    }
}
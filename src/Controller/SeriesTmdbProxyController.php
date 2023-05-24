<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;

class SeriesTmdbProxyController extends AbstractController
{
    #[Route('api/detailsSerie/{id}', name: 'app_details_serie')]
    public function getDetailsSerie($id)
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            
            'https://api.themoviedb.org/3/tv/' . $id . '?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr'
        );
        $detailsSerie = json_decode($response->getBody()->getContents(), true);
        return $this->json($detailsSerie);
    }

    #[Route('api/detailsSerie/{id}/images', name: 'app_details_serie_images')]
    public function getDetailsSerieImages($id)
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            
            'https://api.themoviedb.org/3/tv/' . $id . '/images?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr'
        );
        $detailsSerieImages = json_decode($response->getBody()->getContents(), true);
        return $this->json($detailsSerieImages);
    }
}

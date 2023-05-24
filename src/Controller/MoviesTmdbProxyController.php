<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;

class MoviesTmdbProxyController extends AbstractController
{
    /**
    * It makes a request to the TMDB API, gets the response, decodes it and returns it as a JSON
    */
    #[Route('api/detailsMovie/{id}', name: 'app_details_movie')]
    public function getDetailsMovie($id)
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            
            'https://api.themoviedb.org/3/movie/' . $id . '?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr'
        );
        $detailsMovie = json_decode($response->getBody()->getContents(), true);
        return $this->json($detailsMovie);
    }

    #[Route('api/detailsMovie/{id}/credits', name: 'app_details_movie_credits')]
    public function getDetailsMovieCredits($id)
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            
            'https://api.themoviedb.org/3/movie/' . $id . '/credits?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr'
        );
        $detailsMovieCredits = json_decode($response->getBody()->getContents(), true);
        return $this->json($detailsMovieCredits);
    }

    #[Route('api/detailsMovie/{id}/images', name: 'app_details_movie_images')]
    public function getDetailsMovieImages($id)
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            
            'https://api.themoviedb.org/3/movie/' . $id . '/images?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr'
        );
        $detailsMovieImages = json_decode($response->getBody()->getContents(), true);
        return $this->json($detailsMovieImages);
    }

    #[Route('api/detailsMovie/{id}/videos', name: 'app_details_movie_videos')]
    public function getDetailsMovievideos($id)
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            
            'https://api.themoviedb.org/3/movie/' . $id . '/videos?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr'
        );
        $detailsMovievideos = json_decode($response->getBody()->getContents(), true);
        return $this->json($detailsMovievideos);
    }
}

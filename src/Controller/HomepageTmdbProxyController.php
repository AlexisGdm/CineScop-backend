<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use GuzzleHttp\Client;

class HomepageTmdbProxyController extends AbstractController
{
    //TODO Change the source once the rating system is coded
    #[Route('api/popularFilm', name: 'app_popular_film')]
    public function getPopularFilm()
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            'https://api.themoviedb.org/3/discover/movie?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&with_watch_monetization_types=flatrate'
        );
        $data = json_decode($response->getBody()->getContents(), true);
        return $this->json($data['results'][0]);
    }

    //TODO Change the source once the rating system is coded
    #[Route('api/topRatedFilmsSlider', name: 'app_top_rated_films_slider')]
    public function getTopRatedFilmsSlider()
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            'https://api.themoviedb.org/3/discover/movie?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr&sort_by=popularity.desc&include_adult=false&include_video=false&page=1'
        );
        $topRatedMovies = json_decode($response->getBody()->getContents(), true);
        return $this->json($topRatedMovies);
    }

    //TODO Change the source once the rating system is coded
    #[Route('api/popularSeries', name: 'app_popular_series')]
    public function getPopularSeries()
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            'https://api.themoviedb.org/3/tv/popular?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr&page=1'
        );
        $popularSeries = json_decode($response->getBody()->getContents(), true);
        return $this->json($popularSeries);
    }

    //TODO Change the source once the rating system is coded
    #[Route('api/topRatedSeriesSlider', name: 'app_top_rated_series_slider')]
    public function getTopRatedSeriesSlider()
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            'https://api.themoviedb.org/3/tv/top_rated?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr&page=1'
        );
        $topRatedSeries = json_decode($response->getBody()->getContents(), true);
        return $this->json($topRatedSeries);
    }

    //TODO Change the source once the rating system is coded
    #[Route('api/topRatedPersonalitySlider', name: 'app_top_rated_personality_slider')]
    public function getTopRatedPersonalitySlider()
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            'https://api.themoviedb.org/3/person/popular?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr&page=1'
        );
        $topRatedPersonality = json_decode($response->getBody()->getContents(), true);
        return $this->json($topRatedPersonality);
    }

    //TODO Change the source once the rating system is coded
    #[Route('api/topRatedSlider', name: 'app_top_rated_slider')]
    public function getTopRatedSlider()
    {
        $client = new Client();
        $response = $client->request(
            'GET',
            'https://api.themoviedb.org/3/movie/top_rated?api_key=f525feb402f99bf8b6019d031f50d62e&language=fr&page=1'
        );
        $topRatedSlider = json_decode($response->getBody()->getContents(), true);
        return $this->json($topRatedSlider);
    }
}

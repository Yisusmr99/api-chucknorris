<?php

namespace App\Repositories;
use GuzzleHttp\Client;


class ExternalApi {

    public function getRandonJoke(){

        $url = env('URL_API_CHUCJNORRIS');
        $client = new Client();
        $response = $client->request('GET', $url);
        $response = json_decode($response->getBody());
        return $response;
        
    }
}
<?php

namespace App\Entity;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiConnection
{
    private $uri;
    private $username;
    private $password;




    public function __construct()
    {
        $this->uri = $_ENV['API_URI'];
        $this->username = $_ENV['API_USERNAME'];
        $this->password = $_ENV['API_PASSWORD'];
    }

    private function buildQueryBody($data) {
        return json_encode($data);
    }

    private function createUrl($endpoint)
    {
        $uri = rtrim($this->uri, '/ ');
        $endpoint = ltrim($endpoint, '/ ');
        return ($uri . '/' . $endpoint);
    }


    public function getToken()
    {
        $httpClient = HttpClient::create();
        $apiEndpoint = $this->createUrl('token');
        $data = $this->buildQueryBody([
            'username' => $this->username,
            'password' => $this->password
        ]);
        $response = $httpClient->request('POST', $apiEndpoint, [
            'json' => $data
        ]);

        return $response->getContent();
    }
}
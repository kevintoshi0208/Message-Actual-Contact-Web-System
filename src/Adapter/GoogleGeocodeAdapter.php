<?php


namespace App\Adapter;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class GoogleGeocodeAdapter
{
    private HttpClientInterface $client;
    private $apiKey;

    public function __construct(
        HttpClientInterface $client,
        $apiKey
    ) {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Exception
     */
    public function getLocationByAddress($address)
    {
        if (!$this->apiKey){
          throw new \Exception("The API key is not found. Please set it at .env file.");
        }

        $response = $this->client->request(
            'GET',
            'https://maps.googleapis.com/maps/api/geocode/json',
            [
                'query' => [
                    'address' => $address,
                    'key' => $this->apiKey
                ]
            ]
        );

        $data = json_decode($response->getContent(),true);


        if (
            $data["status"] == "OK" &&
            isset($data["results"]) &&
            isset($data["results"][0]) &&
            isset($data["results"][0]["geometry"]) &&
            isset($data["results"][0]["geometry"]["location"])
        ){
            $location = $data["results"][0]["geometry"]["location"];
            return [
                "wgs84N" => $location["lat"],
                "wgs84E" => $location["lng"]
            ];
        } else {
            throw new \Exception($data["error_message"]);
        }
    }
}
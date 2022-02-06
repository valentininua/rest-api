<?php

namespace App\Services;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CarService
{

//    /**
//     * @var ReportRepository
//     */
//    private $report;
//
//    public function __construct( ReportRepository $report )
//    {
//        $this->report = $report;
//    }

    private const SERVER = 'http://135.181.116.15';

    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $numberCar
     * @return array
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    public function sendNewBaseByNumberCar(string $numberCar = 'Т934ВН50'): array
    {
        $response = $this->client->request(
            'POST',
            self::SERVER . '/index/getNewBaseByNumberCar',
            [
                'headers' => [
                    'Content-Type' => 'text/plain',
                ],
                'json' => ['number_car' => $numberCar],
            ]
        );
        //        $statusCode = $response->getStatusCode();
        //        $content = $response->getContent();
        $content = $response->toArray();
        return $content;


    }
}

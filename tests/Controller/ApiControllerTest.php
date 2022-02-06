<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ));
        $crawler = $client->request(
            'POST',
            '/api/getNewBaseByNumberCar',
            array(),
            array(),
            array('CONTENT_TYPE' => 'application/json'),
            '{"number_car":"Т934ВН50"}'
        );
//        $this->assertResponseIsSuccessful();
    }
}

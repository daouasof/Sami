<?php

namespace App\Tests\Controller;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    #[Test]
    public function it_can_calculate_the_total_emissions_for_a_list_of_travels(): void
    {
        $client = static::createClient();

        $requestContent = [
            'travels' => $this->getTravels(),
        ];

        $client->request('POST', '/calculate', content: \json_encode($requestContent));

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse();
        $responseContent = \json_decode($response->getContent(), true);

        $this->assertEquals(1048239, $responseContent['total_emissions']);
    }

    #[Test]
    public function it_can_calculate_the_total_distance_for_a_list_of_travels(): void
    {
        $client = static::createClient();

        $requestContent = [
            'travels' => $this->getTravels(),
        ];

        $client->request('POST', '/calculate', content: \json_encode($requestContent));

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse();
        $responseContent = \json_decode($response->getContent(), true);

        $this->assertEquals(8750, $responseContent['total_distance']);
    }

    #[Test]
    public function it_can_calculate_the_emissions_and_distance_grouped_by_transport_mode(): void
    {
        $client = static::createClient();

        $requestContent = [
            'travels' => $this->getTravels(),
        ];

        $client->request('POST', '/calculate', content: \json_encode($requestContent));

        $this->assertResponseIsSuccessful();

        $response = $client->getResponse();
        $responseContent = \json_decode($response->getContent(), true);

        $this->assertEquals(3150, $responseContent['by_mode']['tgv']['distance']);
        $this->assertEquals(5355, $responseContent['by_mode']['tgv']['emissions']);

        $this->assertEquals(4800, $responseContent['by_mode']['plane']['distance']);
        $this->assertEquals(897600, $responseContent['by_mode']['plane']['emissions']);

        $this->assertEquals(750, $responseContent['by_mode']['car']['distance']);
        $this->assertEquals(145284, $responseContent['by_mode']['car']['emissions']);

        $this->assertEquals(50, $responseContent['by_mode']['bike']['distance']);
        $this->assertEquals(0, $responseContent['by_mode']['bike']['emissions']);
    }

    private function getTravels(): array
    {
        return [
            [
                'mode' => 'tgv',
                'distance' => 500,
                'round_trip' => true,
                'people' => 3,
            ],
            [
                'mode' => 'tgv',
                'distance' => 150,
                'round_trip' => false,
                'people' => 1,
            ],
            [
                'mode' => 'plane',
                'distance' => 1200,
                'round_trip' => true,
                'people' => 2,
            ],
            [
                'mode' => 'car',
                'type' => 'gasoline',
                'mileage' => 6.9,
                'distance' => 300,
                'round_trip' => true,
                'people' => 1,
            ],
            [
                'mode' => 'car',
                'distance' => 150,
                'round_trip' => false,
                'people' => 1,
            ],
            [
                'mode' => 'bike',
                'distance' => 50,
                'round_trip' => false,
                'people' => 1,
            ],
        ];
    }
}

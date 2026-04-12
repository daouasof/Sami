<?php

namespace App\Controller;

use App\DTO\CalculateDto;
use App\Service\CalculateService;
use App\Model\Trip;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    // To do: add E2E test with happy path, empty travels, missing key in travels
    #[Route(
        path: '/calculate',
        name: 'calculate_emissions',
        methods: ['POST'],
        format: 'json',
    )]
    public function calculate(Request $request, CalculateService $service): Response
    {
        $body = \json_decode($request->getContent(), true);

        // TO DO : add data validation before creating DTO

        $trips = [];
        foreach ($body['travels'] as $travel) {
          $trips[] = new Trip(
            mode: $travel['mode'],
            oneWayDistance: $travel['distance'],
            roundTrip: $travel['round_trip'],
            people: $travel['people'],
            mileage: $travel['mileage'] ?? null,
            type: $travel['type'] ?? null
          );
        }

        $result = $service->calculate(new CalculateDto($trips));

        return $this->json($result);
      }
}

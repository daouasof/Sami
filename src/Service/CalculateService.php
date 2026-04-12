<?php

namespace App\Service;

use App\Dto\CalculateDto;

class CalculateService {


  // To do: refactor that function for more readability
  // To do: create tests
  public function calculate(CalculateDto $dto): array {
   $totalDistance = 0;
    $totalEmissions = 0;
    $byMode = [];

    foreach ($dto->getTrips() as $trip) {
      $calculator = $trip->getEmissionsCalculator();
      $tripDistance = $calculator->calculateDistance();
      $tripEmissions = $calculator->calculateEmissions();

      $byMode[$trip->getMode()] ??= ['distance' => 0, 'emissions' => 0];
      $byMode[$trip->getMode()]['distance'] += $tripDistance;
      $byMode[$trip->getMode()]['emissions'] += $tripEmissions;

      $totalDistance += $tripDistance;
      $totalEmissions += $tripEmissions;
    }

    return [
      'total_emissions' => $totalEmissions,
      'total_distance'  => $totalDistance,
      'by_mode'         => $byMode,
    ];
  }
}

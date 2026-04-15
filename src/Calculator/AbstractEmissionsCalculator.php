<?php

namespace App\Calculator;

use App\Model\Trip;
use App\Calculator\Interface\EmissionsCalculatorInterface;

abstract class AbstractEmissionsCalculator implements EmissionsCalculatorInterface {

  // To do: add tests
  public function calculateDistance(Trip $trip): int {
    return $trip->getOneWayDistance() * ($trip->getRoundTrip() ? 2 : 1) * $trip->getPeople();
  }

  abstract protected function getEmissionFactor(Trip $trip): float;


  public function calculateEmissions(Trip $trip):int {
    return round($this->calculateDistance($trip) * $this->getEmissionFactor($trip));
  }
}

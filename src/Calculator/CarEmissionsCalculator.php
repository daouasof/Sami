<?php

namespace App\Calculator;

use App\Model\Trip;

class CarEmissionsCalculator extends AbstractEmissionsCalculator {

  private array $emissionFactor = [
    "diesel" => 3.16,
    "gasoline" => 2.81
  ];

  // To Do: add tests
  public function calculateEmissions(Trip $trip):int {
    return round($this->calculateDistance($trip) * $this->getEmissionFactor($trip) / $trip->getPeople());
  }

  protected function getEmissionFactor(Trip $trip):float {
    if($trip->getType() === null) {
      return 193;
    }
    return ($this->emissionFactor[$trip->getType()] * 1000) * ($trip->getMileage() / 100);
  }
}

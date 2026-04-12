<?php

namespace App\Calculator;

class CarEmissionsCalculator extends AbstractEmissionsCalculator {

  private array $emissionFactor = [
    "diesel" => 3.16,
    "gasoline" => 2.81
  ];

  public function calculateDistance(): int {
    return $this->trip->getOneWayDistance() * ($this->trip->getRoundTrip() ? 2 : 1) * $this->trip->getPeople();
  }

  public function calculateEmissions():int {
    return round($this->calculateDistance() * $this->getEmissionFactor() / $this->trip->getPeople());
  }

  protected function getEmissionFactor():float {
    if($this->trip->getType() === null) {
      return 193;
    }
    return ($this->emissionFactor[$this->trip->getType()] * 1000) * ($this->trip->getMileage() / 100);
  }
}

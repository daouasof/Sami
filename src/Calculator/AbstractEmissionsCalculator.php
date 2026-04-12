<?php

namespace App\Calculator;

use App\Model\Trip;
use App\Calculator\Interface\EmissionsCalculatorInterface;

abstract class AbstractEmissionsCalculator implements EmissionsCalculatorInterface {

  public function __construct(
    protected Trip $trip
  )
  {}

  public function calculateDistance(): int {
    return $this->trip->getOneWayDistance() * ($this->trip->getRoundTrip() ? 2 : 1) * $this->trip->getPeople();
  }

  abstract protected function getEmissionFactor(): float;


  public function calculateEmissions():int {
    return round($this->calculateDistance() * $this->getEmissionFactor());
  }
}

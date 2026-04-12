<?php

namespace App\Calculator;

use App\Model\Trip;

abstract class AbstractEmissionsCalculator {

  public function __construct(
    protected Trip $trip
  )
  {}

  public function calculateDistance(): int {
    return $this->trip->getOneWayDistance() * ($this->trip->getRoundTrip() ? 2 : 1) * $this->trip->getPeople();
  }

  abstract protected function getEmissionFactor(): float;

  abstract public function calculateEmissions():int;
}

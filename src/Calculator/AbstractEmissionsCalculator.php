<?php

namespace App\Calculator;

use App\Model\Trip;

abstract class AbstractEmissionsCalculator {

  public function __construct(
    protected Trip $trip
  )
  {}

  abstract public function calculateDistance(): int;

  abstract protected function getEmissionFactor(): float;

  abstract public function calculateEmissions():int;
}

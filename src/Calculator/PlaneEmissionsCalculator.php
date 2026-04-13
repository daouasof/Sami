<?php

namespace App\Calculator;

use App\Model\Trip;

class PlaneEmissionsCalculator extends AbstractEmissionsCalculator {

  private array $emissionFactor = [
    3500 => 152,
    1000 => 187,
    0 => 258
  ];

  // To do: refactor that method
  // To do: add tests
  protected function getEmissionFactor(Trip $trip):float {
    foreach ($this->emissionFactor as $limit => $value) {
      if ($trip->getOneWayDistance() >= $limit) {
        return $value;
      }
    }
    return 0;
  }
}

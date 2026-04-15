<?php

namespace App\Calculator;

use App\Model\Trip;

class TrainEmissionsCalculator extends AbstractEmissionsCalculator {

  private float $emissionFactor = 1.7;

  protected function getEmissionFactor(Trip $trip):float {
    return $this->emissionFactor;
  }

}

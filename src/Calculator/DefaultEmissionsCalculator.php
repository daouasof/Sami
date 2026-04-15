<?php

namespace App\Calculator;

use App\Model\Trip;

class DefaultEmissionsCalculator extends AbstractEmissionsCalculator {

// if we don't have info on emission factor, we chose to consider it to be 0 example: walk, bike
  protected function getEmissionFactor(Trip $trip): float {
    return 0;
  }
}

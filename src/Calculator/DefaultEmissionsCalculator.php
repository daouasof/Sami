<?php

namespace App\Calculator;

class DefaultEmissionsCalculator extends AbstractEmissionsCalculator {

// if we don't have info on emission factor, we chose to consider it to be 0 example: walk, bike
  protected function getEmissionFactor(): float {
    return 0;
  }
}

<?php

namespace App\Calculator;

class TrainEmissionsCalculator extends AbstractEmissionsCalculator {

  private float $emissionFactor = 1.7;

  protected function getEmissionFactor():float {
    return $this->emissionFactor;
  }

}

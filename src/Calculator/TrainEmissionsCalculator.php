<?php

namespace App\Calculator;

class TrainEmissionsCalculator extends AbstractEmissionsCalculator {

  private float $emissionFactor = 1.7;

  protected function getEmissionFactor():float {
    return $this->emissionFactor;
  }

  public function calculateEmissions():int {
    return round($this->calculateDistance() * $this->getEmissionFactor());
  }

}

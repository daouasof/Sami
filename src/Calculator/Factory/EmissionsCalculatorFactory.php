<?php

namespace App\Calculator\Factory;

use App\Calculator\Interface\EmissionsCalculatorInterface;
use App\Model\Trip;
use App\Calculator\TrainEmissionsCalculator;
use App\Calculator\CarEmissionsCalculator;
use App\Calculator\PlaneEmissionsCalculator;
use App\Calculator\DefaultEmissionsCalculator;

class EmissionsCalculatorFactory {

  public function getCalculator(Trip $trip): EmissionsCalculatorInterface
  {
    return match($trip->getMode()) {
      'tgv'   => new TrainEmissionsCalculator(),
      'car'   => new CarEmissionsCalculator(),
      'plane' => new PlaneEmissionsCalculator(),
      default => new DefaultEmissionsCalculator(),
    };
  }
}

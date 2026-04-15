<?php

namespace App\Calculator\Interface;

use App\Model\Trip;

interface EmissionsCalculatorInterface {
  public function calculateEmissions(Trip $trip): int;
  public function calculateDistance(Trip $trip): int;
}

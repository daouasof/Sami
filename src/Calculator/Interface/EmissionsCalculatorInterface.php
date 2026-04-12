<?php

namespace App\Calculator\Interface;

interface EmissionsCalculatorInterface {
  public function calculateEmissions(): int;
  public function calculateDistance(): int;
}

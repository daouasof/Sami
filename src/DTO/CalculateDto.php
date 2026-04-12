<?php

namespace App\Dto;

use App\Model\Trip;

class CalculateDto {
  /**
   * @param Trip[] $trips
   */
  public function __construct(
    private array $trips
  )
  {}

  public function getTrips(): array
  {
      return $this->trips;
  }
}

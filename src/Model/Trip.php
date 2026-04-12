<?php

namespace App\Model;

use App\Calculator\CarEmissionsCalculator;
use App\Calculator\DefaultEmissionsCalculator;
use App\Calculator\Interface\EmissionsCalculatorInterface;
use App\Calculator\PlaneEmissionsCalculator;
use App\Calculator\TrainEmissionsCalculator;


class Trip {

  public function __construct(
    protected string $mode,
    protected int $oneWayDistance,
    protected bool $roundTrip,
    protected int $people,
    protected ?float $mileage = null,
    protected ?string $type = null
  ){}

  public function getMode(): string
  {
    return $this->mode;
  }

  public function getOneWayDistance(): int
  {
    return $this->oneWayDistance;
  }

  public function getRoundTrip(): bool
  {
    return $this->roundTrip;
  }

  public function getPeople(): int
  {
    return $this->people;
  }

  public function getMileage(): ?float
  {
    return $this->mileage;
  }

  public function getType(): ?string
  {
    return $this->type;
  }

  // To do: create a factory to have this mapping out of the model
  // To do: add tests on factory
  public function getEmissionsCalculator(): EmissionsCalculatorInterface
  {
    // To do: add enum for modes
    // To do: raise a warning when default is used
    return match($this->mode) {
      'tgv'   => new TrainEmissionsCalculator($this),
      'car'   => new CarEmissionsCalculator($this),
      'plane' => new PlaneEmissionsCalculator($this),
      default => new DefaultEmissionsCalculator($this),
    };
  }
}

<?php

namespace App\Model;

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
}

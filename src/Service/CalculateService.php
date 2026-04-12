<?php

namespace App\Service;

use App\Dto\CalculateDto;

class CalculateService {

  public function calculate(CalculateDto $dto): array {
    dump($dto);
    return [];
  }
}

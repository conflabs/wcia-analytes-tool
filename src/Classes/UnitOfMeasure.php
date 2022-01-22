<?php declare(strict_types=1);

namespace Conflabs\WciaGenerator\Classes;

class UnitOfMeasure
{

    public function __construct(
      public string $ulid, public string $symbol, public string $name, public ?string $plural, public ?string $description
    ) {}
}
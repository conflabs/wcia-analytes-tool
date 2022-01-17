<?php declare(strict_types=1);

namespace Conflabs\WciaGenerator\Classes;


final class Analyte
{

    /**
     * @param string $ulid
     * @param string $scientific_name
     * @param array $common_names
     * @param string $category
     * @param string|null $cas_rn
     */
    public function __construct(
      public string $ulid, public string $scientific_name, public array $common_names, public string $category, public ?string $cas_rn
    ) {}
}
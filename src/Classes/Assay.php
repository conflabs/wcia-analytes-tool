<?php declare(strict_types=1);

namespace Conflabs\WciaGenerator\Classes;


final class Assay
{

    /**
     * @param string $ulid
     * @param string $assay_name
     * @param array $common_names
     * @param string $category
     * @param string|null $cas_rn
     */
    public function __construct(public string $ulid, public string $assay_name, public array $common_names) {}
}
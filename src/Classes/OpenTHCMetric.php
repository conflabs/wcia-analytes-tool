<?php declare(strict_types=1);

namespace Conflabs\WciaGenerator\Classes;

final class OpenTHCMetric
{

    /**
     * @param string $id
     * @param string|null $cas
     * @param string $name
     * @param string $type
     * @param string|null $stub
     */
    public function __construct(public string $id, public ?string $cas, public string $name, public string $type, public ?string $stub) {}
}
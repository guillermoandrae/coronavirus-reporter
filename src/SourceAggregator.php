<?php

namespace Guillermoandrae\Coronavirus;

use Guillermoandrae\Coronavirus\Contracts\SourceAggregatorInterface;
use Guillermoandrae\Coronavirus\Contracts\SourceInterface;

final class SourceAggregator implements SourceAggregatorInterface
{
    private $sources = [];

    public function addSource(SourceInterface $source): SourceAggregatorInterface
    {
        $this->sources[] = $source;
        return $this;
    }

    public function getSources(): array
    {
        return $this->sources;
    }
}

<?php

namespace Guillermoandrae\Coronavirus;

use Guillermoandrae\Coronavirus\Contracts\CacheItemPoolAwareTrait;
use Guillermoandrae\Coronavirus\Contracts\SourceAggregatorInterface;
use Guillermoandrae\Coronavirus\Contracts\SourceInterface;
use Psr\Cache\CacheItemPoolInterface;

final class SourceAggregator implements SourceAggregatorInterface
{
    use CacheItemPoolAwareTrait;

    /**
     * The sources.
     *
     * @var array
     */
    private $sources = [];

    public function __construct(CacheItemPoolInterface $cacheItemPool = null)
    {
        if ($cacheItemPool) {
            $this->setCacheItemPool($cacheItemPool);
        }
    }

    public function addSource(SourceInterface $source): SourceAggregatorInterface
    {
        if ($this->cacheItemPool) {
            $source->setCacheItemPool($this->cacheItemPool);
        }
        $this->sources[] = $source;
        return $this;
    }

    public function getSources(): array
    {
        return $this->sources;
    }
}

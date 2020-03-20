<?php

namespace Guillermoandrae\Coronavirus\Contract;

interface SourceAggregatorInterface extends CacheItemPoolAwareInterface
{
    /**
     * Adds a source to this aggregator.
     *
     * @param SourceInterface $source  The provided source.
     * @return SourceAggregatorInterface  This class.
     */
    public function addSource(SourceInterface $source): SourceAggregatorInterface;

    /**
     * Returns all of the registered sources.
     *
     * @return array  The registered sources.
     */
    public function getSources(): array;
}

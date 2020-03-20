<?php

namespace Guillermoandrae\Coronavirus\Contracts;

use Psr\Cache\CacheItemPoolInterface;

interface CacheItemPoolAwareInterface
{
    /**
     * Sets the cache item pool.
     *
     * @param CacheItemPoolInterface $cacheItemPool  The cache item pool.
     * @return mixed  This object.
     */
    public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool);

    /**
     * Returns the cache item pool.
     *
     * @return CacheItemPoolInterface|null The cache item pool.
     */
    public function getCacheItemPool(): ?CacheItemPoolInterface;
}

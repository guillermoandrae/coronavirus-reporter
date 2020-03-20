<?php

namespace Guillermoandrae\Coronavirus\Contract;

use Psr\Cache\CacheItemPoolInterface;

trait CacheItemPoolAwareTrait
{
    /**
     * The cache item pool.
     *
     * @var CacheItemPoolInterface
     */
    protected $cacheItemPool;

    final public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool)
    {
        $this->cacheItemPool = $cacheItemPool;
        return $this;
    }

    final public function getCacheItemPool(): ?CacheItemPoolInterface
    {
        return $this->cacheItemPool;
    }
}

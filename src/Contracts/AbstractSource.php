<?php

namespace Guillermoandrae\Coronavirus\Contracts;

use Psr\Cache\CacheItemPoolInterface;
use \Exception;
use \ErrorException;

abstract class AbstractSource implements SourceInterface
{
    /**
     * The source URL.
     *
     * @var string
     */
    protected $url = '';

    /**
     * The source state.
     *
     * @var string
     */
    protected $state = '';

    /**
     * The cache item pool.
     *
     * @var CacheItemPoolInterface
     */
    protected $cacheItemPool;

    /**
     * AbstractSource constructor. Derives state name if not provided.
     *
     * @param string $state  OPTIONAL The source state.
     * @param string $url  OPTIONAL The source URL.
     */
    final public function __construct(string $state = '', string $url = '')
    {
        if (!empty($state)) {
            $this->state = $state;
        } elseif (empty($this->state)) {
            $name = get_called_class();
            preg_match('/\\\Sources\\\(.*)Department/', $name, $matches);
            $this->state = $matches[1];
        }

        if (!empty($url)) {
            $this->url = $url;
        }
    }

    final public function getUrl(): string
    {
        return $this->url;
    }

    final public function getData(): string
    {
        try {
            if (!$cachePool = $this->getCacheItemPool()) {
                throw new ErrorException('No cache item pool exists.');
            }
            $cacheKey = md5(get_called_class()) . '.cache';
            $cacheItem = $cachePool->getItem($cacheKey);
            if ($cacheItem->isHit()) {
                return $cacheItem->get();
            }
            $data = file_get_contents($this->getUrl());
            $cacheItem->set($data);
            $cachePool->save($cacheItem);
            return $data;
        } catch (Exception $ex) {
            return file_get_contents($this->getUrl());
        }
    }

    final public function getState(): string
    {
        return $this->state;
    }

    final public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool): SourceInterface
    {
        $this->cacheItemPool = $cacheItemPool;
        return $this;
    }

    final public function getCacheItemPool(): ?CacheItemPoolInterface
    {
        return $this->cacheItemPool;
    }
}

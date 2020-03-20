<?php

namespace Guillermoandrae\Coronavirus\Contracts;

use ErrorException;
use Exception;

abstract class AbstractSource implements SourceInterface
{
    use CacheItemPoolAwareTrait;

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

    final public function setUrl(string $url): SourceInterface
    {
        $this->url = $url;
        return $this;
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
            $cacheItem->set($data)->expiresAfter(SourceInterface::CACHE_LIFETIME);
            $cachePool->save($cacheItem);
            return $data;
        } catch (Exception $ex) {
            return file_get_contents($this->getUrl());
        }
    }

    final public function setState(string $state): SourceInterface
    {
        $this->state = $state;
        return $this;
    }

    final public function getState(): string
    {
        return $this->state;
    }
}

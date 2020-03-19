<?php

namespace GuillermoandraeTest\Coronavirus;

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use Guillermoandrae\Coronavirus\Contracts\SourceInterface;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

abstract class SourceTestCase extends TestCase
{
    /**
     * @var SourceInterface
     */
    protected $source;

    /**
     * @var CacheItemPoolInterface
     */
    protected $pool;

    protected function setUp(): void
    {
        $filesystemAdapter = new Local(realpath('.'));
        $filesystem = new Filesystem($filesystemAdapter);
        $this->pool = new FilesystemCachePool($filesystem);
        $this->pool->clear();
    }
}

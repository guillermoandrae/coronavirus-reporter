<?php

namespace GuillermoandraeTest\Coronavirus;

use Cache\Adapter\Filesystem\FilesystemCachePool;
use Guillermoandrae\Coronavirus\SourceAggregator;
use Guillermoandrae\Coronavirus\Source\NewYorkDepartmentOfHealth;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use PHPUnit\Framework\TestCase;
use Psr\Cache\CacheItemPoolInterface;

final class SourceAggregatorTest extends TestCase
{
    public function testExecute()
    {
        $filesystemAdapter = new Local(realpath('tests'));
        $filesystem = new Filesystem($filesystemAdapter);
        $pool = new FilesystemCachePool($filesystem);
        $aggregator = new SourceAggregator($pool);
        $source = new NewYorkDepartmentOfHealth();
        $aggregator->addSource($source);
        $this->assertInstanceOf(
            CacheItemPoolInterface::class,
            $aggregator->getSources()[0]->getCacheItemPool()
        );
    }
}
